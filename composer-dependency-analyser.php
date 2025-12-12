<?php

declare(strict_types=1);

use ShipMonk\ComposerDependencyAnalyser\Config\Configuration;
use ShipMonk\ComposerDependencyAnalyser\Config\ErrorType;

return new Configuration()
    // Adjusting scanned paths
    ->addPathToScan(__DIR__ . '/src', false)
    ->addPathToScan(__DIR__ . '/tests', true)
    ->ignoreErrorsOnPackage('shapecode/twig-string-loader', [ErrorType::DEV_DEPENDENCY_IN_PROD]);
