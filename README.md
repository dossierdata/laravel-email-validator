A more extensive email validator than the default provided by Laravel.
# Laravel Email Validator
The Laravel Email Validator extends the Laravel Validator with the `validate_email` rule.

## How do I install it?

The easiest way is via [Composer](https://getcomposer.org/).

To install the latest version of Laravel Email Validator, run the command below:

```
composer require dossierdata/laravel-email-validator
```

Then add the register the service provider in `config/app.php`:

```
'providers' => [
    ...
    Dossierdata\LaravelEmailValidator\ServiceProvider::class,
],
```

## Requirements

* Laravel 5.0 and up

## How do I use it?

There are currently four different rules that you can choose from:

- `rfc` - Validates that the supplied value complies with [RFC 5321](https://tools.ietf.org/html/rfc5321) and [RFC 5322](https://tools.ietf.org/html/rfc5322)
- `rfc_no_warning` - Same as the previous rule but will fail on warning 
- `spf:127.0.0.1` - Validate that the domain of the email has a correct SPF record and that the supplied IP-address/range is authorized for this domain 
- `dns` - Validates that the domain of the email actually exists by checking for an MX or DSN record 


Use is as a rule for Validator:

```php
<?php

// Rule without parameters will default to only checking RFC
$validator = \Validator::make([
    'email' => '.incorrect@email.nodomain'
], [
    'email' => 'validate_email',
]);

if ($validator->fails()) {
    dump($validator->errors());
}

// Rule with parameters
$validator = \Validator::make([
    'email' => '.incorrect@email.nodomain'
], [
    'email' => 'validate_email:rfc,spf:127.0.0.1,dns',
]);

if ($validator->fails()) {
    dump($validator->errors());
}
```

Use via dependency injection:

```php
<?php

$rules = [
    'rfc',
    'spf:127.0.0.1',
    'dns'
];

$emailValidator = app(\Dossierdata\LaravelEmailValidator\Contracts\EmailValidator::class);

if (!$emailValidator->validateValue('.incorrect@email.nodomain', $rules)) {
    dump($emailValidator->errors());
}
```

### Contributing
See the [CONTRIBUTING](.github/CONTRIBUTING.md) guidelines for this project.

### License
The dossierdata/laravel-email-validator is open-sourced software licensed under the [MIT license](LICENSE).