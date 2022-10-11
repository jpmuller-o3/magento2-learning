<?php

namespace Onetree\ClientProductFinalPrice\Plugin;

use Magento\Catalog\Model\Product;
use Magento\Catalog\Model\ProductRepository;
use Magento\Checkout\Controller\Cart\Add;
use Magento\Customer\Model\Session as CustomerSession;
use Magento\Checkout\Model\Session as CheckoutSession;
use Magento\Framework\App\Config\ScopeConfigInterface as ScopeConfigInterfaceAlias;
use Magento\Framework\App\ResponseInterface;
use Magento\Framework\Exception\CouldNotSaveException;
use Onetree\ClientProductFinalPrice\Model\ProductFinalPriceFactory;
use Onetree\ClientProductFinalPrice\Model\ResourceModel\ProductFinalPrice as ProductFinalPriceResourceModel;

class SaveAddedProductPricePlugin
{
    public function __construct(
        private CustomerSession $customerSession,
        private CheckoutSession $checkoutSession,
        private ProductFinalPriceFactory $productFinalPriceFactory,
        private ProductFinalPriceResourceModel $productFinalPriceResourceModel,
        private ProductRepository $productRepository,
        private ScopeConfigInterfaceAlias $scopeConfig,
    )
    { }


    /**
     * @param Add $subject
     * @param ResponseInterface $result
     * @return ResponseInterface
     */
    public function afterExecute(Add $subject, ResponseInterface $result): ResponseInterface
    {
        $params = $subject->getRequest()->getParams();

        /** @type Product $productData */
        try {
            $productData = $this->productRepository->getById($params['product']);
        } catch (\Exception $e) {
            throw new \Magento\Catalog\Model\Product\Exception('Can\'t get product info');
        }

        if ($this->customerSession->isLoggedIn()) {

            $allItems = $this->checkoutSession->getQuote()->getAllVisibleItems();
            $skuString = $this->scopeConfig->getValue('skuwatcher/skuwatcher/value');
            $skuCodesToWatch = strlen($skuString ?? '') ? explode(',', $skuString ) : [];
            try {
                foreach ($allItems as $item) {
                    if ($item->getProduct()->getId() == $params['product'] && in_array($productData->getSku(), $skuCodesToWatch)) {
                        $productFinalPriceModel = $this->productFinalPriceFactory->create();
                        $productFinalPriceModel->setData([
                            'customer_name' => $this->customerSession->getCustomer()->getName(),
                            'sku' => $productData->getSku(),
                            'final_price' => $item->getPriceInclTax()
                        ]);
                        $this->productFinalPriceResourceModel->save($productFinalPriceModel);
                        break;
                    }
                }

            } catch (\Exception $e) {
                throw new CouldNotSaveException('Error saving product final price after cart adding');
            }
        }
        return $result;
    }
}
