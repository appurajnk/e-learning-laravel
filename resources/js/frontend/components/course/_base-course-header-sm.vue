<template>
    <!-- Small Header -->
    <section class="fullwidth__fixed w-100 py-2 d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="jumbotron__course_subtitle pb-2">
                        <h3>{{ course.title }}</h3>
                    </div>
                    <div class="d-flex font-12">
                        <div>
                            <star-rating :read-only="true" border-color="transparent" :rating="course.average_review" :increment="0.5" :star-size="13" :show-rating="false" active-color="#f4c150"></star-rating>
                        </div>
                        <div class="ml-1">
                            ({{ course.total_reviews }} {{ course.total_reviews | pluralize(trans('strings.rating')) }})
                        </div>
                        <div class="ml-3">
                            <span>{{ trans('strings.students_enrolled', {number: course.total_students}) }}</span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        props: ['course']
    }
</script>