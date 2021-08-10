<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;
use Olsgreen\SageBusinessCloud\Accounting\Page;

class Journals extends AbstractEndpoint
{
    /**
     * Return all journals.
     *
     * @param array $parameters
     *
     * @return Page
     *
     * @see https://developer.sage.com/accounting/reference/accounting/#operation/getJournals
     */
    public function all(array $parameters = []): Page
    {
        return $this->createPage(
            $this->_get('/journals', $parameters)
        );
    }

    /**
     * Create a journal.
     *
     * @param mixed  $date                 The date of the journal
     * @param string $reference            A reference for the journal
     * @param array  $journalLines         The journal lines
     * @param array  $additionalAttributes Additional attributes of the contact schema to add
     *
     * @return array
     */
    public function create($date, string $reference, array $journalLines, array $additionalAttributes = []): array
    {
        $attributes = array_merge([
            'date'          => $this->castDate($date),
            'reference'     => $reference,
            'journal_lines' => $journalLines,
        ], $additionalAttributes);

        return $this->_jsonPost('/journals', ['journal' => $attributes]);
    }

    /**
     * Returns a journal.
     *
     * @param string $id
     * @param array  $parameters
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/accounting/#operation/getJournalsKey
     */
    public function find(string $id, array $parameters = []): array
    {
        return $this->_get('/journals/'.$id, $parameters);
    }

    /**
     * Delete a journal.
     *
     * @param string $id
     *
     * @see https://developer.sage.com/accounting/reference/accounting/#operation/deleteJournalsKey
     */
    public function delete(string $id): void
    {
        $this->_delete('/journals/'.$id);
    }

    /**
     * Reissues a journal.
     *
     * @param string $id
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/accounting/#operation/postJournalsKeyReissue
     */
    public function reissue(string $id): array
    {
        return $this->_post('/journals/'.$id.'/reissue');
    }
}
