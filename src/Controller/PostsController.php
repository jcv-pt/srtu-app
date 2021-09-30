<?php
namespace App\Controller;

use App\Controller\AppController;

class PostsController extends AppController
{

    public $paginate = [
        'page' => 1,
        'limit' => 10,
        'maxLimit' => 100,
    ];
    
    
}

