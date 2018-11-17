<?php

declare(strict_types=1);

namespace AggregatorPirate\Form\Factory;

use AggregatorPirate\Form\EntryItemUpdateForm;
use Psr\Container\ContainerInterface;

class FactoryAggregatorPirateUpdateServiceFormFactory
{
    public function __invoke(ContainerInterface $container, $requestedName = null)
    {
        return new EntryItemUpdateForm('form_update',[],null);
    }
}
