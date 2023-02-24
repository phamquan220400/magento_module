<?php

namespace Bss\FAQ\Model\ResourceModel\Collection\Category;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init(
            "Bss\FAQ\Model\Category",
            "Bss\FAQ\Model\ResourceModel\Category");
    }
}
