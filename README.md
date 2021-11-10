<p align="center"><a href="https://www.larabug.com" target="_blank"><img src="https://www.larabug.com/images/larabug-logo-small.png" width="100"></a></p>

Your users do not always report errors, LaraBug does. LaraBug is a simple to use and implement error tracker built for the Laravel framework.

This repository contains the actual code on https://www.larabug.com

## Requirements

* PHP 8.0 or higher
* Git
* Composer
* MySQL (>=5.7) or PostgreSQL (>=9.4)

## Installation

```bash
git clone https://github.com/LaraBug/larabug-app.git
composer install

npm i
npm run watch
# or
npm run dev
```

Configure your database in the `.env` file and then run:

```bash
php artisan migrate
```

## Important to know

This project is created by me [back in 2016](https://laraveldaily.com/dennis-larabug-growing-faster-imagine/), it is very old, and the code doesn't even look remotely to what I code now. The point here
is that there are no tests, and some stuff might look cumbersome, however the code works beautifully and like intented. You're more than welcome to clean code
and generalize stuff better.

## Testing

```bash
./vendor/bin/pest
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](.github/CONTRIBUTING.md) for details.

## Sponsor

We appreciate sponsors, we still maintain this repository, server, emails and domain. [You can do that here](https://github.com/sponsors/Cannonb4ll).
Each sponsor gets listed on the LaraBug sponsor page and when chosen the right tier you will be listed as official sponsor.

## Credits

- [ploi.io](https://ploi.io/?ref=larabug-app-github)
- [Cannonb4ll](https://github.com/cannonb4ll)
- [SebastiaanKloos](https://github.com/SebastiaanKloos)
- [Spatie Skeleton Package](https://github.com/spatie/package-skeleton-laravel)
- [Filament Admin](https://filamentadmin.com/?ref=https://github.com/LaraBug/larabug-app)

## License

The GPL-3.0 License (GPL-3.0). Please see [License File](LICENSE.md) for more information.
