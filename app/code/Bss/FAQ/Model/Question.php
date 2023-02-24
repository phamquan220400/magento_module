<?php

namespace Bss\FAQ\Model;

use Bss\FAQ\Api\Data\QuestionInterface;
use Magento\Framework\Model\AbstractModel;

/**
 *
 */
class Question extends AbstractModel implements QuestionInterface
{
    const CACHE_TAG = 'question';

    /**
     *
     */
    public function _construct()
    {
        $this->_init("Bss\FAQ\Model\ResourceModel\Question");
    }

    public function getQuestionId()
    {
        return $this->getData(self::QUESTION_ID);
    }

    public function setQuestionId($id)
    {
        $this->setData(self::QUESTION_ID, $id);
    }

    public function getCategoryId()
    {
        return $this->getData(self::CATEGORY_ID);
    }

    public function setCategoryId($categoryId)
    {
        $this->setData(self::CATEGORY_ID, $categoryId);
    }

    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    public function setCreatedAt($create)
    {
        $this->setData(self::CREATED_AT, $create);
    }

    public function getCreatedBy()
    {
        return $this->getData(self::CREATED_BY);
    }

    public function setCreatedBy($create)
    {
        $this->setData(self::CREATED_BY, $create);
    }

    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    public function setUpdatedAt($create)
    {
        $this->setData(self::UPDATED_AT, $create);
    }

    public function getSortOrder()
    {
        return $this->getData(self::SORT_ORDER);
    }

    public function setSortOrder($sortOder)
    {
        $this->setData(self::SORT_ORDER, $sortOder);
    }

    public function getEnable()
    {
        return $this->getData(self::ENABLE);
    }

    public function setEnable($enable)
    {
        $this->setData(self::ENABLE, $enable);
    }

    public function getQuestion()
    {
        return $this->getData(self::QUESTION);
    }

    public function setQuestion($question)
    {
        $this->setData(self::QUESTION, $question);
    }

    public function getAnswer()
    {
        return $this->getData(self::ANSWER);
    }

    public function setAnswer($answer)
    {
        $this->setData(self::ANSWER, $answer);
    }
}
