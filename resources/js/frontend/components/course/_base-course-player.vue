<template>
    <div>
        <section class="player__jumbotron p-3">
            <div class="container-fluid px-0">
                <div class="row">
                    <div class="col-md-9 pr-0" style="min-height: 70vh; ">
                        <vue-element-loading :active="loading" 
                            background-color="rgba(255,255,255,.9)" 
                            :is-full-screen="false" spinner="bar-fade-scale"/>
                        <div class="h-100" v-if="!loading">
                            <template v-if="playing.content_type=='video' || playing.content_type=='youtube'">
                                <base-video-player :sources="sources" :poster="poster" :content_type="playing.content_type"
                                    :next_url="next ? `/course/${course.slug}/learn/v1/lecture/${next.uuid}` : null"></base-video-player>
                            </template>
                            <template v-if="playing.content_type=='article'">
                                <div class="card card-body h-100 article_area" v-html="playing.article_body"></div>
                            </template>
                        </div>
                    </div>
                    <div class="col-md-3 pl-1 d-flex align-self-stretch">
                        <div class="card w-100">
                            <div class="card-header d-flex justify-content-between">
                                <div>
                                    <a :href="`/course/${course.slug}/learn/v1/lecture/${previous.uuid}`" 
                                        class="btn btn-sm" v-if="previous">
                                        <i class="fa fa-angle-left"></i>
                                        {{ trans('strings.previous') }}
                                    </a>
                                </div>
                                <div>
                                    <a :href="`/course/${course.slug}/learn/v1/lecture/${next.uuid}`"
                                        class="btn btn-sm" v-if="next">
                                        {{ trans('strings.next') }}
                                        <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body player__toc p-0">
                                <div class="tc-accordion tc-accordion-stylex" :id="course.slug">
                                    <div class="panel" v-for="(section,index) in sections" :key="section.uuid">
                                        <h4 class="acdn-title py-2 border font-weight-bold font-13">
                                            <a data-toggle="collapse" :data-parent="`#${course.slug}`" 
                                                :href="`#collapse-${section.uuid}`"
                                                :class="{ 'collapsed' : section.id !== playing.section_id }" 
                                                :aria-expanded="section.id == playing.section_id"
                                                :title="section.title">
                                                {{index+1}}: {{ section.title | truncate(30) }}
                                            </a>
                                        </h4>
                                        <div :id="`collapse-${section.uuid}`" 
                                            class="panel-collapse" :aria-expanded="section.id == playing.section_id"
                                            :class="{ 'collapse' : section.id !== playing.section_id }">
                                            <div class="acdn-body p-0">
                                                <div class="list-group list-group-flush">
                                                    <a v-for="lesson in section.lessons" 
                                                        :href="`/course/${course.slug}/learn/v1/lecture/${lesson.uuid}`" 
                                                        class="list-group-item d-flex justify-content-between"
                                                        :class="{ 'active' : lesson.uuid==playing.uuid }"  
                                                        :key="lesson.uuid"
                                                        :title="lesson.title">
                                                        <div class="d-flex">
                                                            <span class="font-12 mr-2">
                                                                <template v-if="lesson.user_has_completed">
                                                                    <span class="fa fa-check-circle text-success"></span>
                                                                </template>
                                                                <template v-else-if="lesson.content_type == 'video'">
                                                                    <span class="fa fa-play-circle"></span>
                                                                </template>
                                                                <template v-else-if="lesson.content_type == 'youtube'">
                                                                    <span class="fab fa-youtube text-danger"></span>
                                                                </template>
                                                                <template v-else-if="lesson.content_type == 'article'">
                                                                    <span class="fa fa-file-text-o"></span>
                                                                </template>
                                                            </span>
                                                            <span>{{ lesson.title | truncate(25) }}</span>
                                                        </div>
                                                        <div class="font-12">
                                                            {{ lesson.durationHMS }}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 

        <section class="bg-white py-4">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h3 class="h5">{{ trans('strings.description') }}</h3>
                        <p>{{ playing.description }}</p>
                    </div>
                    <div class="col-md-6">
                        <h3 class="h5">{{ trans('strings.downloadable_resources') }}</h3>
                        <div class="list-group d-flex justify-content-between" v-if="attachments.length > 0">
                            <div class="list-group-item d-flex justify-content-between"
                                v-for="attachment in attachments" :key="attachment.uuid">
                                <span>{{ attachment.original_filename  }}</span>
                                <a :href="attachment.download_link" target="_blank">{{ trans('strings.download') }}</a>
                            </div>
                        </div>
                        <div v-else>
                            <p>{{ trans('strings.no_attachments') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
</template>


<script>
    import axios from 'axios'
    export default {
        props: ['uuid', 'attachments'],

        data(){
            return {
                loading: true,
                sections: [],
                error: '',
                course: {},
                playing: {},
                next: {},
                previous: {},

                // video options
                sources: [],
                poster: ''
            }
        },
        methods:{
            async fetchVideos(){
                await axios.get(`/api/player/lesson/${this.uuid}`)
                    .then(response => {
                        const data = response.data
                        this.playing = data.playing 
                        this.next = data.next
                        this.previous = data.previous 
                        this.course = data.course
                        this.sections = data.sections

                        this.poster = data.playing.image

                    }).then(() =>{
                        if(['video', 'youtube'].includes(this.playing.content_type)){
                            const video = this.playing.video
                            if(this.playing.content_type=='video' || this.playing.content_type=='youtube'){
                                this.sources.push({
                                    type: this.playing.type,
                                    src: this.playing.video_links.video_720,
                                    label: "720P",
                                    res: 1
                                },
                                {
                                    type: this.playing.type,
                                    src: this.playing.video_links.video_360,
                                    label: "360P",
                                    res: 2
                                })
                            }
                            // if(this.playing.content_type=='youtube'){
                            //     this.sources.push({
                            //         type: this.playing.type,
                            //         src: this.playing.video.youtube_link
                            //     })
                                
                            // }
                        }
                    }).catch(err => {
                        this.error = err.response
                    }).finally( () => {
                        this.loading = false
                    })

            }
        },

        beforeMount(){
           this.fetchVideos()
        }
    }
    
</script>

<style>
    .player__jumbotron{
        background-color: #29303B;
        min-height: 520px;
    }
    .player__toc{
        color: #333;
        /* height: 520px; */
        overflow-y: auto;
    }

    .article_area{
        height: 100%;
        overflow-y: auto;
    }
</style>
