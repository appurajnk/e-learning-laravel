<template>
    <section class="py-2 jumbotron__course_details">
        <div class="container text-white">
            <div class="row pt-4">
                <div class="col-md-8">
                    <div class="jumbotron__course_title mb-3">
                        <h1>{{ course.title }}</h1>
                    </div>
                    <div class="jumbotron__course_subtitle mb-3">
                        <h3>{{ course.subtitle }}</h3>
                    </div>
                    <div class="pop__category_sm mb-3 pop__stats">
                        <base-course-stats :course="course" class="text-white" />
                    </div>
                    <div class="d-flex mb-3 d-flex">
                        <div class="mr-2 d-flex font-13">
                            <star-rating :read-only="true" border-color="transparent" :rating="course.average_review" :increment="0.5" :star-size="15" :show-rating="false" active-color="#f4c150"></star-rating>
                            &nbsp; ({{ course.total_reviews }} {{ course.total_reviews | pluralize(trans('strings.rating'))}})
                        </div>
                        <div>
                            {{ trans('strings.students_enrolled', { number: course.total_students } ) }}
                        </div>
                    </div>
                    <div class="mb-3 d-flex">
                        <div class="mr-2">
                            {{ trans('strings.created_by') }} 
                            <a :href="`/user/${course.author.username}`">{{ course.author.full_name }} </a>
                        </div>
                        <div>
                            {{ trans('strings.last_updated') }}
                            {{ $moment(course.updated_at).format('M/YYYY') }}
                        </div>
                    </div>
                </div>
                
                <div class="col-md-4 d-flex justify-content-end">
                    <div class="course_details__preview right-col__content d-flex flex-column">
                        <div class="jumbotron__right_preview right-col__module">
                            <div class="clp-component-render">
                                <div class="introduction-asset d-flex flex-column">
                                    <div class="introduction-asset__inner d-flex flex-column">
                                        <a role="button" @click.prevent="showModal()">
                                            <div class="play-button-trigger d-flex flex-column justify-content-end" v-if="Object.keys(preview).length > 0">
                                                <div class="play-button d-flex justify-content-center align-items-center">
                                                    <i class="fa fa-play-circle fa-4x"></i>
                                                </div>
                                                <span class="txt__preview">
                                                    {{ trans('strings.preview') }}
                                                </span>
                                            </div>
                                            <img :src="course.images.thumbnail" width="350"/>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            
                            
                            <div class="right-col__inner d-flex flex-column">
                                <div class="d-flex flex-column">
                                    <div class="d-flex align-items-center justify-content-start">
                                        <template v-if="course.price_discounted">
                                            <h1 class="course_details__current_price">
                                                <base-currency :price="course.price_discounted"></base-currency>    
                                            </h1>
                                            <h3 class="course_details__old_price ml-1">
                                                <base-currency :price="course.price"></base-currency>
                                            </h3>
                                        </template>
                                        <template v-else>
                                            <h1 class="course_details__current_price">
                                                <base-currency :price="course.price"></base-currency>    
                                            </h1>
                                        </template>
                                    </div>
                                    <template v-if="course.price > 0">
                                        <div class="course_details__actions mt-2">
                                            <div class="mb-2">
                                                <base-add-to-cart
                                                    :course="course" 
                                                    css_class="btn btn-danger btn-lg btn-block rounded-0" />
                                            </div>
                                            <a :href="`/cart/checkout/express/course/${course.uuid}`" class="btn btn-outline-info btn-lg btn-block rounded-0">
                                                {{ trans('strings.buy_now') }}
                                            </a>
                                        </div>
                                    </template>
                                    <template v-else>
                                        <base-enroll-now-button :courses="course" source="course" />
                                    </template>
                                </div>
                                
                                <p class="text-center font-13 mt-1">
                                    {{ trans('strings.30_days_guarantee') }}
                                </p>
                                <div class="mt-3">
                                    <h5 class="mb-2"> {{ trans('strings.includes') }}</h5>
                                    <div class="font-13">
                                        <ul class="course_details__includes">
                                            <li><i class="sl sl-icon-camrecorder"></i> {{ trans('strings.hours_of_video_content', {number: course.total_video_hours}) }}</li>
                                            <li><i class="sl sl-icon-docs"></i> {{ course.total_articles }} {{ course.total_articles | pluralize(trans('strings.article')) }}</li>
                                            <li><i class="sl sl-icon-badge"></i> {{ trans('strings.certificate_of_completion') }}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            
                        </div>
                        
                    </div>
                </div>
            </div>
            
        </div>

        <!-- Preview Modal -->
        <div class="modal fade text-dark" id="video_preview">
            <div class="modal-dialog modal-lg">
                <div class="modal-content rounded-0">
                    <!-- Modal Header -->
                    <div class="modal-header rounded-0 bg-dark text-white py-1">
                        <button type="button" class="close text-white" @click="hideModal()">&times;</button>
                    </div>

                    <!-- Modal body -->
                    <div class="modal-body p-0">
                        <base-video-player v-if="modalOpen" 
                            :sources="sources"
                            content_type="preview.type"></base-video-player>
                    </div>

                    <!-- <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    </div> -->

                </div>
            </div>
        </div>
        <!--/ End Preview Modal -->

        
    </section>
</template>

<script>
    // import VideoPlayer from './imports/_video_player'
    export default {
        props: ['course', 'preview'],
        
        components: {
            // VideoPlayer
        },
        data(){
            return {
                modalOpen: false
            }
        },

        computed:{
            sources(){
                if(Object.keys(this.preview).length > 0){
                    let vpath = this.preview.content_type == 'video' ? `/uploads/videos/${this.preview.video.streamable_sm}` : this.preview.video.youtube_link
                    return [{
                        type: this.preview.type,
                        src: vpath,
                        label: "340P",
                        res: 1
                    }]
                }
                return []
            }
        },

        methods:{
            async showModal(){
                this.modalOpen = await true
                await $('#video_preview').modal({show: true, backdrop: 'static', keyboard: false })
            },

            hideModal(){
                this.modalOpen = false
                $('#video_preview').modal('hide')
                this.$bus.$emit('video:stop')
            }
        }
    }
</script>