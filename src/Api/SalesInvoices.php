<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class SalesInvoices extends AbstractEndpoint
{
    /**
     * Returns all sales invoices.
     *
     * @param array $parameters Query parameters
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/getSalesInvoices
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/sales_invoices', $parameters)
        );
    }

    /**
     * Create a sales invoice.
     *
     * @param string $contactId The contact the sales invoice relates to
     * @param array $mainAddress The invoice address
     * @param mixed $date The date of the invoice
     * @param array $invoiceLines The invoice lines of the invoice
     * @param array $additionalAttributes Additional attributes of the invoice schema to add
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/getSalesInvoices
     */
    public function create(
        string $contactId, array $mainAddress, $date, array $invoiceLines, array $additionalAttributes = []
    ): array
    {
        $attributes = array_merge([
            'contact_id' => $contactId,
            'date' => $this->castDate($date),
            'invoice_lines' => $invoiceLines,
            'main_address' => $mainAddress,
        ], $additionalAttributes);

        return $this->_jsonPost('/sales_invoices', ['sales_invoice' => $attributes]);
    }

    /**
     * Updates a sales invoice.
     *
     * @param string $id The Sales Invoice Key.
     * @param array $attributes Attributes of the invoice schema to update
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/putSalesInvoicesKey
     */
    public function update(string $id, array $attributes): array
    {
        return $this->_jsonPut('/sales_invoices/' . $id, ['sales_invoice' => $attributes]);
    }

    /**
     * Return a sales invoice.
     *
     * @param string $id The Sales Invoice Key.
     * @param array $parameters Query parameters
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/getSalesInvoicesKey
     */
    public function find(string $id, array $parameters = []): array
    {
        return $this->_get('/sales_invoices/' . $id, $parameters);
    }

    /**
     * Voids a sales invoice.
     *
     * @param string $id The Sales Invoice Key.
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/deleteSalesInvoicesKey
     */
    public function void(string $id, string $void_reason): void
    {
        $parameters = [];

        if (!empty($void_reason)) {
            $parameters['void_reason'] = $void_reason;
        }

        $this->_delete('/sales_invoices/' . $id, $parameters);
    }

    /**
     * Release a sales invoice.
     *
     * @param string $id The Sales Invoice Key.
     *
     * @see https://developer.sage.com/accounting/reference/invoicing-sales/#operation/postSalesInvoicesKeyRelease
     */
    public function release(string $id): void
    {
        $this->_post('/sales_invoices/' . $id . '/release');
    }
}