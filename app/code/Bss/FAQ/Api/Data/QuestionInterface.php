<?php

namespace Bss\FAQ\Api\Data;

use Magento\Framework\Api\ExtensibleDataInterface;

/**
 *
 */
interface QuestionInterface extends ExtensibleDataInterface
{
    const QUESTION_ID = 'question_id';
    const QUESTION = 'question';
    const ANSWER = 'answer';
    const CATEGORY_ID = 'category_id';
    const SORT_ORDER = 'sort_order';
    const CREATED_AT = 'created_at';
    const ENABLE = 'enable';
    const UPDATED_AT = 'updated_at';
    const CREATED_BY = "created_by";

    /**
     * @return mixed
     */
    public function getQuestionId();

    /**
     * @param $id
     * @return mixed
     */
    public function setQuestionId($id);

    /**
     * @return mixed
     */
    public function getCategoryId();

    /**
     * @param $categoryId
     * @return mixed
     */
    public function setCategoryId($categoryId);

    /**
     * @return mixed
     */
    public function getCreatedAt();

    /**
     * @param $create
     * @return mixed
     */
    public function setCreatedAt($create);

    /**
     * @return mixed
     */
    public function getCreatedBy();

    /**
     * @param $create
     * @return mixed
     */
    public function setCreatedBy($create);

    /**
     * @return mixed
     */
    public function getUpdatedAt();

    /**
     * @param $create
     * @return mixed
     */
    public function setUpdatedAt($create);

    /**
     * @return mixed
     */
    public function getSortOrder();

    /**
     * @param $sortOder
     * @return mixed
     */
    public function setSortOrder($sortOder);

    /**
     * @return mixed
     */
    public function getEnable();

    /**
     * @param $enable
     * @return mixed
     */
    public function setEnable($enable);

    /**
     * @return mixed
     */
    public function getQuestion();

    /**
     * @param $question
     * @return mixed
     */
    public function setQuestion($question);

    /**
     * @return mixed
     */
    public function getAnswer();

    /**
     * @return mixed
     */
    public function setAnswer($answer);

}
