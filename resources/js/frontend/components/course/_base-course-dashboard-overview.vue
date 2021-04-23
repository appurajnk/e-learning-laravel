<template>
    <div class="container" v-cloak>                    
        <div class="row">
            <div class="col-md-12">
                <h1 class="fw-600 font-18 mb-2">{{ trans('strings.recent_activity') }}</h1>
                <div class="row d-flex">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header fw-600">
                                {{ trans('strings.recent_questions') }}
                            </div>
                            <div class="card-body p-0" v-if="recentQuestions.length">
                                <div class="list-group-flush">
                                    <a :href="`/course/${course.slug}/learn/v1/questions/${q.uuid}`" 
                                    class="list-group-item d-flex align-items-center text-dark" 
                                    v-for="q in recentQuestions" :key="q.uuid">
                                        <div class="mr-2">
                                            <img :src="q.user.picture" width="30" class="rounded-circle" />
                                        </div>
                                        <div>
                                            {{ q.title }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body" v-else>
                                <p>{{ trans('strings.no_questions_yet') }}</p>
                            </div>
                            <div class="card-footer">
                                <a :href="`/course/${course.slug}/learn/v1/questions`">
                                    {{ trans('strings.browse_all_questions') }}
                                </a>
                            </div>
                        </div>    
                    </div>
                        
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header fw-600">
                                {{ trans('strings.recent_announcements') }}
                            </div>
                            <div class="card-body p-0" v-if="recentAnnouncements.length">
                                <div class="list-group-flush">
                                    <a :href="`/course/${course.slug}/learn/v1/announcements`" 
                                    class="list-group-item d-flex align-items-center text-dark" 
                                    v-for="announcement in recentAnnouncements" :key="announcement.uuid">
                                        <div class="mr-2">
                                            <img :src="announcement.user.picture" width="30" class="rounded-circle" />
                                        </div>
                                        <div>
                                            {{ announcement.title }}
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body" v-else>
                                <p>{{ trans('strings.no_announcements_yet') }}</p>
                            </div>
                            <div class="card-footer">
                                <a :href="`/course/${course.slug}/learn/v1/announcement`">
                                    {{ trans('strings.browse_all_announcements') }}
                                </a>
                            </div>
                        </div>    
                    </div>
                </div><!--/ END ROW -->
                    
            </div>  
            <hr />
            
            <div class="col-md-12 mt-4">
                <div class="row">
                    <div class="col-md-9">
                        <h1 class="fw-600 font-18 mb-2">{{ trans('strings.course_description') }}</h1>
                        <p v-html="course.description"></p>
                    </div>
                    <div class="col-md-3">
                        <h1 class="fw-600 font-18 mb-2">{{ trans('strings.course_includes') }}</h1>
                        <div class="font-16">
                            <ul class="course_details__includes">
                                <li><i class="sl sl-icon-camrecorder"></i> 
                                    {{ trans('strings.hours_of_video_content', {number: course.total_video_hours}) }}</li>
                                <li><i class="sl sl-icon-docs"></i> {{ course.total_articles }} {{ trans('strings.article') }}</li>
                                <li><i class="sl sl-icon-badge"></i> {{ trans('strings.certificate_of_completion') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            
            <hr />
            
            <!-- AUTHOR -->
            <div class="col-md-12" v-if="!loading">
                <base-course-author-bio :author="course.author" />
            </div>

            <base-reviews :course="course"></base-reviews>
        </div>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import axios from 'axios'
    export default {
        props: ['course'],
        data() {
            return {
                recentQuestions: [],
                recentAnnouncements: []
            };
        },

        computed: {
            ...mapGetters({
                loading: 'course/loading'
            })
        },

        methods: {
            fetchOverviewInfo(){
                axios.get(`/api/course/${this.course.id}/fetchOverviewInfo`)
                    .then(response => {    
                        this.recentQuestions = response.data.questions
                        this.recentAnnouncements = response.data.announcements
                    })
            }
        },

        mounted(){
            this.fetchOverviewInfo()
        }
    }
</script>
