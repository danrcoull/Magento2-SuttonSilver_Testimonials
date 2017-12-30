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
        $this->_init(\SuttonSilver\Testimonials\Model\ResourceModel\Testimonial::class);
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

    /**
     * Receive page store ids
     *
     * @return int[]
     */
    public function getStores()
    {
        return $this->hasData('stores') ? $this->getData('stores') : $this->getData('store_id');
    }

    public function getProfession()
    {
        return $this->getData(self::PROFESSION);
    }

    public function setProfession($profession)
    {
        return $this->setData(self::PROFESSION, $profession);
    }

    public function getImage()
    {
        return $this->getData(self::IMAGE);
    }

    public function setImage($imageName)
    {
        return $this->setData(self::IMAGE, $imageName);
    }

    public function getIsActive()
    {
        return $this->getData(self::ACTIVE);
    }

    public function setIsActive($isActive)
    {
        return $this->setData(self::ACTIVE, $isActive);
    }

    public function getIsVerified()
    {
        return $this->getData(self::VERIFIED);
    }

    public function setIsVerified($isVerified)
    {
        return $this->setData(self::VERIFIED, $isVerified);
    }

    public function getCustomerId()
    {
        return $this->getData(self::CUSTOMER);
    }

    public function setCustomerId($customerId)
    {
        return $this->setData(self::CUSTOMER, $customerId);
    }


}
