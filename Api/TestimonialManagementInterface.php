<?php


namespace SuttonSilver\Testimonials\Api;

interface TestimonialManagementInterface
{


    /**
     * POST for Testimonial api
     * @param string $param
     * @return string
     */
    public function postTestimonial($param);

    /**
     * GET for Testimonial api
     * @param string $param
     * @return string
     */
    public function getTestimonial($param);

    /**
     * PUT for Testimonial api
     * @param string $param
     * @return string
     */
    public function putTestimonial($param);

    /**
     * DELETE for Testimonial api
     * @param string $param
     * @return string
     */
    public function deleteTestimonial($param);
}
