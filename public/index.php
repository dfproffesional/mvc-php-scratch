<?php

require __DIR__."/../conf/autoloader.php";

(new Services\App());

echo getenv('ENV');
echo getenv('APP_NAME');

phpinfo();
