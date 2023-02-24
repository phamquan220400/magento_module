<?php

namespace Bss\FAQ\Block\Adminhtml\Category\Button;
use Magento\Catalog\Block\Adminhtml\Product\Edit\Button\Generic;

class Reset extends Generic
{
    /**
     * @return array
     */
    public function getButtonData(): array
    {
        return [
            'label' => __('Reset'),
            'class' => 'reset',
            'on_click' => 'location.reload();',
            'sort_order' => 30,
        ];
    }
}
