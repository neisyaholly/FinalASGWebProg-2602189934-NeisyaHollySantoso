@extends('navbar')

@section('title', 'Home')
@section('activeHome', 'active')

@section('content')
    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="container">
        <h3>Notifications</h3>
        <div class="alert alert-info">
            <ul class="list-unstyled mb-0">
                @forelse (Auth::user()->notifications as $notification)
                    <li>
                        {{ $notification->data['message'] }}
                        <a href="{{ route('notifications.destroy', $notification->id) }}" class="btn btn-danger btn-sm ms-2"
                            onclick="event.preventDefault(); document.getElementById('delete-form-{{ $notification->id }}').submit();">
                            <i class="icon-close"></i>
                        </a>

                        <form id="delete-form-{{ $notification->id }}"
                            action="{{ route('notifications.destroy', $notification->id) }}" method="POST"
                            style="display: none;">
                            @csrf
                            @method('DELETE')
                        </form>
                    </li>
                @empty
                    <li>@lang('home.no_new_notifications')</li>
                @endforelse
            </ul>
        </div>

        <div class="row mt-4">
        <!-- Search Form -->

            <form method="GET" action="{{ route('user.index') }}" class="mb-4">
                <div class="row">
                    <div class="col-md-8">
                        <input type="text" name="search" class="form-control" placeholder="@lang('home.search_by')"
                            value="{{ request('search') }}">
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">@lang('home.search')</button>
                    </div>
                    <div class="col-md-2">
                        <button class="btn btn-warning dropdown-toggle filter" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 100%">
                            @lang('home.filter')
                        </button>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="{{ route('home') }}">@lang('home.all')</a></li>
                            <li><a class="dropdown-item" href="{{ route('home', ['gender' => 'male']) }}">@lang('home.male')</a></li>
                            <li><a class="dropdown-item" href="{{ route('home', ['gender' => 'female']) }}">@lang('home.female')</a></li>
                        </ul>
                    </div>
                </div>
            </form>
            @foreach ($dataUser as $user)
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="{{ $user->name }}'s profile"
                            class="card-img-top img-fluid" style="object-fit: cover; height: 250px;">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->hobbies }}</p>
                            <form method="POST" action="{{ route('friend-request.store') }}" class="mt-auto">
                                @csrf
                                <input type="hidden" name="receiver_id" value="{{ $user->id }}">
                                <button type="submit" class="btn btn-primary w-100">Send Request</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection