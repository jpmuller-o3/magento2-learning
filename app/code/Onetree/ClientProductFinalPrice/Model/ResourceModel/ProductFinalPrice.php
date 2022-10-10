<?php

namespace Onetree\ClientProductFinalPrice\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class ProductFinalPrice extends AbstractDb
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'onetree_final_price_resource_model';

    /**
     * Initialize resource model.
     */
    protected function _construct()
    {
        $this->_init('onetree_final_price', 'id');
        $this->_useIsObjectNew = true;
    }
}
