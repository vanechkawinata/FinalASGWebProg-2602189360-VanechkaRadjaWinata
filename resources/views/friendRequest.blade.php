@extends('layout')
@section('title', 'request')
@section('setAktifR', 'active')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@section('content')
   {{-- isi content --}}
   <div class="container mt-4">
       <h1>@lang('friendrequest.friend_request')</h1>
       <div class="row">
           @foreach ($userlist as $u) 
               <div class="col-md-3 mb-4"> 
                   <div class="card userCard">
                       <img src="{{ $u->profile_path }}" class="card-img-top" alt="...">
                       <div class="card-body">
                           <h5 class="card-title">{{ $u->name }}</h5>
                           <p class="card-text">{{ $u->gender }}</p>
                       </div>
                       <ul class="list-group list-group-flush">
                           @foreach (explode(',', $u->hobbies) as $hobby) 
                               <li class="list-group-item">{{ trim($hobby) }}</li>
                           @endforeach
                       </ul>
                       <div class="card-body">
                           <form method="POST" action="{{ route('friend.store') }}" class="mb-2">
                               @csrf
                               <input type="hidden" name="request_id" value="{{ $u->request_id }}">
                               <input type="hidden" name="friend_id" value="{{ $u->id }}">
                               <button type="submit" class="btn btn-primary w-100">@lang('friendrequest.accept')</button>
                           </form>
                           <form method="POST" action="{{ route('friend-request.destroy', $u->request_id) }}">
                               @method('delete')
                               @csrf
                               <button type="submit" class="btn btn-danger w-100">@lang('friendrequest.decline')</button>
                           </form>
                       </div>
                   </div>
               </div>
           @endforeach
       </div>
   </div>
@endsection
