<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Exceptions\JsonEncodingException;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class Contacts extends AbstractEndpoint
{
    /**
     * Return all contacts.
     *
     * @param array $parameters Query parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/api/accounting/api/contacts/#operation/getContacts
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/contacts', $parameters)
        );
    }

    /**
     * Creates a contact.
     *
     * @param string        $name                 The contact's full name or business name
     * @param array<string> $contactTypeIds       The IDs of the Contact Types.
     * @param array         $additionalAttributes Additional attributes of the contact schema to add
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/postContacts
     */
    public function create(string $name, array $contactTypeIds, array $additionalAttributes = []): array
    {
        $attributes = array_merge([
            'name'             => $name,
            'contact_type_ids' => $contactTypeIds,
        ], $additionalAttributes);

        return $this->_jsonPost('/contacts', ['contact' => $attributes]);
    }

    /**
     * Update a contact.
     *
     * @param string $id         The Contact Key.
     * @param array  $attributes Attributes of the contacts schema to update
     *
     * @throws JsonEncodingException
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/putContactsKey
     */
    public function update(string $id, array $attributes): array
    {
        return $this->_jsonPut('/contacts/'.$id, $attributes);
    }

    /**
     * Return a contact.
     *
     * @param string $id         The Contact Key.
     * @param array  $parameters Query parameters
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/getContactsKey
     */
    public function find(string $id, array $parameters = []): ?array
    {
        return $this->_get('/contacts/'.$id, $parameters);
    }

    /**
     * Delete a contact.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/deleteContactsKey
     */
    public function delete(string $id)
    {
        return $this->_delete('/contacts/'.$id);
    }

    /**
     * Returns all contact types.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/getContactTypes
     */
    public function types(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/contact_types', $parameters)
        );
    }

    /**
     * Returns all countries.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/contacts/#operation/getCountries
     */
    public function countries(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/countries', $parameters)
        );
    }
}
