@extends('layouts.app')
@section('title', 'Laravel')

@section('content')
    <main class="flex-grow-1">
        @include('flash::message')
        <div class="container-lg">
            <h1 class="mt-5 mb-3">Site: {{ $domain->name }}</h1>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <tbody><tr>
                        <td>id</td>
                        <td>{{ $domain->id }}</td>
                    </tr>
                    <tr>
                        <td>name</td>
                        <td>{{ $domain->name }}</td>
                    </tr>
                    <tr>
                        <td>created_at</td>
                        <td>{{ $domain->created_at }}</td>
                    </tr>
                    <tr>
                        <td>updated_at</td>
                        <td>{{ $domain->updated_at }}</td>
                    </tr>
                    </tbody></table>
            </div>

            <h2 class="mt-5 mb-3">Checks</h2>
            <form method="post" action="{{ route('domain.check.store', $domain->id) }}">
                @csrf
                <input type="submit" class="btn btn-primary" value="Run check">
            </form>
            <div class="table-responsive">
                <table class="table table-bordered table-hover text-nowrap">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Status Code</th>
                            <th>h1</th>
                            <th>Keywords</th>
                            <th>Description</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($domainChecks as $check)
                        <tr>
                            <th>{{ $check->id }}</th>
                            <th>{{ $check->status_code }}</th>
                            <th>{{ $check->h1 }}</th>
                            <th>{{ $check->keywords }}</th>
                            <th>{{ $check->description }}</th>
                            <th>{{ $check->created_at }}</th>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    {{ $domainChecks->links() }}
                </ul>
            </nav>
        </div>
    </main>
@endsection
