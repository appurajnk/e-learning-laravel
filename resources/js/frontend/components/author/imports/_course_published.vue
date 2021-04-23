<template>
    <div class="row">
        <div class="col-md-12">
            <div class="bg-white p-2 mb-2 border border-secondary">
                <div class="row">
            
                    <div class="col-md-4">
                        <div class="d-flex">
                            <div class="mr-3x">
                                <img :src="course.images.thumbnail" width="175" class="shadow-sm" />
                            </div>
                            
                            <div class="border border-left-0 border-bottom-0 border-top-0 d-flex flex-column px-3 flex-grow-1">
                                <span class="fw-600 font-15 mb-2">{{ course.title }}</span>
                                <span class="fw-300 font-13">{{ course.author.full_name }}</span>
                                <div class="d-flex justify-content-between mt-auto">
                                    <span class="fw-600 font-13 text-success">{{ trans(`strings.${course.status_code}`) }}</span>
                                    <span class="fw-300 font-13">
                                        <span>
                                            {{ formatCurrency(course.price) }}
                                        </span> 
                                        <!-- - {{ trans('strings.public') }}    -->
                                    </span>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                    
                    <div class="col-md-2 pl-0">
                        <div class="d-flex justify-content-between align-items-center border border-left-0 border-bottom-0 border-top-0">
                            <div class="d-flex flex-column">
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.earned_this_month') }}
                                </div>
                                <div class="h5">
                                    {{ formatCurrency(course.sales_this_month, false) }}
                                </div>
                                
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.total_earned') }}
                                </div>
                                <div class="h5">
                                    {{ formatCurrency(course.total_sales, false) }}
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="col-md-2 pl-0">
                        <div class="d-flex justify-content-between align-items-center border border-left-0 border-bottom-0 border-top-0">
                            <div class="d-flex flex-column">
                                <div class="small text-muted mb-1">
                                   {{ trans('strings.course_rating') }}
                                </div>
                                <div class="h5">
                                    {{ course.average_review }} 
                                    <small class="font-14">({{ course.total_reviews }} {{ course.total_reviews | pluralize(trans('strings.review')) }})</small>
                                </div>
                                
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.unanswered_questions') }}
                                </div>
                                <div class="h5">
                                    {{ course.total_unanswered_questions }}
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="col-md-2 pl-0">
                        <div class="d-flex justify-content-between align-items-center border border-bottom-0 border-top-0 border-left-0">
                            <div class="d-flex flex-column">
                                <div class="small text-muted mb-1">
                                   {{ trans('strings.enrolled_this_month') }}
                                </div>
                                <div class="h5">
                                    {{ course.enrolled_this_month }}
                                </div>
                                
                                <div class="small text-muted mb-1">
                                    {{ trans('strings.total_students') }}
                                </div>
                                <div class="h5">
                                    {{ course.total_students }}
                                </div>
                            </div> 
                        </div>
                    </div>
                    
                    <div class="col-md-2 pl-0 d-flex justify-content-end align-items-center">
                        <a :href="`/course/${course.uuid}/manage/goals`">
                            {{ trans('strings.go_to_course_management') }}
                        </a>
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