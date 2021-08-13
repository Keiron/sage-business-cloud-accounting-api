<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class ContactAllocations extends AbstractEndpoint
{
    /**
     * Returns all contact allocations.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/getContactAllocations
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/contact_allocations', $parameters)
        );
    }

    /**
     * Creates a contact allocation.
     *
     * @param string $transactionTypeId
     * @param string $contactId
     * @param array $allocatedArtefacts
     * @param null $date
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/postContactAllocations
     */
    public function create(string $transactionTypeId, string $contactId, array $allocatedArtefacts = [], $date = null): array
    {
        return $this->_jsonPost('/contact_allocations', [
            'transaction_type_id' => $transactionTypeId,
            'contact_id' => $contactId,
            'allocated_artefacts' => $allocatedArtefacts,
            'date' => $this->castDate($date ?? now()),
        ]);
    }

    /**
     * Update a contact allocation.
     *
     * @param string $id
     * @param array $attributes
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/putContactAllocationsKey
     */
    public function update(string $id, array $attributes): array
    {
        return $this->_jsonPut('/contact_allocations/' . $id, $attributes);
    }

    /**
     * Return a contact allocation.
     *
     * @param string $id
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/getContactAllocationsKey
     */
    public function find(string $id, array $parameters = []): array
    {
        return $this->_get('/contact_allocations/' . $id);
    }

    /**
     * Delete a contact allocation.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/payments/#operation/deleteContactAllocationsKey
     */
    public function delete(string $id): void
    {
        $this->_delete('/contact_allocations/' . $id);
    }
}