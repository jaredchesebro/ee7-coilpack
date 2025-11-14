<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\OTPHP;

interface HOTPInterface extends OTPInterface
{
    public const DEFAULT_COUNTER = 0;
    /**
     * The initial counter (a positive integer).
     */
    public function getCounter(): int;
    /**
     * Create a new HOTP object.
     *
     * If the secret is null, a random 64 bytes secret will be generated.
     *
     * @param null|non-empty-string $secret
     * @param 0|positive-int $counter
     * @param non-empty-string $digest
     * @param positive-int $digits
     *
     * @deprecated Deprecated since v11.1, use ::createFromSecret or ::generate instead
     */
    public static function create(?string $secret = null, int $counter = 0, string $digest = 'sha1', int $digits = 6);
    public function setCounter(int $counter): void;
}
