<?php
declare(strict_types=1);

namespace Bss\FAQ\Controller\Adminhtml\Category;

use Bss\FAQ\Api\CategoryRepositoryInterface;
use Bss\FAQ\Model\CategoryFactory;
use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Magento\Backend\Model\Auth\Session;
use Magento\Framework\View\Result\PageFactory;

/**
 * @class Save
 */
class Save extends Action
{
    protected $resultPageFactory;
    protected $categoryFactory;
    protected $formKeyValidator;
    protected $categoryRepository;
    protected $_auth;

    public function __construct(
        Context                     $context,
        PageFactory                 $resultPageFactory,
        CategoryFactory             $categoryFactory,
        CategoryRepositoryInterface $categoryRepository,
        Session                     $auth
    )
    {
        $this->_auth = $auth;
        $this->resultPageFactory = $resultPageFactory;
        $this->categoryFactory = $categoryFactory;
        $this->categoryRepository = $categoryRepository;
        parent::__construct($context);
    }

    public function execute()
    {
        $resultPageFactory = $this->resultRedirectFactory->create();
        $id = $this->getRequest()->getParam('category_id');
        $data = $this->getRequest()->getPostValue();
        $userData = $this->_auth->getUser();
        $userName = $userData->getFirstName() . ' ' . $userData->getLastName();
        try {
            $category = $this->categoryFactory->create();
            if ($data && $id) {
                $category->load($id);
                $category->setTitle($data['title']);
                $category->setSortOrder($data['sort_order']);
                $category->setEnable($data['enable']);
                $category->setUpdatedAt(date("Y-m-d H:m:sa"));
                $this->categoryRepository->save($category);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            } else {
                $category->setTitle($data['title']);
                $category->setCreatedAt(date("Y-m-d H:m:sa"));
                $category->setSortOrder($data['sort_order']);
                $category->setEnable($data['enable']);
                $category->setCreatedBy($userName);
                $this->categoryRepository->save($category);
                $this->messageManager->addSuccessMessage(__("Data Saved Successfully."));
            }
        } catch (\Exception $e) {
            $this->messageManager->addErrorMessage(__("We can't submit your request, Please try again."));
            $this->messageManager->addErrorMessage(__($e->getMessage()));
        }
        return $resultPageFactory->setPath('*/*/');
    }
}
