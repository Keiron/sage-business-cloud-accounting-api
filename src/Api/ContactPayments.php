<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class ContactPayments extends AbstractEndpoint
{
    /**
     * Return all contact payments.
     *
     * @param array $parameters Query parameters
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/getContactPayments
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/contact_payments', $parameters)
        );
    }

    /**
     * Create a contact payment.
     *
     * @param string $transactionTypeId The transaction type of the payment
     * @param string $contactId The contact of the payment
     * @param string $bankAccountId The bank account of the payment
     * @param $date The date the payment was made
     * @param float $totalAmount The total amount of the payment
     * @param array $additionalAttributes Additional attributes of the contact payment schema to add
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/postContactPayments
     */
    public function create(
        string $transactionTypeId, string $contactId, string $bankAccountId, $date,
        float $totalAmount, array $additionalAttributes = []
    ): array
    {
        $attributes = array_merge([
            'transaction_type_id' => $transactionTypeId,
            'contact_id' => $contactId,
            'bank_account_id' => $bankAccountId,
            'date' => $this->castDate($date),
            'total_amount' => $totalAmount,
        ], $additionalAttributes);

        return $this->_jsonPost('/contact_payments', ['contact_payment' => $attributes]);
    }

    /**
     * Return a contact payment.
     *
     * @param string $id
     * @param array $parameters
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/getContactPaymentsKey
     */
    public function find(string $id, array $parameters = []): array
    {
        return $this->_get('/contact_payments/' . $id, $parameters);
    }

    /**
     * Update a contact payment.
     *
     * @param string $id
     * @param array $attributes
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/putContactPaymentsKey
     */
    public function update(string $id, array $attributes): array
    {
        return $this->_jsonPut('/contact_payments/' . $id, ['contact_payment' => $attributes]);
    }

    /**
     * Delete a contact payment.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/deleteContactPaymentsKey
     */
    public function delete(string $id): void
    {
        $this->_delete('/contact_payments/' . $id);
    }
}