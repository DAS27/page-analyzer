<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\DomainRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainController extends Controller
{
    public function check(DomainRequest $request)
    {
//        DB::table('pageanalyzer')
//            ->insert(['id' => 1, 'name' => $request->input('domain.name'), 'created_at' => Carbon::now(), 'updated_at' => Carbon::tomorrow()]
//            );

        $domains = DB::table('pageanalyzer')->get();
        dd($domains);
    }
}
