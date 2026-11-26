<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'Aset PC') | IT Helpdesk</title>

    {{-- Bootstrap 5 via CDN --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

    {{-- Navbar --}}
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
        <div class="container">
            <a class="navbar-brand" href="{{ route('pc-assets.index') }}">IT Helpdesk &ndash; Departemen &amp; Aset PC</a>

            {{-- Menu hanya tampil jika user sudah login --}}
            @auth
                <div class="navbar-nav ms-auto align-items-lg-center">
                    <a class="nav-link {{ request()->routeIs('pc-assets.*') ? 'active' : '' }}"
                       href="{{ route('pc-assets.index') }}">Aset PC</a>

                    <span class="navbar-text text-white ms-lg-3 me-lg-3">
                        Halo, <strong>{{ Auth::user()->name }}</strong>
                        <span class="badge {{ Auth::user()->isAdmin() ? 'bg-warning text-dark' : 'bg-secondary' }} ms-1">
                            {{ ucfirst(Auth::user()->role ?? 'user') }}
                        </span>
                    </span>

                    {{-- Logout wajib POST + @csrf --}}
                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-light btn-sm">Logout</button>
                    </form>
                </div>
            @endauth
        </div>
    </nav>

    <main class="container pb-5">

        {{-- Alert flash message (muncul setelah redirect ->with('success', ...)) --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
            </div>
        @endif

        {{-- Isi halaman dari view anak --}}
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>