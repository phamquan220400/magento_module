<?php

namespace Bss\FAQ\Block\Question;

use Bss\FAQ\Model\ResourceModel\Collection\Question\CollectionFactory as QuestionCollection;
use Magento\Framework\View\Element\Template;

class View extends Template
{
    /**
     * @var QuestionCollection
     */
    protected QuestionCollection $questionCollection;

    /**
     * @param QuestionCollection $questionCollection
     * @param Template\Context $context
     * @param array $data
     */
    public function __construct(
        QuestionCollection $questionCollection,
        Template\Context   $context,
        array              $data = []
    ) {
        $this->questionCollection = $questionCollection;
        parent::__construct($context, $data);
    }

    /**
     * @return array
     */
    public function getQuestionData(): array
    {
        $questionId = $this->getRequest()->getParam('id');
        $question = $this->questionCollection->create();
        $question->addFieldtoSelect('*')
            ->addFieldToFilter('enable', 1)
            ->addFieldToFilter('question_id', $questionId)->load();
        return $question->getItems();
    }
}
