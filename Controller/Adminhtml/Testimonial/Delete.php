<?php


namespace SuttonSilver\Testimonials\Controller\Adminhtml\Testimonial;

class Delete extends \SuttonSilver\Testimonials\Controller\Adminhtml\Testimonial
{

    /**
     * Delete action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Redirect $resultRedirect */
        $resultRedirect = $this->resultRedirectFactory->create();
        // check if we know what should be deleted
        $id = $this->getRequest()->getParam('testimonial_id');
        if ($id) {
            try {
                // init model and delete
                $model = $this->_objectManager->create('SuttonSilver\Testimonials\Model\Testimonial');
                $model->load($id);
                $model->delete();
                // display success message
                $this->messageManager->addSuccessMessage(__('You deleted the Testimonial.'));
                // go to grid
                return $resultRedirect->setPath('*/*/');
            } catch (\Exception $e) {
                // display error message
                $this->messageManager->addErrorMessage($e->getMessage());
                // go back to edit form
                return $resultRedirect->setPath('*/*/edit', ['testimonial_id' => $id]);
            }
        }
        // display error message
        $this->messageManager->addErrorMessage(__('We can\'t find a Testimonial to delete.'));
        // go to grid
        return $resultRedirect->setPath('*/*/');
    }
}
