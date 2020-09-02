<?php

namespace App\Http\Controllers;

use App\Http\Requests\DomainRequest;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DomainController extends Controller
{
    public function check(DomainRequest $request)
    {
        $url = parse_url($request->input('domain.name'));
        ['scheme' => $scheme, 'host' => $host] = $url;
        $domainName = "{$scheme}://{$host}";
        $domain = DB::table('domains')->where('name', $domainName)->first();
        if (DB::table('domains')->where('name', $domainName)->doesntExist()) {
            $id = DB::table('domains')->insertGetId(
                [
                    'name' => strtolower($domainName),
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()]
            );
            flash('Url has been added');
            return redirect()->route('domain.show', [$id]);
        }
        flash('Url already exists');
        return redirect()->route('domain.show', [$domain->id]);
    }

    public function index()
    {
        return view('home');
    }

    public function store()
    {
        $domains = DB::table('domains')->get();
        return view('domains', compact('domains'));
    }

    public function show($id)
    {
        $domain = DB::table('domains')->find($id);
        return view('show', compact('domain'));
    }
}
