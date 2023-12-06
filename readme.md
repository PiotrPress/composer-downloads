# Composer Downloads

This composer plugin adds support for environment variables in `composer.json` packages URLs.

## Example

You can add tokens, license keys, etc. to package URL using `${ENV}` placeholders e.g.:

```json
{
  "repositories": [
    {
      "type": "package",
      "package": {
        "name": "example/package",
        "version": "1.0",
        "dist": {
          "type": "zip",
          "url": "https://${VENDOR}.com/${NAME}-${VERSION}.zip?token=${TOKEN}"
        }
      }
    }
  ],
  "require": {
    "php": ">=7.4",
    "example/package": "1.0",
    "piotrpress/composer-downloads": "*"
  },
  "config": {
    "allow-plugins": {
      "piotrpress/composer-downloads": true
    }
  }
}
```

You can pass environment variables to composer install/update command e.g.:

```shell
$ TOKEN=secret composer install
```

**Note:** Variables `${VENDOR}`, `${NAME}`, `${VERSION}` are propagated from package's fields.

Processed URL will be:

```shell
https://example.com/package-1.0.zip?token=secret
```

## Requirements

- PHP >= `7.4` version.
- Composer ^`2.0` version.

## License

[MIT](license.txt)