@extends('layout')
@section('title', 'request')
@section('setAktifF', 'active')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@section('content')

    <div class="container mt-4">
       <h1>@lang('friends.your_friends')</h1>
       <div class="row">
           @foreach ($userlist as $u) 
               <div class="col-md-3 mb-4"> 
                   <div class="card userCard">
                       <img src="{{ $u->profile_path }}" class="card-img-top" alt="...">
                       <div class="card-body">
                           <h5 class="card-title">
                               {{ $u->name }} 
                           </h5>
                           <p class="card-text">{{ $u->gender }}</p>
                       </div>
                       <ul class="list-group list-group-flush">
                           @foreach (explode(',', $u->hobbies) as $hobby) 
                               <li class="list-group-item">{{ trim($hobby) }}</li>
                           @endforeach
                       </ul>
                       <div class="card-body">
                           <a href="{{ route('message.show', $u->id) }}" class="btn btn-primary mt-auto w-100">@lang('friends.message')</a>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
   </div>
@endsection
