<?php


namespace SuttonSilver\Testimonials\Controller\Post;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;

class Index extends \Magento\Framework\App\Action\Action
{

    protected $resultJsonFactory;
    protected $jsonHelper;
    protected $formKeyValidator;

    protected $fileSystem;

    protected $uploaderFactory;

    protected $allowedExtensions = ['jpeg','jpg','png','gif'];

    protected $fileId = 'image';

    protected $testimonialInterface;
    protected $testimonialRepoInterface;
    protected $_messageManager;

    /**
     * Constructor
     *
     * @param \Magento\Framework\App\Action\Context  $context
     * @param \Magento\Framework\Json\Helper\Data $jsonHelper
     */
    public function __construct(
        \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\Controller\Result\JsonFactory $resultJsonFactory,
        \Magento\Framework\Data\Form\FormKey\Validator $formKeyValidator,
        \Magento\Framework\Serialize\Serializer\Json $jsonHelper,
         Filesystem $fileSystem,
        UploaderFactory $uploaderFactory,
        \SuttonSilver\Testimonials\Api\Data\TestimonialInterface $testimonialInterface,
        \SuttonSilver\Testimonials\Api\TestimonialRepositoryInterface $testimonialRepoInterface
    ) {
        $this->resultJsonFactory = $resultJsonFactory;
        $this->jsonHelper = $jsonHelper;

        $this->testimonialInterface =$testimonialInterface;
        $this->testimonialRepoInterface =$testimonialRepoInterface;

        $this->formKeyValidator = $formKeyValidator;
        $this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;

        $this->_messageManager = $context->getMessageManager();
        parent::__construct($context);
    }

    /**
     * Execute view action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        if (!$this->getRequest()->isAjax()) {
            $this->getResponse()->setRedirect($this->_redirect->getRefererUrl());
        }

        if (!$this->formKeyValidator->validate($this->getRequest())) {
            $this->getResponse()->setRedirect($this->_redirect->getRefererUrl());
        }

        $post = $this->getRequest()->getParams();
        try {
            $tesimonial = $this->testimonialRepoInterface->getByEmail($post['email']);
            $stores = $tesimonial->getStores();
            if(in_array($post['store_id'], $stores))
            {
                $this->_messageManager->addSuccessMessage(__("Submitted Revission"));
                $tesimonial->setIsVerified(0);
                $tesimonial->setTestimonial($post['testimonial']);
            }else {
                $this->createNew($post);
            }

        }catch(\Exception $e){
            $this->createNew($post);
        }


        try{
            $this->testimonialRepoInterface->save($tesimonial);
        }catch(\Exception $e)
        {
            $this->_messageManager->addErrorMessage(__($e->getMessage()));
            return  $this->resultJsonFactory->create()->setData(['success' => false]);

        }

        try {
            $uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
                ->setAllowCreateFolders(true)
                ->setAllowedExtensions($this->allowedExtensions)
                ->addValidateCallback('validate', $this, 'validateFile');

            $result = $uploader->save($this->getDestinationPath());
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $this->getDestinationPath())
                );
            }
            $result['url'] = '/pub/media/wysiwyg/testimonials/'.$result['name'];


        } catch (\Exception $e) {
            $this->_messageManager->addErrorMessage(__($e->getMessage()));
            return  $this->resultJsonFactory->create()->setData(['success' => false]);
        }

        $this->_messageManager->addSuccessMessage(__("Testimonial Submitted Successfully"));


        /** You may introduce your own constants for this custom REST API */
        return  $this->resultJsonFactory->create()->setData(['success' => true]);
    }

    public function createNew($post)
    {
        $tesimonial  = $this->testimonialInterface;
        $tesimonial->setName($post['firstname']." ".$post['surname']);
        $tesimonial->setEmail($post['email']);
        $tesimonial->setIsActive(1);
        $tesimonial->setIsVerified(0);
        $tesimonial->setCustomerId($post['customer_id']);
        $tesimonial->setImage($this->jsonHelper->serialize($this->getRequest()->getFiles('image')));
        $tesimonial->setStores([$post['store_id']]);
        $tesimonial->setTestimonial($post['testimonial']);
        return $tesimonial;
    }


    public function getDestinationPath()
    {
        return $this->fileSystem
            ->getDirectoryWrite(DirectoryList::MEDIA)
            ->getAbsolutePath('/wysiwyg/testimonials');
    }


    /**
     * Create json response
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function jsonResponse($response = '')
    {
        return $this->getResponse()->representJson(
            $this->jsonHelper->serialize($response)
        );
    }
}
