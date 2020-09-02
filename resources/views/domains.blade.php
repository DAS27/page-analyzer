@extends('layouts.app')
@section('title', 'Laravel')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Domains</h1>
            <div class="table-responsive">
                @foreach($domains as $domain)
                <table class="table table-bordered table-hover text-nowrap">
                    <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last check</th>
                            <th>Status Code</th>
                        </tr>
                        <tr>
                            <td>{{ $domain->id }}</td>
                            <td>{{ $domain->name }}</td>
                            <td>{{ $domain->updated_at }}</td>
                            <td>{{ $domain->updated_at }}</td>
                        </tr>
                    </tbody>
                </table>
                @endforeach
            </div>
        </div>
    </main>
@endsection
