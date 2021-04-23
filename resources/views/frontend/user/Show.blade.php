@extends('frontend.layouts.app')
@section('title', $user->full_name . ' | ' . app_name())
@section('content')
    <section class="text-white py-3 jumbotron__with_breadcrumb d-flex align-items-center bg-info">
        <div class="container">
            <div class="row">
                <div class="col-md-12 py-4">
                    <div class="font-34 mb-2 fw-300">
                        {{ $user->full_name }}
                    </div>
                    <div class="font-14 fw-300">
                        {{ $user->tagline }}
                    </div>
                </div>
            </div>
        </div>
    </section>

    @auth
    <base-user-show 
        :user="{{ json_encode($user) }}" 
        :auth_user="{{ json_encode(auth()->user()) }}"></base-user-show>
    @else 
        <base-user-show 
            :user="{{ json_encode($user) }}"></base-user-show>
    @endauth
@endsection
