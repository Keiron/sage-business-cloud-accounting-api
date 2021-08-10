<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class LedgerAccounts extends AbstractEndpoint
{
    /**
     * Return all ledger accounts.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/accounting-setup/#operation/getLedgerAccounts
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/ledger_accounts', $parameters)
        );
    }
}
