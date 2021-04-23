<template>
    <div class="col-md-12">
        <div class="d-flex align-items-center" v-cloak>
            <div class="course_overview__image mr-3">
                <a :href="`/course/${course.slug}/learn/v1/lecture/${uuid}`">
                    <div class="play-button-trigger d-flex flex-column justify-content-end">
                        <div class="play-button d-flex justify-content-center align-items-center">
                            <i class="fas fa-play-o fa-3x"></i>
                        </div>
                    </div>
                    <img :src="course.images.thumbnail" class="rounded" width="340"/>
                </a>
            </div>
            
            <div class="jumbotron__course_subtitle pb-2 flex-grow-1">
                <div class="h3">
                    <a href="#" class="text-white">
                        {{ course.title }}
                    </a>
                </div>
                <a :href="`/course/${course.slug}/learn/v1/lecture/${uuid}`" class="btn btn-danger btn-lg font-14 my-2 rounded-0">
                    {{ trans('strings.continue_watching') }}
                </a>
                <div v-if="show_rating">
                    <a href="#" 
                        data-toggle="modal"
                        data-target="#modalCourseRating"
                        class="text-info">
                        <star-rating 
                            :rating="userRating ? parseFloat(userRating.rating) : 0" 
                            :read-only="true" 
                            :show-rating="false"
                            :inline="true"
                            class="mb-2"
                            glow-color="transparent"
                            :star-size="15"></star-rating>
                        <span v-if="!userRating">
                            {{ trans('strings.rate_this_course') }}
                        </span>
                        <span v-else>
                            {{ trans('strings.edit_your_rating') }}
                        </span>
                    </a> 
                    <base-review-form :course="course" :review="userRating"></base-review-form>
                </div>
            
                <div class="mt-4 d-flex flex-column">
                    <div class="d-flex justify-content-between align-items-center">
                        <div class="">
                            {{ totalCompleted }} / {{ totalLessons }} {{ trans('strings.completed') }}
                        </div>
                        <div class="h3">
                            <i class="fa fa-trophy"></i>
                        </div>
                    </div>
                    <div class="progress">
                        <div class="progress-bar bg-info rounded-0" role="progressbar" 
                            :aria-valuenow="percentCompleted" 
                            aria-valuemin="0" aria-valuemax="100" 
                            :style="`width:${percentCompleted}%`">
                            <span class="sr-only">
                                {{ trans('strings.percent_completed') }}
                            </span>
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'

    export default {
        props: ['course'],
        name: 'CourseDashboardHeader',
        data(){
            return {
                firstLesson: [],
                lastWatched: [],
                uuid: '',
                totalLessons: 0,
                totalCompleted: 0,
                percentCompleted: 0,
                userRating: [],
                show_rating: false
            }
        },
        
        computed: {
            ...mapGetters({
                loading: 'course/loading'
            })
        },
        
        methods: {
            resetProgress(){
                this.$dialog.confirm({title: this.trans('strings.reset-all-course-progress'), body: this.trans('strings.all-lecture-and-quiz-progress-will-be-reset')}, {animation: 'fade'})
                    .then(dialog => {
                        axios.post(`/api/course/${this.course.id}/reset-progress`)
                            .then(() => {
                                this.fetchInfo()
                            })        
                    })
                
            },

            fetchInfo(){
                axios.get(`/api/course/${this.course.id}/dashboard-header-info`)
                    .then(response => {
                        //console.log(response.data)
                        this.firstLesson = response.data.firstLesson
                        this.lastWatched = response.data.lastWatched
                        this.uuid = response.data.uuid
                        this.totalLessons = response.data.totalLessons
                        this.totalCompleted = response.data.totalCompleted
                        this.percentCompleted = response.data.percentCompleted
                        this.userRating = response.data.userRating
                        this.show_rating = true
                    })
            }
        },

        mounted(){
            this.fetchInfo()
            this.$bus.$on('completion:toggled', () => {
                this.fetchInfo()
            })
            .$on('review:created', () => {
                this.fetchInfo()
            })
        }
    }
</script>

