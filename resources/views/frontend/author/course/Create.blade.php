@extends('frontend.layouts.app')

@section('title', __('strings.create_new_course') . ' | ' . app_name())

@section('content')
<section class="authentication m-4 p-4">
    <div class="container">
        <div class="row">
            <div class="col-md-5 mx-auto">
                <div class="card shadow-sm">
                    <div class="card-body p-4">
                        <h1 class="text-uppercase fw-500 text-center font-22 mb-2">
                            @lang('strings.start_here')
                        </h1>
                        <h2 class="font-16 fw-400 text-center mb-3">
                            @lang('strings.you_can_change_these_later')
                        </h2>
                        <base-author-create-course :categories="{{ json_encode($categories) }}"></base-author-create-course>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
