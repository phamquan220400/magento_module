<?php
declare(strict_types=1);
namespace Bss\FAQ\Controller\Adminhtml\Question;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * class Edit
 */
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
        Context     $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }

    /**
     * @return \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface
     */
    public function execute(): \Magento\Framework\View\Result\Page|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface
    {
        $id = $this->getRequest()->getParam('question_id');
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Bss_FAQ::FAQ');
        if ($id == null) {
            $resultPage->getConfig()->getTitle()->prepend(__('New FAQ Question'));
        } else {
            $resultPage->getConfig()->getTitle()->prepend(__('Edit FAQ Question'));
        }
        return $resultPage;
    }
}
