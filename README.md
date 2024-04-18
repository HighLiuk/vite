# Vite.js Manifest Parser for PHP

This library allows you to parse Vite.js manifest files easily and print tags in PHP to enjoy Hot Module Replacement (HMR).

## Installation

Use composer to install the package:

```bash
composer require highliuk/vite
```

## Usage

```php
use HighLiuk\Vite\Vite;
use HighLiuk\Vite\Manifest;

$manifest = new Manifest('/path/to/dist/', '/url/to/dist/');
$vite = new Vite($manifest);

// print the tags
echo $vite->tags();
```

In this example, replace `/path/to/dist` with the path to your Vite.js dist directory and `/url/to/dist` with the URL to your Vite.js dist directory.

You can also specify the Vite host and port (defaults to `http://localhost:5173/`):

```php
$vite = new Vite($manifest, 'http://localhost:port/');
```

## Example

See the [example](example/README.md) directory for a full example.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.
