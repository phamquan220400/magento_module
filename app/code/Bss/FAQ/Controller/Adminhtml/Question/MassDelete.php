<?php
declare(strict_types=1);

namespace Bss\FAQ\Controller\Adminhtml\Question;

use Bss\FAQ\Api\QuestionRepositoryInterface;
use Bss\FAQ\Model\QuestionFactory;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Ui\Component\MassAction\Filter;

/**
 * class MassDelete
 */
class MassDelete extends Action implements HttpPostActionInterface
{
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;
    /**
     * @var Filter
     */
    protected Filter $filter;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;
    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;

    /**
     * @param QuestionFactory $questionFactory
     * @param Context $context
     * @param Filter $filter
     * @param CollectionFactory $collectionFactory
     * @param QuestionRepositoryInterface $questionRepository
     */
    public function __construct(QuestionFactory $questionFactory, Context $context, Filter $filter, CollectionFactory $collectionFactory, QuestionRepositoryInterface $questionRepository)
    {
        $this->questionFactory = $questionFactory;
        $this->filter = $filter;
        $this->collectionFactory = $collectionFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute()
    {
        $collection = $this->filter->getCollection($this->collectionFactory->create());
        $count = 0;
        foreach ($collection as $question) {
            $this->questionRepository->delete($question);
            $count++;
        }
        if ($count != 0) {
            $this->messageManager->addSuccessMessage(__("Total %1 questions have been deleted", $count));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }

    /**
     * @return bool
     */
    public function _isAllowed(): bool
    {
        return $this->_authorization->isAllowed('Bss_FAQ::FAQ');
    }
}
