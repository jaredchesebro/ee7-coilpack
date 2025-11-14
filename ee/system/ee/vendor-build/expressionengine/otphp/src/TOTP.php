<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\OTPHP;

use InvalidArgumentException;
use ExpressionEngine\Dependency\Psr\Clock\ClockInterface;
use function assert;
use function is_int;
/**
 * @see \OTPHP\Test\TOTPTest
 */
final class TOTP extends OTP implements TOTPInterface
{
    private $clock;
    public function __construct(string $secret, ?ClockInterface $clock = null)
    {
        parent::__construct($secret);
        if ($clock === null) {
            throw new \Exception('spomky-labs/otphp: The parameter "$clock" will become mandatory in 12.0.0. Please set a valid PSR Clock implementation instead of "null".');
            $clock = new InternalClock();
        }
        $this->clock = $clock;
    }
    public static function create(?string $secret = null, int $period = self::DEFAULT_PERIOD, string $digest = self::DEFAULT_DIGEST, int $digits = self::DEFAULT_DIGITS, int $epoch = self::DEFAULT_EPOCH, ?ClockInterface $clock = null): self
    {
        $totp = $secret !== null ? self::createFromSecret($secret, $clock) : self::generate($clock);
        $totp->setPeriod($period);
        $totp->setDigest($digest);
        $totp->setDigits($digits);
        $totp->setEpoch($epoch);
        return $totp;
    }
    public static function createFromSecret(string $secret, ?ClockInterface $clock = null): self
    {
        $totp = new self($secret, $clock);
        $totp->setPeriod(self::DEFAULT_PERIOD);
        $totp->setDigest(self::DEFAULT_DIGEST);
        $totp->setDigits(self::DEFAULT_DIGITS);
        $totp->setEpoch(self::DEFAULT_EPOCH);
        return $totp;
    }
    public static function generate(?ClockInterface $clock = null): self
    {
        return self::createFromSecret(self::generateSecret(), $clock);
    }
    public function getPeriod(): int
    {
        $value = $this->getParameter('period');
        if (is_int($value) && $value > 0) {
            return $value;
        }
        throw new InvalidArgumentException('Invalid "period" parameter.');
    }
    public function getEpoch(): int
    {
        $value = $this->getParameter('epoch');
        if (is_int($value) && $value >= 0) {
            return $value;
        }
        throw new InvalidArgumentException('Invalid "epoch" parameter.');
    }
    public function expiresIn(): int
    {
        $period = $this->getPeriod();
        return $period - $this->clock->now()->getTimestamp() % $this->getPeriod();
    }
    /**
     * The OTP at the specified input.
     *
     * @param 0|positive-int $input
     */
    public function at(int $input): string
    {
        return $this->generateOTP($this->timecode($input));
    }
    public function now(): string
    {
        $timestamp = $this->clock->now()->getTimestamp();
        assert($timestamp >= 0, 'The timestamp must return a positive integer.');
        return $this->at($timestamp);
    }
    /**
     * If no timestamp is provided, the OTP is verified at the actual timestamp. When used, the leeway parameter will
     * allow time drift. The passed value is in seconds.
     *
     * @param 0|positive-int $timestamp
     * @param null|0|positive-int $leeway
     */
    public function verify(string $otp, ?int $timestamp = null, ?int $leeway = null): bool
    {
        $timestamp = is_null($timestamp) ? $this->clock->now()->getTimestamp() : $timestamp;
        if ($timestamp < 0) {
            throw new InvalidArgumentException('Timestamp must be at least 0.');
        }
        if ($leeway === null) {
            return $this->compareOTP($this->at($timestamp), $otp);
        }
        $leeway = abs($leeway);
        if ($leeway >= $this->getPeriod()) {
            throw new InvalidArgumentException('The leeway must be lower than the TOTP period');
        }
        $timestampMinusLeeway = $timestamp - $leeway;
        if ($timestampMinusLeeway < 0) {
            throw new InvalidArgumentException('The timestamp must be greater than or equal to the leeway.');
        }
        return $this->compareOTP($this->at($timestampMinusLeeway), $otp) || $this->compareOTP($this->at($timestamp), $otp) || $this->compareOTP($this->at($timestamp + $leeway), $otp);
    }
    public function getProvisioningUri(): string
    {
        $params = [];
        if ($this->getPeriod() !== 30) {
            $params['period'] = $this->getPeriod();
        }
        if ($this->getEpoch() !== 0) {
            $params['epoch'] = $this->getEpoch();
        }
        return $this->generateURI('totp', $params);
    }
    public function setPeriod(int $period): void
    {
        $this->setParameter('period', $period);
    }
    public function setEpoch(int $epoch): void
    {
        $this->setParameter('epoch', $epoch);
    }
    /**
     * @return array<non-empty-string, callable>
     */
    protected function getParameterMap(): array
    {
        return array_merge(parent::getParameterMap(), ['period' => static function ($value): int {
            if ((int) $value <= 0) {
                throw new InvalidArgumentException('Period must be at least 1.');
            }
            return (int) $value;
        }, 'epoch' => static function ($value): int {
            if ((int) $value < 0) {
                throw new InvalidArgumentException('Epoch must be greater than or equal to 0.');
            }
            return (int) $value;
        }]);
    }
    /**
     * @param array<non-empty-string, mixed> $options
     */
    protected function filterOptions(array &$options): void
    {
        parent::filterOptions($options);
        if (isset($options['epoch']) && $options['epoch'] === 0) {
            unset($options['epoch']);
        }
        ksort($options);
    }
    /**
     * @param 0|positive-int $timestamp
     *
     * @return 0|positive-int
     */
    private function timecode(int $timestamp): int
    {
        $timecode = (int) floor(($timestamp - $this->getEpoch()) / $this->getPeriod());
        assert($timecode >= 0);
        return $timecode;
    }
}
