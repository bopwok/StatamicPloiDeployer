<?php

namespace Savelend\PloiDeployer\Tests;

use Savelend\PloiDeployer\ServiceProvider;
use Statamic\Testing\AddonTestCase;

abstract class TestCase extends AddonTestCase
{
    protected string $addonServiceProvider = ServiceProvider::class;
}
