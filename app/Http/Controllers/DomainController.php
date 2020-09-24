<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class DomainController extends Controller
{
    public function index()
    {
        $domains = DB::table('domains')->paginate(10);
        $domainIds = $domains->pluck('id');
        $lastChecks = DB::table('domain_checks')
            ->whereIn('domain_id', $domainIds)
            ->distinct('domain_id')
            ->orderBy('domain_id')
            ->orderBy('updated_at', 'asc')
            ->get()
            ->keyBy('domain_id');
        return view('domains', compact('domains', 'lastChecks'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|url|max:255'
        ]);
        if ($validator->fails()) {
            flash('Not a valid url')->error();
            return redirect()
                ->route('home')
                ->withInput()
                ->withErrors($validator);
        }
        $domain = $validator->valid();
        $url = parse_url($domain['name']);
        ['scheme' => $scheme, 'host' => $host] = $url;
        $normalizedUrl = strtolower("{$scheme}://{$host}");
        $domain = DB::table('domains')->where('name', $normalizedUrl)->first();
        if ($domain) {
            flash('Url already exists')->success();
            return redirect()->route('domain.show', ['id' => $domain->id]);
        }
        $id = DB::table('domains')->insertGetId(
            [
                'name' => $normalizedUrl,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ]
        );
        flash('Url has been added')->success();
        return redirect()->route('domain.show', ['id' => $id]);
    }

    public function show($id)
    {
        $domain = DB::table('domains')->find($id);
        abort_unless($domain, 404);
        $domainChecks = DB::table('domain_checks')
            ->where('domain_id', $id)
            ->orderBy('id', 'desc')
            ->paginate(5);
        return view('show', compact('domain', 'domainChecks'));
    }
}
