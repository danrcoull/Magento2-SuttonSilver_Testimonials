<?php


namespace SuttonSilver\Testimonials\Api;

use Magento\Framework\Api\SearchCriteriaInterface;

interface TestimonialRepositoryInterface
{


    /**
     * Save Testimonial
     * @param \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function save(
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
    );

    /**
     * Retrieve Testimonial
     * @param string $testimonialId
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getById($testimonialId);

    /**
     * Retrieve Testimonial
     * @param string $email
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getByEmail($email);

    /**
     * Retrieve Testimonial matching the specified criteria.
     * @param \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialSearchResultsInterface
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $searchCriteria
    );

    /**
     * Delete Testimonial
     * @param \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
     * @return bool true on success
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function delete(
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
    );

    /**
     * Delete Testimonial by ID
     * @param string $testimonialId
     * @return bool true on success
     * @throws \Magento\Framework\Exception\NoSuchEntityException
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function deleteById($testimonialId);
}
