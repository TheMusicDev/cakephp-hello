<?php
declare(strict_types=1);

namespace App\Controller;

class HelloController extends AppController
{
    public function index(): \Cake\Http\Response
    {
        $this->autoRender = false;

        return $this->response->withStringBody(
            'Hello world — CakePHP 5 on themusicdev/php-apache:8.5.12'
        );
    }
}