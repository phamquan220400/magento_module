<?php

namespace Bss\FAQ\Model;

use Bss\FAQ\Api\Data\QuestionInterface;
use Bss\FAQ\Api\Data\QuestionSearchResultInterface;
use Bss\FAQ\Api\Data\QuestionSearchResultInterfaceFactory;
use Bss\FAQ\Api\QuestionRepositoryInterface;
use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory;
use Bss\FAQ\Model\ResourceModel\Question as QuestionResource;

use Magento\Framework\Api\SearchCriteria\CollectionProcessorInterface;
use Magento\Framework\Api\SearchCriteriaInterface;
use Magento\Framework\Exception\AlreadyExistsException;
use Magento\Framework\Exception\NoSuchEntityException;

class QuestionRepository implements QuestionRepositoryInterface
{
    /**
     * @var QuestionResource
     */
    protected QuestionResource $questionResource;
    /**
     * @var QuestionFactory
     */
    protected QuestionFactory $questionFactory;
    /**
     * @var CollectionFactory
     */
    protected CollectionFactory $collectionFactory;
    /**
     * @var QuestionSearchResultInterfaceFactory
     */
    protected QuestionSearchResultInterfaceFactory $resultFactory;
    /**
     * @var CollectionProcessorInterface
     */
    protected CollectionProcessorInterface $collectionProcessor;

    /**
     * @param QuestionResource $questionResource
     * @param QuestionFactory $questionFactory
     * @param CollectionFactory $collectionFactory
     * @param QuestionSearchResultInterfaceFactory $resultFactory
     * @param CollectionProcessorInterface $collectionProcessor
     */
    public function __construct(
        QuestionResource                     $questionResource,
        QuestionFactory                      $questionFactory,
        CollectionFactory                    $collectionFactory,
        QuestionSearchResultInterfaceFactory $resultFactory,
        CollectionProcessorInterface         $collectionProcessor
    ) {
        $this->collectionFactory = $collectionFactory;
        $this->questionResource = $questionResource;
        $this->questionFactory = $questionFactory;
        $this->resultFactory = $resultFactory;
        $this->collectionProcessor = $collectionProcessor;
    }

    /**
     * @param $id
     * @return Question
     * @throws NoSuchEntityException
     */
    public function getQuestionById($id): Question
    {
        $question = $this->questionFactory->create();
        $this->questionResource->load($question, $id);
        if (!$question->getCategoryId()) {
            throw new NoSuchEntityException(__('Question with id %1 does not exist.', $id));
        }
        return $question;
    }

    /**
     * @param SearchCriteriaInterface $searchCriteria
     * @return QuestionSearchResultInterface
     */
    public function getList(SearchCriteriaInterface $searchCriteria): QuestionSearchResultInterface
    {
        $collection = $this->collectionFactory->create();
        $this->collectionProcessor->process($searchCriteria, ($collection));
        $searchResult = $this->resultFactory->create();
        $searchResult->setSearchCriteria($searchCriteria);
        $searchResult->setItems($collection->getItems());

        return $searchResult;
    }

    /**
     * @throws AlreadyExistsException
     */
    public function save(QuestionInterface $question): QuestionInterface
    {
        $this->questionResource->save($question);
        return $question;
    }

    /**
     * @param QuestionInterface $question
     * @return bool
     * @throws \Exception
     */
    public function delete(QuestionInterface $question): bool
    {
        $this->questionResource->delete($question);
        return true;
    }
}
