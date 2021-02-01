![](./images/banner.png)

[![Tests](https://github.com/mtvbrianking/laravel-route-list/workflows/run-tests/badge.svg)](https://github.com/mtvbrianking/laravel-route-list/actions?query=workflow:run-tests)
[![Documentation](https://github.com/mtvbrianking/laravel-route-list/workflows/gen-docs/badge.svg)](https://mtvbrianking.github.io/laravel-route-list/master)
[![Code Quality](https://scrutinizer-ci.com/g/mtvbrianking/laravel-artisan-gui/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-artisan-gui/?branch=master)
[![Code Coverage](https://scrutinizer-ci.com/g/mtvbrianking/laravel-artisan-gui/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/mtvbrianking/laravel-artisan-gui/?branch=master)
[![Code Style](https://github.styleci.io/repos/334360362/shield?branch=master)](https://github.styleci.io/repos/334360362)

## Usage

> This package uses [Vue](https://vuejs.org)  components.. These components also use the Bootstrap CSS framework. However, even if you are not using these tools, the components serve as a valuable reference for your own frontend implementation.

To publish the  Vue components, use the `vendor:publish` Artisan command:

```bash
php artisan vendor:publish --provider="Bmatovu\ArtisanGui\ArtisanGuiServiceProvider"
```

The published components will be placed in your `resources/js/components` directory. Once the components have been published, you should register them in your `resources/js/app.js` file:

```js
Vue.component(
    'artisan-gui-commander',
    require('./components/artisan-gui/Commander.vue').default
);
```

After registering the components, make sure to run `npm run dev` to recompile your assets. Once you have recompiled your assets, you may drop the components into one of your application's templates to get started creating clients and personal access tokens:

```html
<artisan-gui-commander/>
```
![](./images/demo.png)
