<header>
    <nav class="navbar navbar-expand-md navbar-dark bg-dark">
        <a class="navbar-brand" href="https://peaceful-stream-47620.herokuapp.com/">Analyzer</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href="{{ route('domain.index') }}">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('domains.store') }}">Domains</a>
                </li>
            </ul>
        </div>
    </nav>
</header>
