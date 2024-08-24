<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>@lang('register.title')</title>
</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card-header text-center">
                    <h1>@lang('register.title')</h1>
                </div>
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form method="POST" action="{{ url('/register') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="name" class="form-label">@lang('register.name')</label>
                                <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required autofocus>
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label">@lang('register.email')</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">@lang('register.password')</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">@lang('register.confirm_password')</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>

                            <div class="mb-3">
                                <label for="gender" class="form-label">@lang('register.gender')</label>
                                <select class="form-select" id="gender" name="gender" required>
                                    <option value="male" {{ old('gender') == 'male' ? 'selected' : '' }}>@lang('register.male')</option>
                                    <option value="female" {{ old('gender') == 'female' ? 'selected' : '' }}>@lang('register.female')</option>
                                    <option value="other" {{ old('gender') == 'other' ? 'selected' : '' }}>@lang('register.other')</option>
                                </select>
                            </div>

                            <div class="mb-3">
                                <label for="instagram" class="form-label">@lang('register.instagram')</label>
                                <input type="text" class="form-control" id="instagram" name="instagram" value="{{ old('instagram') }}" required>
                            </div>

                            <div class="mb-3">
                                <label for="hobbies" class="form-label">@lang('register.hobbies')</label>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="Music" id="hobbyMusic">
                                    <label class="form-check-label" for="hobbyMusic">@lang('register.hobby_music')</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="Food" id="hobbyFood">
                                    <label class="form-check-label" for="hobbyFood">@lang('register.hobby_food')</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="Books" id="hobbyBooks">
                                    <label class="form-check-label" for="hobbyBooks">@lang('register.hobby_books')</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="Sport" id="hobbySport">
                                    <label class="form-check-label" for="hobbySport">@lang('register.hobby_sport')</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="Art" id="hobbyArt">
                                    <label class="form-check-label" for="hobbyArt">@lang('register.hobby_art')</label>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="number" class="form-label">@lang('register.mobile_number')</label>
                                <input type="text" class="form-control" id="number" name="number" value="{{ old('mobile_number') }}" required>
                            </div>

                            <div class="text-center">
                                <button type="submit" class="btn btn-primary">@lang('register.register')</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
