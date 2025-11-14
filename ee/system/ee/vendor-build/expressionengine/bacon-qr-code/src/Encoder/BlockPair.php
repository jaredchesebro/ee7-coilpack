<?php

declare (strict_types=1);
namespace ExpressionEngine\Dependency\BaconQrCode\Encoder;

use SplFixedArray;
/**
 * Block pair.
 */
final class BlockPair
{
    private $dataBytes;
    private $errorCorrectionBytes;
    /**
     * Creates a new block pair.
     *
     * @param SplFixedArray<int> $dataBytes Data bytes in the block.
     * @param SplFixedArray<int> $errorCorrectionBytes Error correction bytes in the block.
     */
    public function __construct(SplFixedArray $dataBytes, SplFixedArray $errorCorrectionBytes)
    {
        $this->dataBytes = $dataBytes;
        $this->errorCorrectionBytes = $errorCorrectionBytes;
    }
    /**
     * Gets the data bytes.
     *
     * @return SplFixedArray<int>
     */
    public function getDataBytes(): SplFixedArray
    {
        return $this->dataBytes;
    }
    /**
     * Gets the error correction bytes.
     *
     * @return SplFixedArray<int>
     */
    public function getErrorCorrectionBytes(): SplFixedArray
    {
        return $this->errorCorrectionBytes;
    }
}
