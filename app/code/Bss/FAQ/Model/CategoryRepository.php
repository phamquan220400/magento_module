<?php

namespace Bss\FAQ\Model;

use Bss\FAQ\Api\CategoryRepositoryInterface;
use Bss\FAQ\Api\Data\CategoryInterface;
use Bss\FAQ\Api\Data\CategorySearchResultInterface;
use Bss\FAQ\Api\Data\CategorySearchResultInterfaceFactory;
use Bss\FAQ\Model\ResourceModel\Category as CategoryResource;
use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory;

use Exception;
use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class CategoryRepository implements CategoryRepositoryInterface
{
    /**
     * @var CategoryResource
     */
    protected CategoryResource $categoryResource;
    /**
     * @var CategoryFactory
     */
    protected CategoryFactory $categoryFactory;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;
    /**
     * @var CategorySearchResultInterfaceFactory
     */
    protected CategorySearchResultInterfaceFactory $resultFactory;

    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @param CategoryResource $categoryResource
     * @param CategoryFactory $categoryFactory
     * @param CollectionFactory $collectionFactory
     * @param CategorySearchResultInterfaceFactory $resultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        CategoryResource                     $categoryResource,
        CategoryFactory                      $categoryFactory,
        CollectionFactory                    $collectionFactory,
        CategorySearchResultInterfaceFactory $resultFactory,
        CollectionProcessorInterface         $collectionProcessor
    ) {
        $this->categoryResource = $categoryResource;
        $this->collectionFactory = $collectionFactory;
        $this->categoryFactory = $categoryFactory;
        $this->resultFactory = $resultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(CategoryInterface $category)
    {
        $this->categoryResource->save($category);
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return CategorySearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): CategorySearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, ($collection));
        $searchResult = $this->resultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @param $id
     * @return Category
     * @throws NoSuchEntityException
     */
    public function getCategoryById($id): Category
    {
        $category = $this->categoryFactory->create();
        $this->categoryResource->load($category, $id);
        if (!$category->getId()) {
            throw new NoSuchEntityException(__("Unable to find category with ID %1", $id));
        }
        return $category;
    }

    /**
     * @throws Exception
     */
    public function delete(CategoryInterface $category)
    {
        $this->categoryResource->delete($category);
    }
}
