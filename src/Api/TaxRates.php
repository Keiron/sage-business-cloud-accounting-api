<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class TaxRates extends AbstractEndpoint
{
    /**
     * Return all tax rates.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/taxes/#operation/getTaxRates
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/tax_rates', $parameters)
        );
    }
}
