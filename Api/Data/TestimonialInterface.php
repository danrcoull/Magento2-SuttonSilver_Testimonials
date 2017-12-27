<?php


namespace SuttonSilver\Testimonials\Api\Data;

interface TestimonialInterface
{

    const EMAIL = 'email';
    const UPDATED_AT = 'updated_at';
    const TESTIMONIAL = 'testimonial';
    const CREATED_AT = 'created_at';
    const ENTITY_ID = 'entity_id';
    const NAME = 'name';
    const STORE_ID = 'store_id';
    const TESTIMONIAL_ID = 'testimonial_id';


    /**
     * Get testimonial_id
     * @return string|null
     */
    public function getTestimonialId();

    /**
     * Set testimonial_id
     * @param string $testimonial_id
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTestimonialId($testimonialId);

    /**
     * Get entity_id
     * @return string|null
     */
    public function getEntityId();

    /**
     * Set entity_id
     * @param string $entity_id
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setEntityId($entity_id);

    /**
     * Get name
     * @return string|null
     */
    public function getName();

    /**
     * Set name
     * @param string $name
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setName($name);

    /**
     * Get email
     * @return string|null
     */
    public function getEmail();

    /**
     * Set email
     * @param string $email
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setEmail($email);

    /**
     * Get testimonial
     * @return string|null
     */
    public function getTestimonial();

    /**
     * Set testimonial
     * @param string $testimonial
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTestimonial($testimonial);

    /**
     * Get store_id
     * @return string|null
     */
    public function getStoreId();

    /**
     * Set store_id
     * @param string $store_id
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setStoreId($store_id);

    /**
     * Get created_at
     * @return string|null
     */
    public function getCreatedAt();

    /**
     * Set created_at
     * @param string $created_at
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at);

    /**
     * Get updated_at
     * @return string|null
     */
    public function getUpdatedAt();

    /**
     * Set updated_at
     * @param string $updated_at
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setUpdatedAt($updated_at);
}
