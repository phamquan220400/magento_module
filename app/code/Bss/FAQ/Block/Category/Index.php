<?php

namespace Bss\FAQ\Block\Category;

use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory as CategoryCollection;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory as QuestionCollection;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class Index extends Template
{
    /**
     * @var CategoryCollection
     */
    protected CategoryCollection $_categoryCollection;
    /**
     * @var QuestionCollection
     */
    protected QuestionCollection $_questionCollection;

    /**
     * @param CategoryCollection $categoryCollectionFactory
     * @param QuestionCollection $questionCollectionFactory
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CategoryCollection $categoryCollectionFactory,
        QuestionCollection $questionCollectionFactory,
        Context            $context,
        array              $data = []
    )
    {
        $this->_categoryCollection = $categoryCollectionFactory;
        $this->_questionCollection = $questionCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return DataObject[]
     */
    public function getCategoryCollection(): array
    {
        $categoryCollection = $this->_categoryCollection->create();
        $categoryCollection->addFieldToSelect("*")
            ->addFieldToFilter('enable', true)->load();
        return $categoryCollection->getItems();
    }

    /**
     * @param $categoryId
     * @return string
     */
    public function getCategoryUrl($categoryId): string
    {
        return $this->getUrl("https://magento.test/faq/category/view/category_id/" . $categoryId);
    }

    /**
     * @param $categoryId
     * @return DataObject[]
     */
    public function getQuestionCollection($categoryId): array
    {
        $questionCollection = $this->_questionCollection->create();
        $questionCollection->addFieldToSelect("*")
            ->addFieldToFilter("category_id", $categoryId)
            ->addFieldToFilter("enable", 1)->load();
        return $questionCollection->getItems();
    }
}
