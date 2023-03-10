<?php

namespace Bss\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Category extends AbstractDb
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init("category", "category_id");
    }
}
