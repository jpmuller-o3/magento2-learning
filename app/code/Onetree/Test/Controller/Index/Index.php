<?php

declare(strict_types=1);

namespace Onetree\Test\Controller\Index;

use Magento\Framework\App\Action\HttpGetActionInterface;
use Magento\Framework\Controller\Result\Forward;
use Magento\Framework\Controller\Result\ForwardFactory;

class Index implements HttpGetActionInterface
{
//    protected $forwardFactory;
    public function __construct(
        private ForwardFactory $forwardFactory,
    )
    {
//        $this->forwardFactory = $forwardFactory;
    }

    public function execute(): Forward
    {
        return $this->forwardFactory->create()->setController('item')->forward('list');
    }
}

