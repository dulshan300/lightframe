<?php

declare(strict_types=1);

namespace Core\Template;

interface Renderer
{
    public function render($template, $data = []): string;
}
