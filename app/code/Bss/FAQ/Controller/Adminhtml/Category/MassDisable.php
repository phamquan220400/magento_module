<?php
declare(strict_types=1);
namespace Bss\FAQ\Controller\Adminhtml\Category;

use Bss\FAQ\Api\CategoryRepositoryInterface;
use Bss\FAQ\Model\CategoryFactory;
use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassDisable extends Action implements HttpPostActionInterface
{
    /**
     * @var Filter
     */
    protected Filter $filter;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $categoryCollection;
    /**
     * @var CategoryFactory
     */
    protected CategoryFactory $categoryFactory;
    /**
     * @var CategoryRepositoryInterface
     */
    protected CategoryRepositoryInterface $categoryRepository;

    /**
     * @param CategoryRepositoryInterface $categoryRepository
     * @param CollectionFactory $categoryCollection
     * @param CategoryFactory $categoryFactory
     * @param Filter $filter
     * @param Context $context
     */
    public function __construct(
        CategoryRepositoryInterface $categoryRepository,
        CollectionFactory           $categoryCollection,
        CategoryFactory             $categoryFactory,
        Filter                      $filter,
        Context                     $context
    )
    {
        $this->categoryFactory = $categoryFactory;
        $this->categoryCollection = $categoryCollection;
        $this->categoryRepository = $categoryRepository;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->categoryCollection->create());
        $count = 0;
        foreach ($collection as $category) {
            $category->setEnable(0);
            $this->categoryRepository->save($category);
            $count++;
        }
        if ($count != 0) {
            $this->messageManager->addSuccessMessage(__("Total %1 item(s) have been disable", $count));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
