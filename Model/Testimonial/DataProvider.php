<?php


namespace SuttonSilver\Testimonials\Model\Testimonial;

use Magento\Framework\App\Request\DataPersistorInterface;
use SuttonSilver\Testimonials\Model\ResourceModel\Testimonial\CollectionFactory;

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    protected $loadedData;
    protected $dataPersistor;

    protected $collection;


    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param CollectionFactory $collectionFactory
     * @param DataPersistorInterface $dataPersistor
     * @param array $meta
     * @param array $data
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $collectionFactory,
        DataPersistorInterface $dataPersistor,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $collectionFactory->create();
        $this->dataPersistor = $dataPersistor;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $items = $this->collection->getItems();
        foreach ($items as $model) {
            $this->loadedData[$model->getId()] = $model->getData();
            /* For Modify  You custom image field data */
            if(!empty($this->loadedData[$model->getId()]['image'])){
                $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
                $storeManager = $objectManager->get('Magento\Store\Model\StoreManagerInterface');
                $currentStore = $storeManager->getStore();
                $media_url=$currentStore->getBaseUrl();

                $image_name=$this->loadedData[$model->getId()]['image'];
                unset($this->loadedData[$model->getId()]['image']);
                $this->loadedData[$model->getId()]['image']=json_decode($image_name);
            }
        }
        $data = $this->dataPersistor->get('suttonsilver_testimonials_testimonial');
        
        if (!empty($data)) {
            $model = $this->collection->getNewEmptyItem();
            $model->setData($data);
            $this->loadedData[$model->getId()] = $model->getData();
            $this->dataPersistor->clear('suttonsilver_testimonials_testimonial');
        }


        
        return $this->loadedData;
    }
}
