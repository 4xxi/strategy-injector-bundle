<?php

declare(strict_types=1);

namespace Fourxxi\StrategyInjectorBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Exception\InvalidConfigurationException;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

final class StrategyInjectorExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        foreach ($configs as $strategies) {
            foreach ($strategies as $interface => $config) {
                if (!is_string($config) && !array_key_exists('class', $config) && !array_key_exists('method', $config)) {
                    throw new InvalidConfigurationException('class or method parameter not found at strategy '.$interface);
                }

                $compositeClass = is_string($config) ? $config : $config['class'];
                $container
                    ->register($interface, $compositeClass)
                    ->setAutowired(true)
                ;

                $container
                    ->registerForAutoconfiguration($interface)
                    ->addTag($interface)
                ;
            }
        }
    }
}
