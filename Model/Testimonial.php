<?php


namespace SuttonSilver\Testimonials\Model;

use SuttonSilver\Testimonials\Api\Data\TestimonialInterface;

class Testimonial extends \Magento\Framework\Model\AbstractModel implements TestimonialInterface
{

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('SuttonSilver\Testimonials\Model\ResourceModel\Testimonial');
    }

    /**
     * Get testimonial_id
     * @return string
     */
    public function getTestimonialId()
    {
        return $this->getData(self::TESTIMONIAL_ID);
    }

    /**
     * Set testimonial_id
     * @param string $testimonialId
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTestimonialId($testimonialId)
    {
        return $this->setData(self::TESTIMONIAL_ID, $testimonialId);
    }

    /**
     * Get entity_id
     * @return string
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Set entity_id
     * @param string $entity_id
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setEntityId($entity_id)
    {
        return $this->setData(self::ENTITY_ID, $entity_id);
    }

    /**
     * Get name
     * @return string
     */
    public function getName()
    {
        return $this->getData(self::NAME);
    }

    /**
     * Set name
     * @param string $name
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setName($name)
    {
        return $this->setData(self::NAME, $name);
    }

    /**
     * Get email
     * @return string
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Set email
     * @param string $email
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Get testimonial
     * @return string
     */
    public function getTestimonial()
    {
        return $this->getData(self::TESTIMONIAL);
    }

    /**
     * Set testimonial
     * @param string $testimonial
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setTestimonial($testimonial)
    {
        return $this->setData(self::TESTIMONIAL, $testimonial);
    }

    /**
     * Get store_id
     * @return string
     */
    public function getStoreId()
    {
        return $this->getData(self::STORE_ID);
    }

    /**
     * Set store_id
     * @param string $store_id
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setStoreId($store_id)
    {
        return $this->setData(self::STORE_ID, $store_id);
    }

    /**
     * Get created_at
     * @return string
     */
    public function getCreatedAt()
    {
        return $this->getData(self::CREATED_AT);
    }

    /**
     * Set created_at
     * @param string $created_at
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setCreatedAt($created_at)
    {
        return $this->setData(self::CREATED_AT, $created_at);
    }

    /**
     * Get updated_at
     * @return string
     */
    public function getUpdatedAt()
    {
        return $this->getData(self::UPDATED_AT);
    }

    /**
     * Set updated_at
     * @param string $updated_at
     * @return \SuttonSilver\Testimonials\Api\Data\TestimonialInterface
     */
    public function setUpdatedAt($updated_at)
    {
        return $this->setData(self::UPDATED_AT, $updated_at);
    }
}
