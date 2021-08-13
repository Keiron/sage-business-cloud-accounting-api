<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class PurchaseInvoices extends AbstractEndpoint
{
    /**
     * Return all purchase invoices.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/getPurchaseInvoices
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/purchase_invoices', $parameters)
        );
    }

    /**
     * Create a purchase invoice.
     *
     * @param string $contactId            The contact the purchase invoice relates to
     * @param mixed  $date                 The date of the invoice
     * @param mixed  $dueDate              The due date of the invoice
     * @param array  $invoiceLines         The invoice lines of the invoice
     * @param array  $additionalAttributes Additional attributes of the invoice schema to add
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/postPurchaseInvoices
     */
    public function create(
        string $contactId,
        $date,
        $dueDate,
        array $invoiceLines,
        array $additionalAttributes = []
    ): array {
        $attributes = array_merge([
            'contact_id'        => $contactId,
            'date'              => $this->castDate($date),
            'due_date'          => $this->castDate($dueDate),
            'invoice_lines'     => $invoiceLines,
        ], $additionalAttributes);

        return $this->_jsonPost('/purchase_invoices', ['purchase_invoice' => $attributes]);
    }

    /**
     * Update a purchase invoice.
     *
     * @param string $id
     * @param array  $attributes
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/putPurchaseInvoicesKey
     */
    public function update(string $id, array $attributes): array
    {
        return $this->_jsonPut('/purchase_invoices/'.$id, ['purchase_invoice' => $attributes]);
    }

    /**
     * Return a purchase invoice.
     *
     * @param string $id
     * @param array  $parameters
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/getPurchaseInvoicesKey
     */
    public function find(string $id, array $parameters = []): array
    {
        return $this->_get('/purchase_invoices/'.$id, $parameters);
    }

    /**
     * Delete a purchase invoice.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/deletePurchaseInvoicesKey
     */
    public function delete(string $id): void
    {
        $this->_delete('/purchase_invoices/'.$id);
    }

    /**
     * Release a draft purchase invoice.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-purchases/#operation/postPurchaseInvoicesKeyRelease
     */
    public function release(string $id): void
    {
        $this->_post('/purchase_invoices/'.$id.'/release');
    }
}
