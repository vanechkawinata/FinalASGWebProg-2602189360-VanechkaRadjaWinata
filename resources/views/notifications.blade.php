@extends('layout')
@section('title', 'notifications')
@section('setAktifN', 'active')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
@section('content')

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>@lang('notifications.notifications')</h3>
        <a href="javascript:history.back()" class="btn btn-secondary">@lang('notifications.back')</a>
    </div>

    <div class="alert alert-info">
        <ul class="list-group list-group-flush">
            @forelse ($notifications as $notification)
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <span>{{ $notification->data['message'] }}</span>
                </li>
            @empty
                <li class="list-group-item">@lang('notifications.no_new_notifications')</li>
            @endforelse
        </ul>
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $notifications->links() }}
    </div>
</div>
@endsection
