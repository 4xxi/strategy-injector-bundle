# StrategyInjectorBundle

## Installation
1. Install component via composer
```shell script
composer require 4xxi/strategy-injector
```

2. Add configuration yaml into `config/packages/strategy_injector.yaml` with following content:
```yaml
strategy_injector:
    # For using strategy injector via constructor:
    # App\Interface: App\CompositeClass

    # For using strategy injector via method call:
    # App\Interface:
    #    method: 'addStrategy'
    #    class: App\CompositeClass
    #
```
## Usage
1. Inject via constructor configuration example (that's injects all classes which implements interface on left side of declaration into composite class)
```yaml
strategy_injector:
    App\Strategy\FooStrategyInterface: App\Strategy\CompositeFooStrategy
```

2. Inject via method
```yaml
strategy_injector:
    App\Strategy\FooStrategyInterface:
        method: 'addStrategy'
        class: App\Strategy\CompositeFooStrategy
```