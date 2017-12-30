<?php

namespace SuttonSilver\Testimonials\Controller\Adminhtml\Testimonial;
use Magento\Framework\Controller\ResultFactory;
use Magento\Backend\App\Action;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Exception\LocalizedException;
use Magento\Framework\Filesystem;
use Magento\MediaStorage\Model\File\UploaderFactory;

class Upload extends Action
{
    protected $fileSystem;

    protected $uploaderFactory;

    protected $allowedExtensions = ['jpeg','jpg','png','gif'];

    protected $fileId = 'image';


    public function __construct(
        Action\Context $context,
        Filesystem $fileSystem,
        UploaderFactory $uploaderFactory
    ) {
        $this->fileSystem = $fileSystem;
        $this->uploaderFactory = $uploaderFactory;
        parent::__construct($context);
    }


    /**
     * Upload file controller action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {


        $destinationPath = $this->getDestinationPath();

        try {
            $uploader = $this->uploaderFactory->create(['fileId' => $this->fileId])
                ->setAllowCreateFolders(true)
                ->setAllowedExtensions($this->allowedExtensions)
                ->addValidateCallback('validate', $this, 'validateFile');

            $result = $uploader->save($destinationPath);
            if (!$result) {
                throw new LocalizedException(
                    __('File cannot be saved to path: $1', $destinationPath)
                );
            }
            $result['url'] = '/pub/media/wysiwyg/testimonials/'.$result['name'];


        } catch (\Exception $e) {
            $result = ['error' => $e->getMessage(), 'errorcode' => $e->getCode()];
        }

        return $this->resultFactory->create(ResultFactory::TYPE_JSON)->setData($result);
    }

    public function getDestinationPath()
    {
        return $this->fileSystem
            ->getDirectoryWrite(DirectoryList::MEDIA)
            ->getAbsolutePath('/wysiwyg/testimonials');
    }
}
?>