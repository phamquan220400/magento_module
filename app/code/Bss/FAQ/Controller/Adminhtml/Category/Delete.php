<?php
declare(strict_types=1);

namespace Bss\FAQ\Controller\Adminhtml\Category;

use Bss\FAQ\Api\CategoryRepositoryInterface as CategoryRepository;
use Bss\FAQ\Model\CategoryFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Delete extends Action
{
    /**
     * @var CategoryFactory
     */
    protected CategoryFactory $categoryFactory;
    /**
     * @var PageFactory
     */
    protected PageFactory $resultPageFactory;
    /**
     * @var CategoryRepository
     */
    protected CategoryRepository $_categoryRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param CategoryFactory $categoryFactory
     * @param CategoryRepository $categoryRepository
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, CategoryFactory $categoryFactory, CategoryRepository $categoryRepository)
    {
        $this->_categoryRepository = $categoryRepository;
        $this->categoryFactory = $categoryFactory;
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect
    {
        $page = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('category_id');
        try {
            if ($id) {
                $model = $this->categoryFactory->create();
                $model->load($id);
                $this->_categoryRepository->delete($model);
                $this->messageManager->addSuccessMessage(__("Delete Success"));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage($e);
        }
        return $page->setPath('*/*/index');
    }

    /**
     * @return bool
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }
}
