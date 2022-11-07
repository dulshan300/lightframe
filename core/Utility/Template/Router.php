<?php

declare(strict_types=1);

namespace Core\Utility\Template;

use League\Plates\Engine;
use League\Plates\Extension\ExtensionInterface;

class Router implements ExtensionInterface
{
    public function register(Engine $engine)
    {
        $engine->registerFunction('trim', [$this, 'trim']);
        $engine->registerFunction('upper', [$this, 'upper']);
        $engine->registerFunction('lower', [$this, 'lower']);
        $engine->registerFunction('capitalize', [$this, 'capitalize']);
    }

    public function trim($var, $len = 50)
    {
        if (strlen($var) > $len) {
            return substr($var, 0, $len) . "...";
        }

        return $var;
    }

    public function upper($var)
    {
        return strtoupper($var);
    }
    public function lower($var)
    {
        return strtolower($var);
    }
    public function capitalize($var)
    {
        return ucwords($var);
    }
}
