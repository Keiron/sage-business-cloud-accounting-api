<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class TransactionTypes extends AbstractEndpoint
{
    /**
     * Return all transaction types.
     *
     * @param array $parameters
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/accounting/#tag/Transaction-Types
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/transaction_types', $parameters)
        );
    }
}