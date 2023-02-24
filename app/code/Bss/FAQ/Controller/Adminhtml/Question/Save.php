<?php

namespace Bss\FAQ\Controller\Adminhtml\Question;

use Bss\FAQ\Api\QuestionRepositoryInterface;
use Bss\FAQ\Model\QuestionFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\View\Result\PageFactory;

class Save extends Action
{
    protected $resultPageFactory;
    protected $questionFactory;
    protected $formKeyValidator;
    protected $questionRepository;

    public function __construct(
        Context                     $context,
        PageFactory                 $resultPageFactory,
        QuestionFactory             $questionFactory,
        QuestionRepositoryInterface $questionRepository,
        Session                     $auth
    )
    {
        $this->_auth = $auth;
        $this->resultPageFactory = $resultPageFactory;
        $this->questionFactory = $questionFactory;
        $this->questionRepository = $questionRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPageFactory = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        $id = $this->getRequest()->getParam('question_id');
        $userData = $this->_auth->getUser();
        $userName = $userData->getFirstName() . ' ' . $userData->getLastName();
        try {
            $question = $this->questionFactory->create();
            if ($data && $id) {
                $question->load($id);
                $question->setCategoryId($data['category_id']);
                $question->setQuestion($data['question']);
                $question->setAnswer($data['answer']);
                $question->setEnable($data['enable']);
                $question->setSortOrder($data['sort_order']);
                $question->setUpdatedAt(date("Y-m-d H:m:sa"));
                $this->questionRepository->save($question);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            } else {
                $question->setCategoryId($data['category_id']);
                $question->setCreatedAt(date("Y-m-d H:m:sa"));
                $question->setQuestion($data['question']);
                $question->setAnswer($data['answer']);
                $question->setEnable($data['enable']);
                $question->setSortOrder($data['sort_order']);
                $question->setCreatedBy($userName);
                $this->questionRepository->save($question);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("We can't submit your request, Please try again."));
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $resultPageFactory->setPath('*/*/');
    }
}
