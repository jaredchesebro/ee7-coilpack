<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\BaconQrCode\Renderer;

use ExpressionEngine\Dependency\BaconQrCode\Encoder\QrCode;
interface RendererInterface
{
    public function render(QrCode $qrCode) : string;
}
