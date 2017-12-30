<?php


namespace SuttonSilver\Testimonials\Block;

class TestimonialList  extends \Magento\Framework\View\Element\Template
{


    private $storeManager;
    private $collectionFactory;

    private $_collection;
    private $_limit = 12;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Store\Model\StoreManagerInterface $storeManager,
        \SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory $collectionFactory,
        array $data = []
    )
    {
        $this->storeManager = $storeManager;
        $this->collectionFactory = $collectionFactory;
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
            ->addStoreFilter($this->storeManager->getStore())
            ->setPageSize($this->getLimit()) // only get 10 products
            ->setCurPage(1)  // first page (means limit 0,10)
            ->setOrder('created_at','ASC');

        return $this;
    }

    public function getLoadedCollection()
    {
        $this->getCollection();
        return $this->_collection->load();
    }
}
