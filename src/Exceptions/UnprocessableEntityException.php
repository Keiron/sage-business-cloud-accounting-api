<?php

namespace Olsgreen\SageBusinessCloud\Accounting\Exceptions;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

class UnprocessableEntityException extends \Olsgreen\AbstractApi\Http\Exceptions\ClientException
{
    use DecodesResponseBodies;

    protected $errors = [];

    public function __construct(RequestInterface $request, ResponseInterface $response = null, \Exception $previous = null)
    {
        $message = 'Unprocessable Entity';

        $body = $this->decodeResponseBody($response);

        if (!empty($body)) {
            $message .= PHP_EOL.'The following errors were returned:';

            // Errors are returned as an array within the response
            // body in the following format:
            //[{
            //    "$severity": "error",
            //    "$dataCode": "RecordInvalid",
            //    "$message": "This field is required.",
            //    "$source": "line_items.tax_rate_id"
            //}]

            foreach ($body as $error) {
                $error['friendlyErrorMessage'] = $error['$message'];

                if ($error['$dataCode'] === 'RecordInvalid' && $error['$source'] !== 'base') {
                    $error['friendlyErrorMessage'] .= ' ('.$error['$source'].')';
                }

                $this->errors[] = $error;
                $message .= PHP_EOL.'- '.$error['friendlyErrorMessage'];
            }
        }

        parent::__construct($message, $request, $response, $previous);
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
