<?php


namespace SuttonSilver\Testimonials\Model;

use Magento\Framework\Api\SortOrder;
use Magento\Framework\Exception\CouldNotSaveException;
use Magento\Store\Model\StoreManagerInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use SuttonSilver\Testimonials\Api\Data\TestimonialInterfaceFactory;
use Magento\Framework\Reflection\DataObjectProcessor;
use Magento\Framework\Exception\CouldNotDeleteException;
use SuttonSilver\Testimonials\Api\Data\TestimonialSearchResultsInterfaceFactory;
use Magento\Framework\Api\DataObjectHelper;
use SuttonSilver\Testimonials\Model\ResourceModel\Testimonial as ResourceTestimonial;
use SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory as TestimonialCollectionFactory;
use SuttonSilver\Testimonials\Api\TestimonialRepositoryInterface;

class TestimonialRepository implements testimonialRepositoryInterface
{

    private $storeManager;

    protected $dataTestimonialFactory;

    protected $dataObjectProcessor;

    protected $dataObjectHelper;

    protected $searchResultsFactory;

    protected $testimonialFactory;

    protected $resource;

    protected $testimonialCollectionFactory;


    /**
     * @param ResourceTestimonial $resource
     * @param TestimonialFactory $testimonialFactory
     * @param TestimonialInterfaceFactory $dataTestimonialFactory
     * @param TestimonialCollectionFactory $testimonialCollectionFactory
     * @param TestimonialSearchResultsInterfaceFactory $searchResultsFactory
     * @param DataObjectHelper $dataObjectHelper
     * @param DataObjectProcessor $dataObjectProcessor
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ResourceTestimonial $resource,
        TestimonialFactory $testimonialFactory,
        TestimonialInterfaceFactory $dataTestimonialFactory,
        TestimonialCollectionFactory $testimonialCollectionFactory,
        TestimonialSearchResultsInterfaceFactory $searchResultsFactory,
        DataObjectHelper $dataObjectHelper,
        DataObjectProcessor $dataObjectProcessor,
        StoreManagerInterface $storeManager
    ) {
        $this->resource = $resource;
        $this->testimonialFactory = $testimonialFactory;
        $this->testimonialCollectionFactory = $testimonialCollectionFactory;
        $this->searchResultsFactory = $searchResultsFactory;
        $this->dataObjectHelper = $dataObjectHelper;
        $this->dataTestimonialFactory = $dataTestimonialFactory;
        $this->dataObjectProcessor = $dataObjectProcessor;
        $this->storeManager = $storeManager;
    }

    /**
     * {@inheritdoc}
     */
    public function save(
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
    ) {

        try {
            $testimonial->getResource()->save($testimonial);
        } catch (\Exception $exception) {
            throw new CouldNotSaveException(__(
                'Could not save the testimonial: %1',
                $exception->getMessage()
            ));
        }
        return $testimonial;
    }

    /**
     * {@inheritdoc}
     */
    public function getById($testimonialId)
    {
        $testimonial = $this->testimonialFactory->create();
        $testimonial->getResource()->load($testimonial, $testimonialId);
        if (!$testimonial->getId()) {
            throw new NoSuchEntityException(__('Testimonial with id "%1" does not exist.', $testimonialId));
        }
        return $testimonial;
    }


    /**
     * {@inheritdoc}
     */
    public function getByEmail($email)
    {
        $testimonial = $this->testimonialCollectionFactory->create();
        $testimonial = $testimonial->addFieldToFilter('email', $email)->getFirstItem();
        if (!$testimonial->getId()) {
            throw new NoSuchEntityException(__('Testimonial with email "%1" does not exist.', $email));
        }
        return $testimonial;
    }

    /**
     * {@inheritdoc}
     */
    public function getList(
        \Magento\Framework\Api\SearchCriteriaInterface $criteria
    ) {
        $collection = $this->testimonialCollectionFactory->create();
        foreach ($criteria->getFilterGroups() as $filterGroup) {
            foreach ($filterGroup->getFilters() as $filter) {
                if ($filter->getField() === 'store_id') {
                    $collection->addStoreFilter($filter->getValue(), false);
                    continue;
                }
                $condition = $filter->getConditionType() ?: 'eq';
                $collection->addFieldToFilter($filter->getField(), [$condition => $filter->getValue()]);
            }
        }
        
        $sortOrders = $criteria->getSortOrders();
        if ($sortOrders) {
            /** @var SortOrder $sortOrder */
            foreach ($sortOrders as $sortOrder) {
                $collection->addOrder(
                    $sortOrder->getField(),
                    ($sortOrder->getDirection() == SortOrder::SORT_ASC) ? 'ASC' : 'DESC'
                );
            }
        }
        $collection->setCurPage($criteria->getCurrentPage());
        $collection->setPageSize($criteria->getPageSize());
        
        $searchResults = $this->searchResultsFactory->create();
        $searchResults->setSearchCriteria($criteria);
        $searchResults->setTotalCount($collection->getSize());
        $searchResults->setItems($collection->getItems());
        return $searchResults;
    }

    /**
     * {@inheritdoc}
     */
    public function delete(
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonial
    ) {
        try {
            $testimonial->getResource()->delete($testimonial);
        } catch (\Exception $exception) {
            throw new CouldNotDeleteException(__(
                'Could not delete the Testimonial: %1',
                $exception->getMessage()
            ));
        }
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function deleteById($testimonialId)
    {
        return $this->delete($this->getById($testimonialId));
    }
}
