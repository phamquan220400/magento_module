<?php

namespace Bss\FAQ\Model\ResourceModel\Collection\Question;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

/**
 *
 */
class Collection extends AbstractCollection
{
    /**
     *
     */
    public function _construct()
    {
        $this->_init(
            \Bss\FAQ\Model\Question::class,
            \Bss\FAQ\Model\ResourceModel\Question::class);
    }
}
