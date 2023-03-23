<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;


/**
* @OA\Info(
* version="1.0.0",
* title="Newsletters API",
* description="Newsletters API Documentation",
* )
*/
class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;
}
