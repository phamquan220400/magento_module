<?php

namespace Bss\FAQ\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

/**
 *
 */
class Question extends AbstractDb
{
    /**
     * @return void
     */
    public function _construct()
    {
        $this->_init("question", "question_id");
    }
}
