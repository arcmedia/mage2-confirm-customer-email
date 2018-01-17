<?php

namespace Arcmedia\CustomerConfirm\Controller\Adminhtml\Index;

use Magento\Backend\App\Action;
use Magento\Backend\App\Action\Context;
use Arcmedia\CustomerConfirm\Helper\Customer as CustomerHelper;

/**
 * CustomerConfirm action
 */
class Index extends Action
{
    protected $customerHelper;
    
    public function __construct(
        Context $context,
        CustomerHelper $customerHelper
    )
    {
        parent::__construct($context);
        $this->customerHelper = $customerHelper;
    }
    
    /**
     * Confirm a customers email address
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $customerId = (int) $this->getRequest()->getParam('customer_id');
    	$this->customerHelper->confirmCustomerEmail($customerId);
        $resultRedirect = $this->resultRedirectFactory->create();
        $resultRedirect->setPath('customer/index/index');
        return $resultRedirect;
    }

    /**
     * Check permissions
     *
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('Arcmedia_CustomerConfirm::confirm_button');
    }
}
