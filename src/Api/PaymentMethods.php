<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class PaymentMethods extends AbstractEndpoint
{
    /**
     * Return all payment methods.
     *
     * @param array $parameters Query parameters
     * @return Page
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/payment_methods', $parameters)
        );
    }
}