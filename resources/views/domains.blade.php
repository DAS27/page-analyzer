@extends('layouts.app')
@section('title', 'Laravel')

@section('content')
    <main class="flex-grow-1">
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Domains</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Last check</th>
                            <th>Status Code</th>
                        </tr>
                    </thead>
                    @foreach($domains as $domain)
                    <tbody>
                        <tr>
                            <td>{{ $domain->id }}</td>
                            <td><a href="{{ route('domain.show', $domain->id) }}">{{ $domain->name }}</a></td>
                            <td>{{ $lastChecks[$domain->id]->created_at ?? ''}}</td>
                            <td>{{ 200 }}</td>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
            </div>
        </div>
    </main>
@endsection
