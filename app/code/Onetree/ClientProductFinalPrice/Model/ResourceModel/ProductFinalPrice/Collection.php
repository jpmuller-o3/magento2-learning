<?php

namespace Onetree\ClientProductFinalPrice\Model\ResourceModel\ProductFinalPrice;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;
use Onetree\ClientProductFinalPrice\Model\ProductFinalPrice as Model;
use Onetree\ClientProductFinalPrice\Model\ResourceModel\ProductFinalPrice as ResourceModel;

class Collection extends AbstractCollection
{
    /**
     * @var string
     */
    protected $_eventPrefix = 'onetree_final_price_collection';

    /**
     * Initialize collection model.
     */
    protected function _construct()
    {
        $this->_init(Model::class, ResourceModel::class);
    }
}
