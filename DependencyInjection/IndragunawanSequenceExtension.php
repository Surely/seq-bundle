<?php

declare(strict_types=1);

/*
 * This file is part of the Indragunawan/sequence-bundle
 *
 * (c) Indra Gunawan <hello@indra.my.id>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Indragunawan\SequenceBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\XmlFileLoader;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\ConfigurableExtension;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class IndragunawanSequenceExtension extends ConfigurableExtension
{
    /**
     * {@inheritdoc}
     */
    protected function loadInternal(array $mergedConfig, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));

        $loader->load('services.xml');

        $container->getDefinition('indragunawan_sequence.sequence_provider.doctrine_orm')
            ->setArgument('$entityClass', $mergedConfig['orm']['class'])
            ->setArgument('$managerName', $mergedConfig['orm']['manager_name'])
        ;

        $container->getDefinition('indragunawan_sequence.command.reset_counter')
            ->setArgument('$em', new Reference(sprintf('doctrine.orm.%s_entity_manager', $mergedConfig['orm']['manager_name'])))
        ;
    }
}
