<?php

namespace ExpressionEngine\Dependency\Sabberworm\CSS\Value;

use ExpressionEngine\Dependency\Sabberworm\CSS\OutputFormat;
class CalcRuleValueList extends RuleValueList
{
    /**
     * @param int $iLineNo
     */
    public function __construct($iLineNo = 0)
    {
        parent::__construct(',', $iLineNo);
    }
    /**
     * @return string
     */
    public function render(OutputFormat $oOutputFormat)
    {
        return $oOutputFormat->implode(' ', $this->aComponents);
    }
}
