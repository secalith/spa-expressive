<?php

declare(strict_types=1);

use Zend\ConfigAggregator\ArrayProvider;
use Zend\ConfigAggregator\ConfigAggregator;
use Zend\ConfigAggregator\PhpFileProvider;

// To enable or disable caching, set the `ConfigAggregator::ENABLE_CACHE` boolean in
// `config/autoload/local.php`.
$cacheConfig = [
    'config_cache_path' => 'data/cache/config-cache.php',
];

$aggregator = new ConfigAggregator([
    \Petition\ConfigProvider::class,
    \Article\ConfigProvider::class,
    \Shrt\ConfigProvider::class,
    \Permission\ConfigProvider::class,
    \Import\ConfigProvider::class,
    \Zend\I18n\ConfigProvider::class,
    \Zend\Form\ConfigProvider::class,
    \Zend\InputFilter\ConfigProvider::class,
    \Zend\Validator\ConfigProvider::class,
    \User\ConfigProvider::class,
    \Auth\ConfigProvider::class,
    \Jobs\ConfigProvider::class,
    \Instance\ConfigProvider::class,
    \Zend\Hydrator\ConfigProvider::class,
    \Zend\Filter\ConfigProvider::class,
    \PageRoute\ConfigProvider::class,
    \Zend\Paginator\ConfigProvider::class,
    \Zend\Session\ConfigProvider::class,
    \PageView\ConfigProvider::class,
    \PageTemplate\ConfigProvider::class,
    \Page\ConfigProvider::class,
    \Common\ConfigProvider::class,
    \Content\ConfigProvider::class,
    \Block\ConfigProvider::class,
    \Area\ConfigProvider::class,
    \Zend\Db\ConfigProvider::class,
    \Zend\Expressive\Router\FastRouteRouter\ConfigProvider::class,
    \Zend\HttpHandlerRunner\ConfigProvider::class,
    \Zend\Expressive\ZendView\ConfigProvider::class,
    // Include cache configuration
    new ArrayProvider($cacheConfig),
    \Zend\Expressive\Helper\ConfigProvider::class,
    \Zend\Expressive\ConfigProvider::class,
    \Zend\Expressive\Router\ConfigProvider::class,
    // Default App module config
    App\ConfigProvider::class,
    Site\ConfigProvider::class,
    ArticleExternal\ConfigProvider::class,
    ArrayDigger\ConfigProvider::class,
    RoleEditor\ConfigProvider::class,
    PageLayout\ConfigProvider::class,
    PageResource\ConfigProvider::class,
    Event\ConfigProvider::class,
    I18n\ConfigProvider::class,
    // Load application config in a pre-defined order in such a way that local settings
    // overwrite global settings. (Loaded as first to last):
    //   - `global.php`
    //   - `*.global.php`
    //   - `local.php`
    //   - `*.local.php`
    new PhpFileProvider(realpath(__DIR__) . '/autoload/{{,*.}global,{,*.}local}.php'),
    // Load development config if it exists
    new PhpFileProvider(realpath(__DIR__) . '/development.config.php'),
], $cacheConfig['config_cache_path']);

return $aggregator->getMergedConfig();
