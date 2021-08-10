<?php

namespace Olsgreen\SageBusinessCloud\Accounting;

use DateTime;
use Olsgreen\AbstractApi\Http\Exceptions\HttpException;
use Olsgreen\SageBusinessCloud\Accounting\Exceptions\JsonEncodingException;
use Olsgreen\SageBusinessCloud\Accounting\Exceptions\UnprocessableEntityException;

class AbstractEndpoint extends \Olsgreen\AbstractApi\AbstractEndpoint
{
    protected function handleHttpException(HttpException $ex)
    {
        if ($ex->getResponse()->getStatusCode() === 422) {
            throw new UnprocessableEntityException($ex->getRequest(), $ex->getResponse(), $ex);
        }

        parent::handleHttpException($ex);
    }

    protected function createPage(array $response): Page
    {
        return Page::createFromResponseArray(
            $this->client, $response
        );
    }

    protected function castDate($date): string
    {
        if (!($date instanceof DateTime)) {
            $date = new DateTime($date);
        }

        return $date->format(DateTime::ATOM);
    }

    protected function prepareJsonRequest(array $body, array $headers)
    {
        $json = json_encode($body);

        if (json_last_error()) {
            throw new JsonEncodingException(json_last_error_msg());
        }

        $headers = array_merge(['Content-Type' => 'application/json'], $headers);

        return [$json, $headers];
    }

    protected function _jsonPost(string $uri, array $body, array $parameters = [], array $headers = []): array
    {
        [$json, $headers] = $this->prepareJsonRequest($body, $headers);

        return $this->_post($uri, $parameters, $json, $headers);
    }

    protected function _jsonPut(string $uri, array $body, array $parameters = [], array $headers = []): array
    {
        [$json, $headers] = $this->prepareJsonRequest($body, $headers);

        return $this->_put($uri, $parameters, $json, $headers);
    }
}