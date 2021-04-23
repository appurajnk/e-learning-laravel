<section class="text-white jumbotron__with_breadcrumb d-flex align-items-center py-4 min-height-100">    
    <div class="container d-flex py-1 fw-300">
        <div>
            <img src="{{ $course->thumbnail }}" class="mr-3 rounded" width="100" />
        </div>
        <div class="d-flex flex-column">
            <h1 class="font-28 fw-300 mb-2">
                {{ $course->title }}
                <span class="font-12 text-uppercase text-warning">
                    @lang('strings.'.$course->status_code)
                </span>
            </h1>
            <div>
                @lang('strings.by') {{ $course->author->full_name }}
            </div>
        </div>
    </div>
</section>