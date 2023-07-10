<?php
namespace App\Services;

use App\Contracts\WondeSchool;
USE Wonde\Client;
use Wonde\Endpoints\Schools;

class SchoolService implements WondeSchool {

   public function client(): Schools {
    return new Schools(env('TOKEN'), env('SCHOOL_ID'));
   }
}