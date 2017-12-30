<?php


namespace SuttonSilver\Testimonials\Model\ResourceModel\Testimonial;
use SuttonSilver\Testimonials\Model\ResourceModel\AbstractCollection;
use SuttonSilver\Testimonials\Api\Data\TestimonialInterface;
class Collection extends AbstractCollection
{

    /**
     * @var string
     */
    protected $_idFieldName = 'testimonial_id';

    /**
     * Event prefix
     *
     * @var string
     */
    protected $_eventPrefix = 'testimonial_collection';

    /**
     * Event object
     *
     * @var string
     */
    protected $_eventObject = 'testimonial_collection';


    protected function _afterLoad()
    {
        $entityMetadata = $this->metadataPool->getMetadata(TestimonialInterface::class);

        $this->performAfterLoad('suttonsilver_testimonials_store', $entityMetadata->getLinkField());

        return parent::_afterLoad();
    }

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(
            'SuttonSilver\Testimonials\Model\Testimonial',
            'SuttonSilver\Testimonials\Model\ResourceModel\Testimonial'
        );

        $this->_map['fields']['store'] = 'store_table.store_id';
        $this->_map['fields']['testimonial_id'] = 'main_table.testimonial_id';
    }

    /**
     * Add filter by store
     *
     * @param int|array|\Magento\Store\Model\Store $store
     * @param bool $withAdmin
     * @return $this
     */
    public function addStoreFilter($store, $withAdmin = true)
    {
        $this->performAddStoreFilter($store, $withAdmin);

        return $this;
    }

    /**
     * Join store relation table if there is store filter
     *
     * @return void
     */
    protected function _renderFiltersBefore()
    {
        $entityMetadata = $this->metadataPool->getMetadata(TestimonialInterface::class);
        $this->joinStoreRelationTable('suttonsilver_testimonials_store', $entityMetadata->getLinkField());
    }
}
