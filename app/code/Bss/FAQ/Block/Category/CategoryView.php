<?php

namespace Bss\FAQ\Block\Category;

use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory as QuestionCollection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CategoryView extends Template
{
    /**
     * @var QuestionCollection
     */
    protected QuestionCollection $_questionCollection;

    /**
     * @param QuestionCollection $questionCollection
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        QuestionCollection $questionCollection,
        Context            $context,
        array              $data = []
    ) {
        $this->_questionCollection = $questionCollection;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getCategoryInfo(): array
    {
        $id = $this->getRequest()->getParam('category_id');
        $question = $this->_questionCollection->create();
        $question->addFieldToSelect('*')
            ->addFieldToFilter('category_id', $id)
            ->addFieldToFilter('enable', 1)->load();
        return $question->getItems();
    }
}
