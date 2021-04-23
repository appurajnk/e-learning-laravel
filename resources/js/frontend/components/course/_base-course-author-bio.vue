<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <div class="course__content py-2 d-flex justify-content-between">
                <base-heading :text="trans('strings.about_the_instructor')"></base-heading>
            </div>
            <div class="row">
                <div class="col-md-3 d-flex flex-column">
                    <img :src="author.picture" width="100" height="100" class="rounded-circle" />
                    <div class="d-flex">
                        <div class="font-13">
                            <ul class="course_details__includes">
                                <li><i class="sl sl-icon-star"></i> {{ author.average_review }} {{ trans('strings.instructor_rating') }}</li>
                                <li><i class="sl sl-icon-bubbles"></i> {{ author.total_reviews }} {{ author.total_reviews | pluralize(trans('strings.review')) }}</li>
                                <li><i class="sl sl-icon-people"></i> {{ author.total_students }} {{ author.total_students | pluralize(trans('strings.student')) }}</li>
                                <li><i class="sl sl-icon-camrecorder"></i> {{ author.total_courses }} {{ author.total_courses | pluralize(trans('strings.course')) }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
                
                <div class="col-md-9">
                    <a :href="`/user/${author.username}`" class="fw-600">
                        <h1 class="mb-2 font-18">{{ author.full_name }}</h1>
                    </a>
                    
                    <h1 class="mb-2 leading fw-600 font-14">
                        {{ author.tagline }}
                    </h1>
                    
                    <div class="author__bio font-14">
                        <div v-html="author.bio"></div>
                    </div>
                </div>
            </div>
        </div>    
    </div>
    
</template>

<script>
    
    export default {
        props: ['author']
    }
</script>