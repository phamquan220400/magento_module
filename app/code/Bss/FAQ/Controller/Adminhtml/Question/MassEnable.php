<?php

namespace Bss\FAQ\Controller\Adminhtml\Question;

use Bss\FAQ\Api\QuestionRepositoryInterface;
use Bss\FAQ\Model\QuestionFactory;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Framework\App\Action\HttpPostActionInterface;
use Magento\Ui\Component\MassAction\Filter;

class MassEnable extends Action implements HttpPostActionInterface
{
    /**
     * @var QuestionRepositoryInterface
     */
    protected QuestionRepositoryInterface $questionRepository;
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $questionCollection;
    /**
     * @var Filter
     */
    protected Filter $filter;

    /**
     * @param QuestionRepositoryInterface $questionRepository
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $questionCollection
     * @param Filter $filter
     * @param Context $context
     */
    public function __construct(
        QuestionRepositoryInterface $questionRepository,
        QuestionFactory             $questionFactory,
        CollectionFactory           $questionCollection,
        Filter                      $filter,
        Context                     $context
    )
    {
        $this->questionCollection = $questionCollection;
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        $this->filter = $filter;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect|\Magento\Framework\Controller\ResultInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function execute(): \Magento\Framework\Controller\ResultInterface|\Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\Result\Redirect
    {
        $collection = $this->filter->getCollection($this->questionCollection->create());
        $count = 0;
        foreach ($collection as $question) {
            $question->setEnable(1);
            $this->questionRepository->save($question);
            $count++;
        }
        if ($count != 0) {
            $this->messageManager->addSuccessMessage(__("Total %1 item(s) have been enable", $count));
        }
        return $this->resultRedirectFactory->create()->setPath('*/*/');
    }
}
