<?php


namespace SuttonSilver\Testimonials\Model\ResourceModel;

class Testimonial extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{

    /**
     * Define resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('suttonsilver_testimonials_testimonial', 'testimonial_id');
    }
}
