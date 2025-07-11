# pscommunity

Prestashop Community module

## Description

Adds community tools like GitHub top contributors in the back-office (**Wall of Fame**).

## Initialization

For developers, after cloning this repository in `/modules` folder, launch this commands:

```shell
# /modules/pscommunity
composer install --no-dev

# At the root of your PrestaShop project
composer dump-autoload
```

Then run these commands in the `vue-app` folder:

```shell
# /modules/pscommunity/vue-app
# Using Node 20
pnpm install
pnpm  build
```

This will build the Vue app in the `views/js/vue` folder.
