<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DomainRequest;
use Illuminate\Support\Facades\DB;

class DomainController extends Controller
{
    public function check(DomainRequest $request)
    {
        $domain = DB::insert(INTO 'pageanalyzer' );
    }
}
