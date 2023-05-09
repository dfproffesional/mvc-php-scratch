<?php

namespace Routes;

use Services\Router;
use Src\Controllers\ExampleController;

Router::get("example/v1",ExampleController::class,'index');