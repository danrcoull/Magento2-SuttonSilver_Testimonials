<?php


namespace SuttonSilver\Testimonials\Api\Data;

interface TestimonialSearchResultsInterface extends \Magento\Framework\Api\SearchResultsInterface
{


    /**
     * Get Testimonial list.
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface[]
     */
    public function getItems();

    /**
     * Set entity_id list.
     * @param \SuttonSilver\Testimonials\Api\Data\TestimonialInterface[] $items
     * @return $this
     */
    public function setItems(array $items);
}
