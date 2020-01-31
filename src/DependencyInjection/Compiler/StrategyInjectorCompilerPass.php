<?php

declare(strict_types=1);

namespace Fourxxi\StrategyInjectorBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

final class StrategyInjectorCompilerPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $configs = $container->getExtensionConfig('strategy_injector');
        foreach ($configs as $strategies) {
            foreach ($strategies as $interface => $config) {
                if (is_string($config)) {
                    $config = [];
                }

                $this->injectStrategies($container, $interface, $config);
            }
        }
    }

    private function injectStrategies(ContainerBuilder $container, string $interface, array $config): void
    {
        $services = $container->findTaggedServiceIds($interface);
        $serviceDefinition = $container->getDefinition($interface);

        foreach ($services as $serviceId => $tags) {
            if ($serviceDefinition->getClass() === $serviceId) {
                continue;
            }

            if (array_key_exists('method', $config)) {
                $serviceDefinition->addMethodCall($config['method'], [new Reference($serviceId)]);
            } else {
                $serviceDefinition->addArgument(new Reference($serviceId));
            }
        }
    }
}
