<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class BankAccounts extends AbstractEndpoint
{
    /**
     * Return all bank accounts.
     *
     * @param array $parameters Query parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/banking/#operation/getBankAccounts
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/bank_accounts', $parameters)
        );
    }
}
