<?php


namespace SuttonSilver\Testimonials\Block;

use Magento\Framework\View\Element\Template;
use Magento\Customer\Api\Data\CustomerInterface;
use Magento\Customer\Helper\View as CustomerViewHelper;



class CreateTestimonial  extends \Magento\Framework\View\Element\Template
{
    protected $_formKey;

    protected $_storeManager;
    protected $_customerSession;
    protected $_customerViewHelper;

    public function __construct(Template\Context $context,
                                \Magento\Framework\Data\Form\FormKey $formKey,
                                \Magento\Customer\Model\Session $customerSession,
                                CustomerViewHelper $customerViewHelper,
                                \Magento\Store\Model\StoreManagerInterface $storeManager,
                                array $data = [])
    {

        $this->_storeManager = $storeManager;
        $this->_customerSession = $customerSession;
        $this->_customerViewHelper = $customerViewHelper;

        $this->_formKey = $formKey;
        parent::__construct($context, $data);
    }

    public function getFormKey()
    {
        return $this->_formKey->getFormKey();
    }

    public function getCustomer(){
        return $this->_customerSession->getCustomer();
    }

    public function getCurrentStoreId() {
        return $this->_storeManager->getStore()->getStoreId();
    }

    public function getFormAction()
    {
        // companymodule is given in routes.xml
        // controller_name is folder name inside controller folder
        // action is php file name inside above controller_name folder

        return $this->getUrl('testimonials/post/index');
        // here controller_name is manage, action is contact
    }
}