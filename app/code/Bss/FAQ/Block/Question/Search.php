<?php

namespace Bss\FAQ\Block\Question;

use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory as CategoryCollection;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory as QuestionCollection;
use Magento\Framework\DataObject;
use Magento\Framework\View\Element\Template;

class Search extends Template
{
    /**
     * @var CategoryCollection
     */
    protected CategoryCollection $_categoryFactory;
    /**
     * @var QuestionCollection
     */
    protected QuestionCollection $_questionFactory;

    /**
     * @param CategoryCollection $categoryFactory
     * @param QuestionCollection $questionFactory
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        CategoryCollection $categoryFactory,
        QuestionCollection $questionFactory,
        Template\Context   $context,
        array              $data = []
    )
    {
        $this->_categoryFactory = $categoryFactory;
        $this->_questionFactory = $questionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getSearchResults(): array
    {
        $searchValue = $this->getRequest()->getParam('search-value');
        $categoryCollection = $this->_categoryFactory->create();
        $questionCollection = $this->_questionFactory->create();
        $categoryCollection->addFieldToSelect('*')
            ->addFieldToFilter(
                'title',
                [
                    ['like' => '%' . $searchValue . '%'],
                    ['like' => '%' . $searchValue],
                    ['like' => $searchValue . '%'],
                    ['like' => $searchValue],
                ]
            )
            ->addFieldToFilter('enable', 1)->load();
        $questionCollection->addFieldToSelect('*')
            ->addFieldToFilter('enable', 1)
            ->addFieldToFilter(
                ['question', 'answer'],
                [
                    ['like' => '%' . $searchValue . '%'],
                    ['like' => '%' . $searchValue],
                    ['like' => $searchValue . '%'],
                    ['like' => $searchValue],
                ]
            )->load();
        return [$categoryCollection->getItems(), $questionCollection->getItems(), $searchValue];
    }

    /**
     * @param $id
     * @return DataObject[]
     */
    public function getCategory($id): array
    {
        $categoryCollection = $this->_categoryFactory->create();
        $categoryCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('enable', 1)
            ->addFieldToFilter('category_id', $id)->load();
        return $categoryCollection->getItems();
    }

    /**
     * @param $categoryId
     * @return DataObject[]
     */
    public function getQuestion($categoryId): array
    {
        $questionCollection = $this->_questionFactory->create();
        $questionCollection
            ->addFieldToSelect('*')
            ->addFieldToFilter('enable', 1)
            ->addFieldToFilter('category_id', $categoryId)->load();
        return $questionCollection->getItems();
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
