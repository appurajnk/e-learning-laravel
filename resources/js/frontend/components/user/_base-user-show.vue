<template>
    <div>
        <section class="course__list py-4 bg-white">
            <div class="container">
                <div class="row">
                    <div class="col-md-3">
                        <div class="d-flex flex-column justify-content-center">
                            <div class="d-flex justify-content-center mb-3">
                                <img :src="user.picture" width="120" height="120" class="rounded-circle" />
                            </div>
                            
                            <template v-if="auth_user && auth_user.id !== user.id">
                                <button class="btn btn-danger rounded-0 btn-lg mb-3" 
                                    v-if="!messaging" @click="messaging = true">
                                    {{ trans('strings.send_message') }}
                                </button>
                            </template>
                            
                            <div class="d-flex justify-content-center">
                                <a :href="user.website" target="_blank" class="font-22 mr-2" v-if="user.website">
                                    <i class="fa fa-globe"></i>
                                </a>
                                <a :href="`http://linkedin.com/${user.linkedin}`" target="_blank" class="font-22 mr-2" v-if="user.linkedin">
                                    <i class="fa fa-linkedin"></i>
                                </a>
                                <a :href="`http://facebook.com/${user.facebook}`" target="_blank" class="font-22 mr-2" v-if="user.facebook">
                                    <i class="fa fa-facebook"></i>
                                </a>
                                <a :href="`http://github.com/${user.github}`" target="_blank" class="font-22 mr-2" v-if="user.github">
                                    <i class="fa fa-github"></i>
                                </a>
                                <a :href="`http://youtube.com/${user.youtube}`" target="_blank" class="font-22 mr-2" v-if="user.youtube">
                                    <i class="fa fa-youtube"></i>
                                </a>
                                <a :href="`http://twitter.com/${user.twitter}`" target="_blank" class="font-22 mr-2" v-if="user.twitter">
                                    <i class="fa fa-twitter"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <template v-if="!messaging">
                            <transition name="slidedown" tag="div" mode="out-in">
                                <div>
                                    <div v-html="user.bio"></div>
                                    <div class=" mt-4 d-flex">
                                        <div class="text-center">
                                            <div class="font-14 text-muted mr-3 mb-2">
                                                {{ trans('strings.total_students') }}
                                            </div>
                                            <div class="font-36 fw-100">
                                                {{ user.total_students }}
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <div class="font-14 text-muted mr-3 mb-2">
                                                {{ trans('strings.total_courses') }}
                                            </div>
                                            <div class="font-36 fw-100">
                                                {{ user.total_courses }}
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <div class="font-14 text-muted mr-3 mb-2">
                                                {{ trans('strings.reviews') }}
                                            </div>
                                            <div class="font-36 fw-100">
                                                {{ user.total_reviews }}
                                            </div>
                                        </div>

                                        <div class="text-center" v-if="user.total_reviews > 0">
                                            <div class="font-14 text-muted mr-3 mb-2">
                                                {{ trans('strings.average_rating') }}
                                            </div>
                                            <div class="font-36 fw-100">
                                                {{ user.average_review }}
                                            </div>
                                        </div>

                                    </div>
                                </div>
                            </transition>
                        </template>
                        <template v-else>
                            <transition name="slidedown" tag="div">
                                <form @submit.prevent="send">
                                    <div class="form-group">
                                        <textarea class="form-control" rows="5" :class="{ 'is-invalid': form.errors.has('description') }" :placeholder="trans('strings.enter_your_message')" v-autosize="form.message" v-model="form.message"></textarea>
                                        <has-error :form="form" field="message"/>
                                    </div>
                                    <div class="form-group d-flex justify-content-between">
                                        <button class="btn btn-link text-danger text-uppercase" @click.prevent="cancel">{{ trans('strings.cancel') }}</button>
                                        <base-button class="btn-info rounded-0" :loading="form.busy">
                                            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                            {{ trans('strings.send') }}
                                        </base-button>
                                    </div>
                                </form>
                            </transition>
                        </template>
                    </div>
                </div> <!-- END ROW -->

            </div>
        </section>

        <section class="bg-light py-4 tc-post-grid-style1 sec-spacer" 
            v-if="user && user.authored_courses && user.authored_courses.length">
            <div class="container">
                <div class="row">
                    <base-course-card v-for="course in user.authored_courses" :course="course" :key="course.uuid"></base-course-card>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
export default {
    props: ['user', 'auth_user'],
    data(){
        return {
            messaging: false,
            form: new Form({
                message: ''
            })
        }
    },
    
    methods: {
        cancel(){
            this.messaging = false
            this.form.reset()
        },
        send(){
            this.form.recipient = this.user.id
            this.form.post(`/api/conversations`)
                .then(response => {
                    this.cancel()
                })
                
        }
    }
}
</script>
