<?php

namespace Arcmedia\CustomerConfirm\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Framework\App\Helper\Context;
use Magento\Customer\Model\CustomerFactory;

class Customer extends AbstractHelper
{
    protected $customerFactory;
    
    /**
     * Constructor
     *
     * @param Context $context
     * @param CustomerFactory $customerFactory
     */
    public function __construct(
        Context $context,
        CustomerFactory $customerFactory
    ){
        parent::__construct($context);
        $this->customerFactory = $customerFactory;
    }

    public function confirmCustomerEmail(int $customerId)
    {
        $customer = $this->customerFactory->create()->load($customerId);
        if (!$customer->getId()) {
            return;
        }
        $customer->setConfirmation(null);
        $customer->save();
    }
}