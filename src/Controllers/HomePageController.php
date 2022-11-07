<?php

declare(strict_types=1);

namespace App\Controllers;

use Core\Template\Renderer;
use Http\Request;
use Http\Response;

class HomepageController
{
    private $response;
    private $request;
    private $view;

    public function __construct(Response $response, Request $request, Renderer $view)
    {
        $this->response = $response;
        $this->request = $request;
        $this->view = $view;
    }


    public function show()
    {
        $data = [
            'name' => $this->request->getParameter('name', 'stranger'),
        ];
        return $this->view->render('pages/homepage', $data);
        // $this->response->setContent($html);
    }

    public function page(Response $response, Request $request, $slug)
    {
        $data = [
            'name' => $slug,
        ];
        return $this->view->render('pages/homepage', $data);
    }
}
