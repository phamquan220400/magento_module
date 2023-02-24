<?php
declare(strict_types=1);
namespace Bss\FAQ\Controller\Adminhtml\Category;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Edit extends Action
{
    /**
     * @var bool|PageFactory
     */
    protected $resultPageFactory = false;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context  $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }

    public function execute()
    {
        $id = $this->getRequest()->getParam('category_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bss_FAQ::FAQ');
        if ($id == null) {
            $resultPage->getConfig()->getTitle()->prepend(__('New FAQ category'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit FAQ category'));
        }
        return $resultPage;
    }
}
