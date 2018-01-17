<?php

namespace Arcmedia\CustomerConfirm\Block\Adminhtml\Customer\Edit;

use Magento\Customer\Block\Adminhtml\Edit\GenericButton;
use Magento\Framework\View\Element\UiComponent\Control\ButtonProviderInterface;

/**
 * Login as customer button
 */
class Confirm extends GenericButton implements ButtonProviderInterface
{
    /**
     * @var \Magento\Framework\AuthorizationInterface
     */
    protected $_authorization;

    /**
     * Constructor
     *
     * @param \Magento\Backend\Block\Widget\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param AccountManagementInterface $customerAccountManagement
     */
    public function __construct(
        \Magento\Backend\Block\Widget\Context $context,
        \Magento\Framework\Registry $registry
    ) {
        parent::__construct($context, $registry);
        $this->_authorization = $context->getAuthorization();
    }

    /**
     * @return array
     */
    public function getButtonData()
    {
        $customerId = $this->getCustomerId();
        $data = [];
        $canModify = $customerId && $this->_authorization->isAllowed('Arcmedia_CustomerConfirm::confirm_button');
        if ($canModify) {
            $data = [
                'label' => __('Confirm Customer Email'),
                'class' => 'confirm confirm-button',
                'on_click' => 'window.open( \'' . $this->getInvalidateTokenUrl() .
                    '\')',
                'sort_order' => 70,
            ];
        }
        return $data;
    }

    /**
     * @return string
     */
    public function getInvalidateTokenUrl()
    {
        return $this->getUrl('customerconfirm/index/index', ['customer_id' => $this->getCustomerId()]);
    }

}
