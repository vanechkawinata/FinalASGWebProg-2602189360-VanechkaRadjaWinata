<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@lang('login.title')</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">@lang('login.title')</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="POST" action="{{ url('/login') }}" class="card p-4 shadow">
                    @csrf
                    <div class="mb-3">
                        <label for="email" class="form-label">@lang('login.email')</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">@lang('login.password')</label>
                        <input type="password" id="password" name="password" class="form-control" required>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">@lang('login.login')</button>
                    </div>
                </form>
                <div class="text-center mt-3">
                    <p>@lang('login.no_account') <a href="/register">@lang('login.register_now')</a></p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
