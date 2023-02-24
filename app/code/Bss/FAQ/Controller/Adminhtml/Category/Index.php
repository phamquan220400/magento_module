<?php
declare(strict_types=1);
namespace Bss\FAQ\Controller\Adminhtml\Category;

use \Magento\Backend\App\Action;
use \Magento\Framework\View\Result\PageFactory;
use \Magento\Backend\App\Action\Context;

class Index extends Action
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
    )
    {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }

    public function execute()
    {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bss_FAQ::FAQ');
        $resultPage->getConfig()->getTitle()->prepend(__('Category Menu'));
        return $resultPage;
    }
}
