<template>
    <div class="row">
        <div class="col-md-12">
            <div class="course__content py-2 d-flex justify-content-between">
                <base-heading :text="trans('strings.course_content')"></base-heading>
                <div class="d-flex font-15">
                    <span class="mr-3">
                        {{ course.total_lessons }}  
                        {{ course.total_lessons | pluralize(trans('strings.lecture')) }}
                    </span>
                    <span>{{ course.durationHMS }}</span>
                </div>
            </div>
            
            <base-course-content-accordion :course="course" :user_can_access="user_can_access"></base-course-content-accordion>
        
        </div>
    </div>
    
</template>

<script>
    
    export default {
        
        props: {
            course: { type: Object, required: true },
            user_can_access: { type: Boolean, default: false }
        }
    }
</script>