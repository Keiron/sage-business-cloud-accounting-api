<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\SageBusinessCloud\Accounting\AbstractEndpoint;

class User extends AbstractEndpoint
{
    /**
     * Returns the user.
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/user-businesses/#tag/User/paths/~1user/get
     */
    public function show(): array
    {
        return $this->_get('/user');
    }

    /**
     * Updates the user.
     *
     * @param array $attributes
     *
     * @return array
     *
     * @see https://developer.sage.com/accounting/reference/user-businesses/#tag/User/paths/~1user/put
     */
    public function update(array $attributes): array
    {
        return $this->_jsonPut('/user', $attributes);
    }
}
