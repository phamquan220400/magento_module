<?php

namespace Bss\FAQ\Block\Category;

use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory as CategoryCollection;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory as QuestionCollection;
use Magento\Framework\View\Element\Template;
use Magento\Framework\View\Element\Template\Context;

class CategoryViewSidebar extends Template
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
     * @param CategoryCollection $collectionFactory
     * @param QuestionCollection $questionCollection
     * @param Context $context
     * @param array $data
     */
    public function __construct(
        CategoryCollection $collectionFactory,
        QuestionCollection $questionCollection,
        Context            $context,
        array              $data = []
    )
    {
        $this->_questionCollection = $questionCollection;
        $this->_categoryCollection = $collectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return CategoryViewSidebar
     */
    public function _prepareLayout(): CategoryViewSidebar
    {
        return parent::_prepareLayout();
    }

    /**
     * @return array
     */
    public function getAllCategory(): array
    {
        $categoryFactory = $this->_categoryCollection->create();
        $categoryFactory->addFieldToSelect('*')->addFieldToFilter('enable', 1)->load();
        return $categoryFactory->getItems();
    }

    /**
     * @param $category
     * @return int
     */
    public function countQuestion($category)
    {
        $questionFactory = $this->_questionCollection->create();
        $questionFactory->addFieldToSelect('*')
            ->addFieldToFilter('enable', 1)
            ->addFieldToFilter('category_id', $category)
            ->load();
        return $questionFactory->count();
    }

    /**
     * @param $categoryId
     * @return string
     */
    public function getCategoryUrl($categoryId): string
    {
        return $this->getUrl("https://magento.test/faq/category/view/category_id/" . $categoryId);
    }


}
