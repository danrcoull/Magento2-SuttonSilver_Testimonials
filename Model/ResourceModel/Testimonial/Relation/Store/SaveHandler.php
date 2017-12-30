<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\Relation\Store;

use Magento\Framework\EntityManager\Operation\ExtensionInterface;
use SuttonSilver\Testimonials\Api\Data\TestimonialInterface;
use SuttonSilver\Testimonials\Model\ResourceModel\Testimonial;
use Magento\Framework\EntityManager\MetadataPool;

/**
 * Class SaveHandler
 */
class SaveHandler implements ExtensionInterface
{
    /**
     * @var MetadataPool
     */
    protected $metadataPool;

    /**
     * @var Testimonial
     */
    protected $resourceTestimonial;

    /**
     * @param MetadataPool $metadataPool
     * @param Testimonial $resourceTestimonial
     */
    public function __construct(
        MetadataPool $metadataPool,
        Testimonial $resourceTestimonial
    ) {
        $this->metadataPool = $metadataPool;
        $this->resourceTestimonial = $resourceTestimonial;
    }

    /**
     * @param object $entity
     * @param array $arguments
     * @return object
     * @throws \Exception
     */
    public function execute($entity, $arguments = [])
    {
        $entityMetadata = $this->metadataPool->getMetadata(TestimonialInterface::class);
        $linkField = $entityMetadata->getLinkField();

        $connection = $entityMetadata->getEntityConnection();

        $oldStores = $this->resourceTestimonial->lookupStoreIds((int)$entity->getId());
        $newStores = (array)$entity->getStores();

        $table = $this->resourceTestimonial->getTable('suttonsilver_testimonials_store');

        $delete = array_diff($oldStores, $newStores);
        if ($delete) {
            $where = [
                $linkField . ' = ?' => (int)$entity->getData($linkField),
                'store_id IN (?)' => $delete,
            ];
            $connection->delete($table, $where);
        }

        $insert = array_diff($newStores, $oldStores);
        if ($insert) {
            $data = [];
            foreach ($insert as $storeId) {
                $data[] = [
                    $linkField => (int)$entity->getData($linkField),
                    'store_id' => (int)$storeId,
                ];
            }
            $connection->insertMultiple($table, $data);
        }

        return $entity;
    }
}
