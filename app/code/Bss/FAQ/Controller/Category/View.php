<?php

namespace Bss\FAQ\Controller\Category;

use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\View\Result\PageFactory as Page;

class View extends Action
{
    /**
     * @var Page
     */
    protected Page $pageFactory;

    /**
     * @param Context $context
     * @param Page $pageFactory
     */
    public function __construct(
        Context $context,
        Page    $pageFactory
    ) {
        $this->pageFactory = $pageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\App\ResponseInterface|\Magento\Framework\Controller\ResultInterface|\Magento\Framework\View\Result\Page
     */
    public function execute()
    {
        $page = $this->pageFactory->create();
        $page->getConfig()->getTitle()->prepend(__("Category"));
        $page->getConfig()->getTitle()->set(__("Category View"));
        return $page;
    }
}
