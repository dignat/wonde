<?php

namespace App\Contracts;

use Wonde\Client;
use Wonde\Endpoints\Schools;

interface WondeSchool {
    public function client(): Schools;
}