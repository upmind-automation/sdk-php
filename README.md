# [Upmind](https://github.com/upmind-automation) - SDK

[![Latest Version on Packagist](https://img.shields.io/packagist/v/upmind/sdk.svg?style=flat-square)](https://packagist.org/packages/upmind/sdk)

**This library is currently in beta and does not cover all features of the Upmind API.**

This SDK can be used to streamline PHP integrations with the Upmind API.

- [Requirements](#requirements)
- [Installation](#installation)
- [Usage](#usage)
  - [Getting Started](#getting-started)
  - [Exceptions](#exceptions)
  - [Pagination](#pagination)
  - [Relations](#relations)
  - [Creating Resources](#creating-resources)
- [Changelog](#changelog)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)
- [Upmind](#upmind)

## Requirements

- PHP 7.4, 8.0, 8.1, 8.2 or 8.3
- Composer
- [Upmind Starter](https://upmind.com/pricing) plan or higher

## Installation

```bash
composer require upmind/sdk
```

This library makes use of the [HTTPLUG](https://docs.php-http.org/en/latest/index.html) abstraction for making HTTP requests, using [discovery](https://docs.php-http.org/en/latest/discovery.html) to automatically detect an HTTP client to use. Because the library depends on the virtual package `psr/http-client-implementation` you will need to first install a compatible HTTP [client implementation](https://packagist.org/providers/psr/http-client-implementation) e.g., [php-http/guzzle7-adapter](https://packagist.org/packages/php-http/guzzle7-adapter).

It's possible to use any implementations of the following PSRs:
- [PSR-18 HTTP Client](https://www.php-fig.org/psr/psr-18/)
- [PSR-17 HTTP Factory](https://www.php-fig.org/psr/psr-17/)
- [PSR-3 Logger](https://www.php-fig.org/psr/psr-3/)

## Usage

### Getting Started

To use the SDK you will need to first create an API token in your Upmind admin area settings. You should also make note of your brand ID.

First you will need to create a `Config` instance with your API token and brand ID. Then, use that to create an instance of the `Api` client. Set the `debug` option to `true` to stream API requests and responses to STDERR; alternatively you can pass an alternative PSR-3 compliant logger when instantiating the API.

You can then get an instance of a service to start making API requests.

```php
use Upmind\Sdk\Api;
use Upmind\Sdk\Config;

$config = new Config(
    token: 'your-api-token',
    brandId: 'your-brand-id',
    withoutNotifications: true, // don't trigger notifications for create/update/delete requests
    debug: true, // stream api requests + responses to STDERR by default
);
$api = new Api($config);
$service = $api->clientService();

$clientId = '467029e9-d574-1484-680f-e10683283ed5';

$response = $service->getClient($clientId);
$clientData = $response->getResponseData();
// ...
```

### Exceptions

All exceptions thrown by this library implement the marker interface `Upmind\Sdk\Exceptions\UpmindSdkException`.

By default, API error (non-2xx) responses will throw an instance of `Upmind\Sdk\Exceptions\HttpException` which contains the API error response data. You can turn off HttpExceptions by instantiating `Config` with `restfulExceptions: false`,

#### HTTP Exceptions Enabled

With HTTP exceptions enabled (default), there is no need to inspect the HTTP code or response body to detect errors, as the SDK will throw an exception for any non-2xx HTTP response.

```php
use Upmind\Sdk\Api;
use Upmind\Sdk\Config;
use Upmind\Sdk\Exceptions\HttpException;
use Upmind\Sdk\Exceptions\ValidationException;

$config = new Config(
    token: 'your-api-token',
);
$api = new Api($config);
$service = $api->clientService();

try {
    $clientId = '467029e9-d574-1484-680f-e10683283ed5';

    $clientData = $service->getClient($clientId)->getResponseData();
} catch (ValidationException $e) {
    // HTTP 422 error containing an array of validation errors
    $error = $e->getApiError();
    $validationErrors = $e->getValidationErrors();
    // ...
} catch (HttpException $e) {
    // Any other HTTP error response
    $error = $e->getApiError();
    // ...
}
```

#### HTTP Exceptions Disabled

With HTTP exceptions disabled, you can inspect the ApiResponse to determine whether it succeeded or not.

```php
use Upmind\Sdk\Api;
use Upmind\Sdk\Config;

$config = new Config(
    token: 'your-api-token',
    restfulExceptions: false, // don't throw exceptions for API error responses
);
$api = new Api($config);
$service = $api->clientService();

$clientId = '467029e9-d574-1484-680f-e10683283ed5';

$response = $service->getClient($clientId);
if ($response->isSuccessful()) {
    $clientData = $response->getResponseData();
    // ...
} else {
    $error = $response->getResponseError();
    // ...
}
```

### Pagination

Most list requests will return paginated results. The SDK will allow you to pass a `QueryParams` object to control pagination by setting `limit` (default 10) and `offset` (default 0) query parameters.

```php
use Upmind\Sdk\Data\QueryParams;

$queryParams = QueryParams::new()
    ->setLimit(20) // returns up to 20 results
    ->setOffset(100); // skips the first 100 results

$clients = $api->clientService()
    ->listClients($queryParams)
    ->getResponseData();
foreach ($clients as $clientData) {
    $clientId = $clientData['id'];
    // ...
}
```

### Relations

Some resources have relationships with other resources. You can specify relationships to load by setting the `with` query parameter when making GET requests. This reduces the number of API requests needed to fetch related resources.

```php
use Upmind\Sdk\Data\QueryParams;

$clientId = '467029e9-d574-1484-680f-e10683283ed5';
$queryParams = QueryParams::new()
    ->setWith(['emails', 'addresses']); // load the client's emails and addresses

$clientData = $api->clientService()
    ->getClient($clientId, $queryParams)
    ->getResponseData();
foreach ($clientData['emails'] as $emailData) {
    // ...
}
foreach ($clientData['addresses'] as $addressData) {
    // ...
}
```

### Creating Resources

Create methods are typed with DTOs containing setter methods to help you identify which parameters are available. When a resource is created successfully, an `id` will be returned which can be used to fetch and manage the resource later.

```php
use Upmind\Sdk\Data\Services\CreateEmailParams;

$clientId = '467029e9-d574-1484-680f-e10683283ed5';
$createEmail = CreateEmailParams::new()
    ->setEmail('harry@upmind.com')
    ->setDefault(true);

$emailData = $api->emailService()
    ->createEmail($clientId, $createEmail)
    ->getResponseData();
$emailId = $emailData['id'];
// ...
```

### Manual Usage

Some resources may not have a corresponding service in the SDK. You can use the `Api` client to make requests manually to any endpoint. Here's an example showing how to import an existing order (contract product) into Upmind.

```php
use Upmind\Sdk\Data\BodyParams;

$clientId = '467029e9-d574-1484-680f-e10683283ed5';
$hostingServerId = 'e5750263-4647-9ed1-26a2-1053288d79e9'; // server provision configuration id
$hostingProductId = 'd6d97847-5d49-2153-2def-d163e080e253'; // catalogue product id
$premiumSupportProductId = 'd9860720-492e-710d-0d6b-8165d83d345e'; // catalogue product option id
$hostingLocationProductId = '84856376-2e90-516e-607a-e17d48302de9', // catalogue product attribute id

$body = BodyParams::new()
    ->setParam('category_slug', 'new_contract')
    ->setParam('client_id', $clientId)
    ->setParam('currency_code', 'GBP')
    ->setParam('manual_import', true) // setting to true allows us to override activation/due dates
    ->setParam('activation_date', '2022-05-01') // initial order activation date
    ->setParam('next_due_date', '2024-10-01') // current date the order is paid up until
    ->setParam('products', [
        [
            'product_id' => $hostingProductId,
            'quantity' => 1,
            'billing_cycle_months' => 6, // renews every 6 months
            'selling_price' => 35.99, // the net price of the base product
            'provision_configuration_id' => $hostingServerId,
            'provision_field_values' => [ // hosting product provision fields
                'domain' => 'example.com',
                'username' => 'example2',
            ],
            'options' => [
                [
                    'product_id' => $premiumSupportProductId,
                    'quantity' => 1,
                    'billing_cycle_months' => 6, // renews with the base product
                    'selling_price' => 30.00, // the net price of the option; this gets added to the base product price
                ]
            ],
            'attributes' => [
                [
                    'product_id' => $hostingLocationProductId,
                ]
            ]
        ]
    ]);

$responseData = $api->post('/api/admin/orders/quick', $body)->getResponseData();
$orderNumber = $responseData['number'];
$contractId = $responseData['contract_id'];
$contractProductId = $responseData['products'][0]['contracts_product_id'];
// ...
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

 - [Harry Lewis](https://github.com/uphlewis)
 - [Sam Burns](https://github.com/sam-bee)
 - [All Contributors](../../contributors)

## License

GNU General Public License version 3 (GPLv3). Please see [License File](LICENSE.md) for more information.

## Upmind

Sell, manage and support web hosting, domain names, ssl certificates, website builders and more with [Upmind.com](https://upmind.com/start).
