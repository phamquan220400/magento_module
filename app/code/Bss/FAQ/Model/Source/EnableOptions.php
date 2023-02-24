<?php

namespace Bss\FAQ\Model\Source;

class EnableOptions implements \Magento\Framework\Data\OptionSourceInterface
{
    public function toOptionArray()
    {

        return [
            ['label' => __('-- Please Select --'), 'value' => '','disable'=>'true'],
            ['label' => __('Enable'), 'value' => '1'],
            ['label' => __('Disable'), 'value' => '0'],
        ];
    }
}
