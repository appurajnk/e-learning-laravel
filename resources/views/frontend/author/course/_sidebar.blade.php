<div class="list-group mt-4">
    <a href="{{ route('frontend.author.course.goals', $course->uuid) }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.author.course.goals')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.target_your_students')
    </a>

    <a href="{{ route('frontend.author.course.basics', $course->uuid) }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.author.course.basics')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.course_landing_page')
    </a>

    <a href="{{ route('frontend.author.course.curriculum', $course->uuid) }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.author.course.curriculum')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.curriculum')
    </a>

    <a href="{{ route('frontend.author.course.pricing', $course->uuid) }}" 
        class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.author.course.pricing')) }}" >
        <span class="sl sl-icon-check"></span>
        @lang('strings.course_pricing')
    </a>

    @if($course->approvals->count())
        <a href="{{ route('frontend.author.course.approvals', $course->uuid) }}" 
            class="list-group-item list-group-item-action nav-link {{ active_class(Route::is('frontend.author.course.approvals')) }}" >
            <span class="sl sl-icon-check"></span>
            @lang('strings.course_approval')
        </a>
    @endif 
</div>


@if($course->status_code == 'draft')
    <base-submit-for-review uuid="{{ $course->uuid }}"></base-submit-for-review>
@endif
