 # Sage Business Cloud Accounting PHP API Client
[![Latest Version](https://img.shields.io/github/release/olsgreen/sage-business-cloud-accounting-api.svg?style=flat-square)](https://github.com/olsgreen/sage-business-cloud-accounting-api/releases)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE.md)

This package provides a means easily of interacting with the Sage Business Cloud Accounting API.

## Installation

Add the client to your project using composer.

    composer require olsgreen/sage-business-cloud-accounting-api

## Usage
Sage require that you exchange your key & secret for an access token, this is then used to access the API. 

You can handle authentication and obtain an access token by using my other package that [olsgreen/oauth2-sage-business-cloud](https://github.com/olsgreen/oauth2-sage-business-cloud) for the [PHP Leagues oAuth2 Client package](https://oauth2-client.thephpleague.com).

## Examples

### Creating a basic Contact

```php
    $sage = new \Olsgreen\SageBusinessCloud\Accounting\Client([
        'access_token' => 'your_acess_token'
    ]);

    $contact = $sage->contacts()->create('Peter Jones', ['CUSTOMER']);

    // [
    //     "id" => "4d63c58e4a8943ff81a5b1809b98e58a",
    //     "displayed_as" => "Peter Jones",
    //     "$path" => "/contacts/4d63c58e4a8943ff81a5b1809b98e58a",
    //     "created_at" => "2021-08-10T15:57:42Z",
    //     "updated_at" => "2021-08-10T15:57:42Z",
    //     ...
    // ]
```

## Endpoint Support

Sage Business Cloud Accounting has numerous endpoints, we have only implemented a limited number so far:    

✅ Contacts

✅ Contact Payments

✅ Contact Allocations

✅ Contact Types

✅ Countries

✅ Sales Invoices

✅ Purchase Invoices

✅ Transaction Types

✅ Tax Rates

✅ Journals

➖ Ledger Accounts

➖ Bank Accounts

➖ User

See the [API Reference](https://developer.sage.com/accounting/reference/) for a full list.

# License

See attached license file

# Contributions

Pull requests welcome 🙂