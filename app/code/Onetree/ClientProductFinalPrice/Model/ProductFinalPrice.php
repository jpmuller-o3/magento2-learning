<?php

namespace Onetree\ClientProductFinalPrice\Model;

use Magento\Framework\Model\AbstractModel;

class ProductFinalPrice extends AbstractModel
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'onetree_final_price_model';

    /**
     * Initialize magento model.
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init(ResourceModel\ProductFinalPrice::class);
    }
}
