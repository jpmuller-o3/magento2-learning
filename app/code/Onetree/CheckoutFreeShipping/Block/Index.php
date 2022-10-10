<?php

namespace Onetree\CheckoutFreeShipping\Block;

use Magento\Framework\View\Element\Template;

class Index extends Template
{
    public function __construct(
        private \Magento\Framework\View\Element\Template\Context $context,
        private \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig,
        array $data = []
    ) {
        parent::__construct($this->context, $data);
    }

    public function getConfigValue($value = '')
    {
        return $this->scopeConfig->getValue($value);
    }
}
