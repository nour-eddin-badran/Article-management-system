<?php

namespace App\Http\Controllers\Api\v1;

use App\Traits\MessageHandleHelper;
use App\Http\Controllers\Controller;

class BaseApiController extends Controller
{
    use MessageHandleHelper;
}
