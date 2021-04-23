<template>
    <div class="row">
        <div class="col-md-12">
            <div class="bg-light p-2 mb-2 border border-secondary">
                <div class="row">
            
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div class="">
                                <img :src="course.images.thumbnail" width="175" class="shadow-sm" />
                            </div>
                            <div class="border border-left-0 border-bottom-0 border-top-0 d-flex flex-column px-3 flex-grow-1">
                                <span class="fw-600 font-15 mb-2">{{ course.title | truncate(25) }}</span>
                                <span class="fw-300 font-13">{{ course.author.full_name }}</span>
                                <div class="d-flex justify-content-between mt-auto">
                                    <span class="fw-600 font-13">{{ trans(`strings.${course.status_code}`) }}</span>
                                    <span class="fw-300 font-13">
                                        <span>
                                            {{ formatCurrency(course.price) }}
                                        </span>
                                        <!-- - {{ trans('strings.public') }} -->
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-8 pl-0">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex flex-column">
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.published_curriculum_lessons') }}
                                </div>
                                <div class="h5">
                                    {{ course.total_published_lessons }}
                                </div>
                                
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.total_lessons') }}
                                </div>
                                <div class="h5">
                                    {{ course.total_lessons }}
                                </div>
                            </div> 
                            
                            <div class="">
                                <a :href="`/course/${course.uuid}/manage/goals`">
                                    {{ trans('strings.go_to_course_management') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['course']
        
    }
</script>