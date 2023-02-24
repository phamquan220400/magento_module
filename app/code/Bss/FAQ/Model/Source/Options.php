<?php

namespace Bss\FAQ\Model\Source;

use Magento\Framework\Data\OptionSourceInterface;

class Options implements OptionSourceInterface
{
    public function toOptionArray()
    {
        // TODO: Implement toOptionArray() method.
        return [
            ['label' => __('-- Please Select --'), 'value' => '','disable'=>'true'],
            ['label' => __('Yes'), 'value' => '1'],
            ['label' => __('No'), 'value' => '0'],
        ];
    }
}
