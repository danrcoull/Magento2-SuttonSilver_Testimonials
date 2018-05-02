<?php


namespace SuttonSilver\Testimonials\Block;

class TestimonialList  extends \Magento\Framework\View\Element\Template
{


    private $storeManager;
    private $collectionFactory;
    protected $_scopeConfig;

    private $_collection;
    private $_limit = 12;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory $collectionFactory,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    )
    {
        $this->storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
        $this->_scopeConfig = $scopeConfig;
        parent::__construct($context, $data);
    }

    public function getStoreId()
    {
        return $this->storeManager->getStore()->getId();
    }

    public function setLimit($limit)
    {
        $this->_limit = $limit;
        return $this;
    }

    public function getLimit(){
        return $this->_limit;
    }


    /**
     * @return string
     */
    private function getCollection()
    {
        $this->_collection = $this->collectionFactory->create()
            ->setPageSize($this->getLimit()) // only get 10 products
            ->setCurPage(1)  // first page (means limit 0,10)
            ->setOrder('created_at','ASC');

        return $this;
    }

    public function getLoadedCollection()
    {
        $this->getCollection();
        return $this->_collection;
    }

    public function getImage($type)
    {
        $url = '';
        $media = $mediaUrl = $this ->_storeManager-> getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA );

        $path = $this->_scopeConfig->getValue('testimonials/background/'.$type.'_background', \Magento\Store\Model\ScopeInterface::SCOPE_STORE);
        if($path != '') {
            $url = $media . '/testimonials/store/' . $path;
            return $url;
        }

        return false;
    }

}
