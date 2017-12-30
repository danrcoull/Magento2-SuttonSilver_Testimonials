<?php


namespace SuttonSilver\Testimonials\Api\Data;

interface TestimonialInterface
{

    const EMAIL = 'email';
    const UPDATED_AT = 'updated_at';
    const TESTIMONIAL = 'testimonial';
    const CREATED_AT = 'created_at';
    const NAME = 'name';
    const TESTIMONIAL_ID = 'testimonial_id';
    const PROFESSION = 'profession';
    const IMAGE = 'image';
    const ACTIVE = 'is_active';
    const VERIFIED = 'is_verified';
    const CUSTOMER = 'customer_id';


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
     * Get testimonial
     * @return string|null
     */
    public function getProfession();

    /**
     * Set testimonial
     * @param string $profession
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setProfession($profession);

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

    /**
     * Get updated_at
     * @return string|null
     */
    public function getImage();

    /**
     * Set updated_at
     * @param string $imageName
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setImage($imageName);

    /**
     * Get is_active
     * @return string|null
     */
    public function getIsActive();

    /**
     * Set is_active
     * @param string $isActive
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setIsActive($isActive);

    /**
     * Get is_verified
     * @return string|null
     */
    public function getIsVerified();

    /**
     * Set is_verified
     * @param string $isVerified
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setIsVerified($isVerified);

    /**
     * Get customer_id
     * @return string|null
     */
    public function getCustomerId();

    /**
     * Set customer_id
     * @param string $customerId
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setCustomerId($customerId);
}
