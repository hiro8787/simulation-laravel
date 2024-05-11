<?php
require '../vendor/autoload.php';

use Carbon\Carbon;

$now = Carbon::now();
echo $now->isoFormat('YYYY-MM-DD');