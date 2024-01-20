<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\BaconQrCode\Renderer\Module;

use ExpressionEngine\Dependency\BaconQrCode\Encoder\ByteMatrix;
use ExpressionEngine\Dependency\BaconQrCode\Renderer\Module\EdgeIterator\EdgeIterator;
use ExpressionEngine\Dependency\BaconQrCode\Renderer\Path\Path;
/**
 * Groups modules together to a single path.
 */
final class SquareModule implements ModuleInterface
{
    /**
     * @var self|null
     */
    private static $instance;
    private function __construct()
    {
    }
    public static function instance() : self
    {
        return self::$instance ?: (self::$instance = new self());
    }
    public function createPath(ByteMatrix $matrix) : Path
    {
        $path = new Path();
        foreach (new EdgeIterator($matrix) as $edge) {
            $points = $edge->getSimplifiedPoints();
            $length = \count($points);
            $path = $path->move($points[0][0], $points[0][1]);
            for ($i = 1; $i < $length; ++$i) {
                $path = $path->line($points[$i][0], $points[$i][1]);
            }
            $path = $path->close();
        }
        return $path;
    }
}
