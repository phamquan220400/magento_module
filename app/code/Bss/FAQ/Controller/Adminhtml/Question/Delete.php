<?php
declare(strict_types=1);

namespace Bss\FAQ\Controller\Adminhtml\Question;

use Bss\FAQ\Api\QuestionRepositoryInterface;
use Bss\FAQ\Model\QuestionFactory;
use Exception;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

/**
 * class Delete
 */
class Delete extends Action
{
    /**
     * @var QuestionFactory
     */
    protected $questionFactory;
    /**
     * @var PageFactory
     */
    protected $resultPageFactory;
    /**
     * @var QuestionRepositoryInterface
     */
    protected $questionRepository;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     * @param QuestionFactory $questionFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(Context $context, PageFactory $resultPageFactory, QuestionFactory $questionFactory, QuestionRepositoryInterface $questionRepository)
    {
        $this->questionFactory = $questionFactory;
        $this->resultPageFactory = $resultPageFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $page = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('question_id');
        try {
            $model = $this->questionFactory->create()->load($id);
            $this->questionRepository->delete($model);
            $this->messageManager->addSuccessMessage(__("Deleted"));
        } catch (Exception $e) {
            $this->messageManager->addSuccessMessage(__("Cannot Delete Item"));
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
