@extends('navbar')

@section('title', 'Request')
@section('activeRequest', 'active')

@section('content')
    @if (session('success'))
        <div class="success-message">{{ session('success') }}</div>
    @endif
    {{-- {{ dd($friendRequest) }} --}}
    <div class="container">
        <div class="row">
            @foreach ($friendRequest as $user)
                <div class="col-md-4 mb-4">
                    <div class="card" style="width: 100%;">
                        <img src="{{ asset('storage/' . $user->profile_path) }}" alt="" srcset=""
                            style="width: 25rem; height: 25rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{ $user->name }}</h5>
                            <p class="card-text">{{ $user->hobbies }}</p>
                            <form method="POST" action="{{route('friend.store')}}">
                                @csrf
                                <input type="hidden" name="request_id" value="{{ $user->request_id }}">
                                <input type="hidden" name="friend_id" value="{{ $user->id }}">
                                <button type="submit" class="button btn-primary">@lang('request.accept')</button>
                            </form>
                            <form method="POST" action="{{route('friend-request.destroy', $user->request_id)}}">
                            @method('delete')
                                @csrf
                                <button type="submit" class="button btn-danger">@lang('request.decline')</button>
                            </form>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection