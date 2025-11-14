<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\OTPHP;

use InvalidArgumentException;
use function array_key_exists;
use function is_string;
/**
 * @internal
 */
final class Url
{
    /**
     * @param non-empty-string $scheme
     * @param non-empty-string $host
     * @param non-empty-string $path
     * @param non-empty-string $secret
     * @param array<non-empty-string, mixed> $query
     */
    public function __construct(string $scheme, string $host, string $path, string $secret, array $query)
    {
    }
    /**
     * @return non-empty-string
     */
    public function getScheme(): string
    {
        return $this->scheme;
    }
    /**
     * @return non-empty-string
     */
    public function getHost(): string
    {
        return $this->host;
    }
    /**
     * @return non-empty-string
     */
    public function getPath(): string
    {
        return $this->path;
    }
    /**
     * @return non-empty-string
     */
    public function getSecret(): string
    {
        return $this->secret;
    }
    /**
     * @return array<non-empty-string, mixed>
     */
    public function getQuery(): array
    {
        return $this->query;
    }
    /**
     * @param non-empty-string $uri
     */
    public static function fromString(string $uri): self
    {
        $parsed_url = parse_url($uri);
        if ($parsed_url === \false) {
            throw new InvalidArgumentException('Invalid URI.');
        }
        foreach (['scheme', 'host', 'path', 'query'] as $key) {
            if (!array_key_exists($key, $parsed_url)) {
                throw new InvalidArgumentException('Not a valid OTP provisioning URI');
            }
        }
        $scheme = $parsed_url['scheme'] ?? null;
        $host = $parsed_url['host'] ?? null;
        $path = $parsed_url['path'] ?? null;
        $query = $parsed_url['query'] ?? null;
        if ($scheme !== 'otpauth') {
            throw new InvalidArgumentException('Not a valid OTP provisioning URI');
        }
        if (!is_string($host)) {
            throw new InvalidArgumentException('Invalid URI.');
        }
        if (!is_string($path)) {
            throw new InvalidArgumentException('Invalid URI.');
        }
        if (!is_string($query)) {
            throw new InvalidArgumentException('Invalid URI.');
        }
        $parsedQuery = [];
        parse_str($query, $parsedQuery);
        if (!array_key_exists('secret', $parsedQuery)) {
            throw new InvalidArgumentException('Not a valid OTP provisioning URI');
        }
        $secret = $parsedQuery['secret'];
        unset($parsedQuery['secret']);
        return new self($scheme, $host, $path, $secret, $parsedQuery);
    }
}
