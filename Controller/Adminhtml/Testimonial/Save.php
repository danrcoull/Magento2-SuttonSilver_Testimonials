<?php


namespace SuttonSilver\Testimonials\Controller\Adminhtml\Testimonial;

use Magento\Framework\Exception\LocalizedException;

class Save extends \Magento\Backend\App\Action
{

    protected $dataPersistor;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\App\Request\DataPersistorInterface $dataPersistor
    ) {
        $this->dataPersistor = $dataPersistor;
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        $data = $this->getRequest()->getPostValue();
        if ($data) {
            $id = $this->getRequest()->getParam('testimonial_id');
        
            $model = $this->_objectManager->create('SuttonSilver\Testimonials\Model\Testimonial')->load($id);
            if (!$model->getId() && $id) {
                $this->messageManager->addErrorMessage(__('This Testimonial no longer exists.'));
                return $resultRedirect->setPath('*/*/');
            }

            // Add custom image field to data
            if(isset($data['image']) && is_array($data['image'])){
                $data['image']=json_encode($data['image']);
            }

           // die(var_dump($data));

            $model->setData($data);
        
            try {
                $model->save();
                $this->messageManager->addSuccessMessage(__('You saved the Testimonial.'));
                $this->dataPersistor->clear('suttonsilver_testimonials_testimonial');
        
                if ($this->getRequest()->getParam('back')) {
                    return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $model->getId()]);
                }
                return $resultRedirect->setPath('*/*/');
            } catch (LocalizedException $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
            } catch (\Exception $e) {
                $this->messageManager->addExceptionMessage($e, __('Something went wrong while saving the Testimonial.'));
            }
        
            $this->dataPersistor->set('suttonsilver_testimonials_testimonial', $data);
            return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $this->getRequest()->getParam('testimonial_id')]);
        }
        return $resultRedirect->setPath('*/*/');
    }
}
