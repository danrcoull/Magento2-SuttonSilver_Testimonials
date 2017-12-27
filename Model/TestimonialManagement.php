<?php


namespace SuttonSilver\Testimonials\Model;

class TestimonialManagement
{

    private $_testimonialRespository;
    private $_testimonial;

    public function __construct(
        \SuttonSilver\Testimonials\Api\TestimonialRepositoryInterface $testimonialRepository,
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
    )
    {
        $this->_testimonialRespository = $testimonialRepository;
        $this->_testimonial = $testimonial;
    }

    /**
     * {@inheritdoc}
     */
    public function postTestimonial($param)
    {
        $testimonial = $this->_testimonial;
        $this->_testimonial->setName($param['name']);
        $this->_testimonial->setEmail($param['email']);
        $this->_testimonial->setTestimonial($param['testimonial']);
        try {
            $testimonial = $this->_testimonialRespository->save($testimonial);
        }catch(\Exception $e)
        {
            return $e->getMessage();
        }

        return "success saved " . $testimonial->getEntityId();

    }

    /**
     * {@inheritdoc}
     */
    public function getTestimonial($param)
    {
        return 'hello api GET return the $param ' . $param;
    }

    /**
     * {@inheritdoc}
     */
    public function putTestimonial($param)
    {
        if(!isset($param['entity_id'])){
            return "Error Entity Id needs to be set" ;
        }
    }

    /**
     * {@inheritdoc}
     */
    public function deleteTestimonial($param)
    {
        return 'hello api DELETE return the $param ' . $param;
    }
}
