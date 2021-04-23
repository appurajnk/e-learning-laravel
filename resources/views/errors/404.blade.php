@extends('frontend.layouts.app')

@section('content')
    <section class="h-75 py-4 my-4">
        <div class="container">
            <div class="row">
                <div class="col-5 mx-auto">
                    <div class="card shadow-sm">
                        <div class="card-body p-4">
                            <h4 class="fw-500 text-center font-22 mb-4">
                                @lang('strings.page_not_found')
                            </h4>
                            <div class="px-4 text-center">
                                <a href="/">
                                    @lang('strings.go_home')
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
