<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\OTPHP;

use DateTimeImmutable;
use ExpressionEngine\Dependency\Psr\Clock\ClockInterface;
/**
 * @internal
 */
final class InternalClock implements ClockInterface
{
    public function now(): DateTimeImmutable
    {
        return new DateTimeImmutable();
    }
}
