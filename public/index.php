<?php

require '../lib/autoload.php';

$start_time = microtime(true);

$end_time = microtime(true);
$execution_time = number_format(($end_time - $start_time), 2, '.', '');
echo "\n\n$execution_time seg";

exit();