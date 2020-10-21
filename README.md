# Laravel Notifications Channel for Ubicual

This package makes it easy to send notifications using [Ubicual](https://www.ubicual.com/) with Laravel 7.x and 8.x

## Contents

- [Installation](#installation)
	- [Setting up the Ubicual service](#setting-up-your-ubicual-account)
- [Usage](#usage)
	- [On-Demand Notifications](#on-demand-notifications)
    - [Available Message methods](#available-message-methods)
- [Changelog](#changelog)
- [Testing](#testing)
- [Security](#security)
- [Contributing](#contributing)
- [Credits](#credits)
- [License](#license)


## Installation

You can install the package via composer:

``` bash
composer require kineticamobile/lubichannel
```

## Setting up your Ubicual account

Add your Ubicual Product Token and default originator (name or number of sender) to your `config/ubicual.php`:

```php
// config/ubicual.php
...
return [
    'api_token' => env('UBICUAL_API_TOKEN'),
    'from' => env('UBICUAL_FROM', 'Ubicual'),
    'base_url' => env('UBICUAL_BASE_URL', 'https://api.ubicual.com/api/v1/sms/send'),
];

...
```

## Usage

You can use the channel in your via() method inside the notification:

```php
use Illuminate\Notifications\Notification;
use Kineticamobile\Ubicual\UbicualMessage;

class AccountApproved extends Notification
{
    public function via($notifiable)
    {
        return ["ubicual"];
    }

    public function toUbicual($notifiable)
    {
        return (new UbicualMessage)->content("Your account was approved!");
    }
}
```

In your notifiable model, make sure to include a routeNotificationForUbicual() method, which returns a phone number or an array of phone numbers.

```php
public function routeNotificationForUbicual()
{
    return $this->phone_number;
}
```

### On-Demand Notifications
Sometimes you may need to send a notification to someone who is not stored as a "user" of your application. Using the Notification::route method, you may specify ad-hoc notification routing information before sending the notification:

```php
Notification::route('ubicual', '5555555555')
            ->notify(new InvoicePaid($invoice));
```

### Available Message methods
`from('')`: Accepts a phone number/sender name to use as the notification sender.. *Make sure to register the sender name at you Ubicual dashboard.*

`content('')`: Accepts a string value for the notification body.


## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Testing

``` bash
$ composer test
```

## Security

If you discover any security related issues, please email danielmaciasramos@gmail.com instead of using the issue tracker.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Credits

- [Daniel Macías](https://github.com/dmaciasr)
- [Raul Tierno](https://github.com/raultm)
- [Emilio Ortiz](https://github.com/branigan)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
