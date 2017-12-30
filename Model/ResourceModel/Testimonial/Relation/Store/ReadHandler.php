<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\Relation\Store;

use SuttonSilver\Testimonials\Model\ResourceModel\Testimonial;
use Magento\Framework\EntityManager\Operation\ExtensionInterface;

/**
 * Class ReadHandler
 */
class ReadHandler implements ExtensionInterface
{
    /**

     * @var Testimonial
     */
    protected $resourceTestimonial;

    /**
     * @param Testimonial $resourceTestimonial
     */
    public function __construct(
        Testimonial $resourceTestimonial
    ) {
        $this->resourceTestimonial = $resourceTestimonial;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @SuppressWarnings(PHPMD.UnusedFormalParameter)
     */
    public function execute($entity, $arguments = [])
    {
        if ($entity->getId()) {
            $stores = $this->resourceTestimonial->lookupStoreIds((int)$entity->getId());
            $entity->setData('store_id', $stores);
            $entity->setData('stores', $stores);
        }
        return $entity;
    }
}
