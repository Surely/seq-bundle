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

namespace Indragunawan\SequenceBundle\Exception;

/**
 * @author Indra Gunawan <hello@indra.my.id>
 */
class SequenceNotFoundException extends \InvalidArgumentException
{
    public function __construct(string $name)
    {
        parent::__construct(sprintf('Sequence not found: "%s".', $name));
    }
}
