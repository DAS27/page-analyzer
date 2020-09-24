<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use DiDom\Document;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class DomainChecksController extends Controller
{
    public function check($id)
    {
        $domain = DB::table('domains')->find($id);
        abort_unless($domain, 404);
        try {
            $response = Http::get($domain->name);
            $document = new Document($response->body());
            $h1 = optional($document->first('h1'))->text();
            $keywords = optional($document->first('*[^name=keywords]'))->getAttribute('content');
            $description = optional($document->first('*[^name=description]'))->getAttribute('content');
            $statusCode = $response->status();
            DB::table('domain_checks')->insert(
                [
                    'domain_id' => $id,
                    'status_code' => $statusCode,
                    'h1' => $h1,
                    'keywords' => $keywords,
                    'description' => $description,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]
            );
            flash('Website has been checked!');
        } catch (RequestException $e) {
            flash('Website not found')->error();
        } catch (ConnectionException $e) {
            flash('Oops something went wrong')->error();
        }
        return redirect()->route('domain.show', ['id' => $id]);
    }
}
