<?php
declare(strict_types=1);
namespace Bss\FAQ\Controller\Adminhtml\Category;

use Bss\FAQ\Api\CategoryRepositoryInterface as CategoryRepository;
use Bss\FAQ\Model\ResourceModel\Collection\Category\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\Controller\ResultFactory;
use Magento\Ui\Component\MassAction\Filter;

class MassDelete extends Action
{
    protected $filter;
    protected $collectionFactory;
    protected $_categoryRepository;

    public function __construct(
        Context           $context,
        Filter            $filter,
        CollectionFactory $collectionFactory,
        CategoryRepository $categoryRepository
    ) {
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->_categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $collectionSize = $collection->getSize();
        foreach ($collection as $item) {
            $this->_categoryRepository->delete($item);
        }
        $this->messageManager->addSuccessMessage(__('A total of %1 element(s) have been deleted.', $collectionSize));
        $resultRedirect = $this->resultFactory->create(ResultFactory::TYPE_REDIRECT);
        return $resultRedirect->setPath('*/*/');
    }
    public function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }
}
