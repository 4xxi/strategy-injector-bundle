<?php

declare(strict_types=1);

namespace Fourxxi\StrategyInjectorBundle;

use Fourxxi\StrategyInjectorBundle\DependencyInjection\Compiler\StrategyInjectorCompilerPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class StrategyInjectorBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new StrategyInjectorCompilerPass(), PassConfig::TYPE_OPTIMIZE, -100);
    }
}
