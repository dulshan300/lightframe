<?php

declare(strict_types=1);

namespace Core\Template;

class PlateRender  implements Renderer
{
    private $engine;

    public function __construct(\League\Plates\Engine $engine)
    {
        $this->engine = $engine;
    }

    public function render($template, $data = []): string
    {
        return $this->engine->render($template, $data);
    }
}
