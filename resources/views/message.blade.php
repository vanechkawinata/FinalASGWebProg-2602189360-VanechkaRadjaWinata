@extends('layout')

@section('title', 'Message')
@section('activeMessage', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                
                <a href="{{ route('friend.index')}}" class="btn btn-secondary mb-3 mt-3">
                    <i class="bi bi-arrow-left"></i> @lang('messages.back')
                </a>

                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h3 class="card-title">{{ $friend->name }}</h3>
                        <p class="card-text">
                            <strong>@lang('messages.gender'):</strong> {{ $friend->gender }}<br>
                            <strong>@lang('messages.email'):</strong> {{ $friend->email }}
                        </p>
                    </div>
                </div>

                <div class="card chat-room shadow-sm">
                    <div class="card-body">
                        <div class="chat-messages" style="height: 400px; overflow-y: auto;">
                            @foreach ($messages as $msg)
                                <div class="d-flex {{ $msg->sender_id === auth()->user()->id ? 'justify-content-end' : 'justify-content-start' }} mb-3">
                                    <div class="message p-3 rounded-3 {{ $msg->sender_id === auth()->user()->id ? 'bg-primary text-white' : 'bg-light' }}" style="max-width: 75%;">
                                        <p class="mb-0">{{ $msg->message }}</p>
                                        <p class="text-muted small text-end">{{ $msg->created_at ? $msg->created_at->format('H:i') : '--' }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <form method="POST" action="{{ route('message.store') }}" class="mt-3">
                    @csrf
                    <div class="input-group">
                        <input type="text" name="new_message" class="form-control" placeholder="@lang('messages.enter_message')" required>
                        <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                        <button type="submit" class="btn btn-primary">@lang('messages.send')</button>
                    </div>
                </form>

                <form method="POST" action="{{ route('video.call') }}" class="mt-3">
                    @csrf
                    <input type="hidden" name="friend_id" value="{{ $friend->id }}">
                    <button type="submit" class="btn btn-success">@lang('messages.start_video_call')</button>
                </form>
            </div>
        </div>
    </div>
@endsection
