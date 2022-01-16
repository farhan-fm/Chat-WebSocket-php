<?php

require('vendor/autoload.php');

use MyApp\Entity\Message;

echo Message::all()->toJson();


?>