<?php

namespace Olsgreen\SageBusinessCloud\Accounting;

use Olsgreen\AbstractApi\AbstractClient;
use Olsgreen\AbstractApi\ManagesHttpAccessTokens;
use Olsgreen\SageBusinessCloud\Accounting\Api\BankAccounts;
use Olsgreen\SageBusinessCloud\Accounting\Api\ChartOfAccounts\LedgerAccounts;
use Olsgreen\SageBusinessCloud\Accounting\Api\ContactPayments;
use Olsgreen\SageBusinessCloud\Accounting\Api\Contacts;
use Olsgreen\SageBusinessCloud\Accounting\Api\PaymentMethods;
use Olsgreen\SageBusinessCloud\Accounting\Api\SalesInvoices;
use Olsgreen\SageBusinessCloud\Accounting\Api\TaxRates;
use Olsgreen\SageBusinessCloud\Accounting\Api\TransactionTypes;
use Olsgreen\SageBusinessCloud\Accounting\Api\User;

class Client extends AbstractClient
{
    use ManagesHttpAccessTokens;

    /**
     * Set this clients options from array.
     *
     * @param array $options
     */
    protected function configureFromArray(array $options): Client
    {
        if (isset($options['access_token'])) {
            $this->setAccessToken($options['access_token']);
        }

        $baseUri = 'https://api.accounting.sage.com/v3.1';

        $this->http->setBaseUri($baseUri);

        return $this;
    }

    public function bankAccounts(): BankAccounts
    {
        return new BankAccounts($this);
    }

    public function contacts(): Contacts
    {
        return new Contacts($this);
    }

    public function contactPayments(): ContactPayments
    {
        return new ContactPayments($this);
    }

    public function salesInvoices(): SalesInvoices
    {
        return new SalesInvoices($this);
    }

    public function ledgerAccounts(): LedgerAccounts
    {
        return new LedgerAccounts($this);
    }

    public function paymentMethods(): PaymentMethods
    {
        return new PaymentMethods($this);
    }

    public function taxRates(): TaxRates
    {
        return new TaxRates($this);
    }

    public function transactionTypes(): TransactionTypes
    {
        return new TransactionTypes($this);
    }

    public function user(): User
    {
        return new User($this);
    }
}
