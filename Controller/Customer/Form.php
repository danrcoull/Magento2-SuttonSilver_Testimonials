<?php
namespace SuttonSilver\Testimonials\Controller\Customer;
use Magento\Framework\App\Action\Action;
use Magento\Framework\App\Action\Context;
use Magento\Framework\App\Config\ScopeConfigInterface;
use Magento\Framework\Registry;
use Magento\Framework\View\Result\PageFactory;

class Form extends Action {

    protected $resultPageFactory;

    public function __construct(
        Context $context, PageFactory $resultPageFactory) {
        $this->resultPageFactory = $resultPageFactory;
        parent::__construct($context);
    }

    /**
     * @return \Magento\Framework\Controller\Result\Forward|\Magento\Framework\View\Result\Page
     */
    public function execute() {
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->set("Customer Testimonials");
        //$resultPage->getConfig()->setDescription("Description");
       // $resultPage->getConfig()->setKeywords("Key Words");

        return $resultPage;
    }
}