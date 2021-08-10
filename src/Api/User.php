<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Api;

use Olsgreen\AbstractApi\AbstractEndpoint;

class User extends AbstractEndpoint
{
    public function show(): array
    {
        return $this->_get('/user');
    }

    public function update($request)
    {

    }
}