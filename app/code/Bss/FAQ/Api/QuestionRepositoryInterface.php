<?php

namespace Bss\FAQ\Api;

use Bss\FAQ\Api\Data\QuestionInterface;
use Magento\Framework\Api\SearchCriteriaInterface;

interface QuestionRepositoryInterface
{
    /**
     * @param $id
     * @return mixed
     */
    public function getQuestionById($id);

    /**
     * @return mixed
     */
    public function getList(SearchCriteriaInterface $searchCriteria);

    /**
     * @param QuestionInterface $question
     * @return mixed
     */
    public function save(QuestionInterface $question);

    /**
     * @param QuestionInterface $question
     * @return mixed
     */
    public function delete(QuestionInterface $question);
}
