<?php


namespace SuttonSilver\Testimonials\Model\ResourceModel\Testimonial;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{

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
    }
}
