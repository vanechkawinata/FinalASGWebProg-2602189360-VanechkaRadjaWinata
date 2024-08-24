@extends('layout')
@section('title', 'home')
@section('setAktif', 'active')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@section('content')
   {{-- isi content --}}
   <div class="container mt-4">
       <div class="user">
           @auth
               <div class="card mb-5" style="width: 18rem;">
                   <div class="card-body">
                       <h5 class="card-title">@lang('home.hello', ['name' => Auth::user()->name])</h5>
                       <h6 class="card-subtitle mb-2 text-body-secondary">@lang('home.your_coin')</h6>
                       <h6 class="card-subtitle mb-2 text-body-secondary"><i class="bi bi-coin"></i> {{ Auth::user()->coins }}</h6>
                       <a href="#" class="card-link">@lang('home.top_up')</a>
                   </div>
               </div>
           @endauth
       </div>

       <form class="d-flex my-2 gap-2" role="search" method="GET" action="{{ route('user.index') }}">
        <input class="form-control me-2" type="search" name="search" placeholder="@lang('home.search')" aria-label="Search">
        <select name="gender" class="form-select w-25">
            <option value="">@lang('home.select_gender')</option>
            <option value="male">@lang('home.male')</option>
            <option value="female">@lang('home.female')</option>
        </select>
        <div>
            @foreach (['math', 'sport', 'art', 'books', 'food'] as $hobby)
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="hobbies[]" value="{{ $hobby }}" id="hobby_{{ $hobby }}">
                    <label class="form-check-label" for="hobby_{{ $hobby }}">
                        {{ ucfirst(trans("home.hobbies.$hobby")) }}
                    </label>
                </div>
            @endforeach
        </div>
        <button class="btn btn-outline-success" type="submit">@lang('home.search_button')</button>
    </form>

       <h1>@lang('home.find_friends')</h1>

       <div class="row">
        @if($userlist->isEmpty())
            <p>@lang('home.no_users_found')</p>
        @else
            @foreach ($userlist as $u) 
                <div class="col-md-3 mb-4"> 
                    <div class="card userCard">
                        <img src="{{$u->profile_path}}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">
                                {{$u->name}} 
                                <form method="POST" action="{{ route('friend-request.store') }}" class="d-inline">
                                    @csrf
                                    <input type="hidden" name="receiver_id" value="{{ $u->id }}">
                                    <button type="submit" class="btn btn-outline-primary btn-sm float-end" id="wishlistButton">
                                        <i class="bi bi-hand-thumbs-up"></i>
                                    </button>
                                </form>
                            </h5>
                            <p class="card-text">{{$u->gender}}</p>
                        </div>
                        <ul class="list-group list-group-flush">
                            @foreach(explode(',', $u->hobbies) as $hobby) 
                                <li class="list-group-item">{{ trim($hobby) }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endforeach
        @endif
    </div>
    
   </div>
@endsection
