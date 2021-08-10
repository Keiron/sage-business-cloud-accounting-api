<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Exceptions;

use Psr\Http\Message\ResponseInterface;

trait DecodesResponseBodies
{
    public function decodeResponseBody(ResponseInterface $response)
    {
        if ($response->hasHeader('Content-Type') && $response->getHeader('Content-Type')[0] === 'application/json') {
            return json_decode((string) $response->getBody(), true);
        }

        $truncatedBody = substr((string) $response->getBody(), 0, 100);

        throw new \Exception('Could not decode body: '.$truncatedBody);
    }
}
