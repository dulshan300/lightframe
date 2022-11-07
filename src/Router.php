<?php

declare(strict_types=1);

return [
    ['GET', '/', ['App\Controllers\HomePageController', 'show']],
    ['GET', '/hello', ['App\Controllers\HomePageController', 'page']],
    ['GET', '/{slug}', ['App\Controllers\HomePageController', 'page']],
   
];
