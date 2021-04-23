<template>
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-white d-flex">
            <div class="mr-3">
                <img :src="review.course.images.thumbnail" width="120" />
            </div>
            <div>
                <a :href="`/course/${review.course.slug}/learn/v1/overview`" class="mb-2 font-13">
                    {{ review.course.title }}
                </a>
                <p class="d-flex align-items-center">
                    <star-rating 
                        :rating="parseFloat(review.course.average_review)"
                        :increment="0.5"
                        :read-only="true" 
                        :show-rating="true"
                        :inline="true"
                        class="mb-2"
                        text-class="font-16 mr-1"
                        :star-size="16"></star-rating>
                        <span class="font-13">{{ trans('strings.average_review') }}</span>
                </p>
            </div>
        </div>
        <div class="card-body d-flex">
            <div class="mr-3 d-flex flex-column">
                <div class="mx-auto">
                    <img :src="review.user.picture" width="40" class="rounded-circle" />
                </div>
                <div>
                    <star-rating 
                        :rating="parseFloat(review.rating)"
                        :increment="0.5"
                        :read-only="true" 
                        :show-rating="false"
                        :inline="true"
                        class="mb-2"
                        :star-size="16"></star-rating>    
                </div>
            </div>
            <div class="flex-grow-1">
                <div class="font-13 mb-2">
                    <a href="#">
                        {{ review.user.full_name }}
                    </a>
                    <span class="text-muted font-12">{{ review.timeago }}</span>
                </div>
                <div class="fw-600 font-14 mb-2">
                    {{ review.title }}
                </div>
                
                <div class="review__body mb-2">
                    {{ review.body }}
                </div>
                <div v-if="!responding">
                    <div class="mt-3" v-if="!review.comments">
                        <button class="btn btn-info btn-sm rounded-0 font-12" @click.prevent="startAction('create')">
                            {{ trans('strings.respond') }}
                        </button>    
                    </div>
                    
                    <div class="review__instructor_response mt-3 p-3 font-13" v-else>
                        <div class="review__instructor_response_arrow"></div>
                        <div class="mb-2">
                            <h4 class="mb-2">
                                {{ review.comments.user.full_name }}
                                <span class="font-13 text-muted">
                                    {{ review.comments.timeago }}
                                </span>
                            </h4>
                            <div class="py-2">
                                {{ review.comments.body }}
                            </div>
                        </div>
                        
                        <button class="btn btn-info btn-sm rounded-0 mr-2" @click.prevent="startAction('edit')">
                            {{ trans('strings.edit') }}
                        </button> 
                        <button type="button" class="btn btn-danger btn-sm rounded-0" href="#" @click.prevent="destroy()">
                            {{ trans('strings.delete') }}    
                        </button>
                    </div>
                    
                </div>
                
                <div class="font-13" v-else>
                    <form @submit.prevent="action=='edit' ? update() : create()">
                        <div class="form-group">
                            <textarea v-model="form.body" class="form-control" v-autosize="form.body"
                                :class="{ 'is-invalid': form.errors.has('body') }"
                                :placeholder="trans('strings.enter_response')"></textarea>
                            <has-error :form="form" field="body"></has-error>
                        </div>
                        <div class="form-group text-right">
                            <a href="#" @click.prevent="cancel()" class="mr-2">{{ trans('strings.cancel') }}</a>
                            
                            <base-button :loading="form.busy" class="btn btn-info btn-sm fw-500" v-if="action=='create'">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                {{ trans('strings.save') }}
                            </base-button>
                            <base-button :loading="form.busy" class="btn btn-info btn-sm fw-500" v-if="action=='edit'">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                {{ trans('strings.update') }}
                            </base-button>
                            
                        </div>
                    </form>
                </div>
                
            </div>
            
        </div>
    </div>
</template>
<script>
    
    import Form from 'vform'
    import axios from 'axios'
    export default {
        name: 'AuthorReview',
       
        props: ['review', 'model', 'user'],
        
        data(){
            
            return {
                responding: false,
                action: 'create',
                form: new Form({
                    body: '',
                    model: '',
                    model_id: ''
                })
                
            }
        },
        
        
        methods: {
            create(){
                this.form.model = this.model
                this.form.modelId = this.review.id
                this.form.post(`/api/comment/storeComment`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('response:created', null)
                        this.responding = false
                        this.action='edit'
                    })
            },
            
            update(){
                this.form.put(`/api/comment/${this.review.comments.id}/updateComment`)
                    .then(() => {
                        this.$bus.$emit('response:created', null)
                        this.responding = false
                        this.action='edit'
                    })
            },
            
            destroy(){
                
                this.$dialog.confirm(this.trans('strings.confirm_delete'), {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/comment/${this.review.comments.id}/destroyComment`)
                            .then(() => {
                                this.$bus.$emit('response:created', null)
                            })        
                    })
            },
            
            cancel(){
                if(this.action=='create'){
                    this.form.reset()
                }
                
                this.form.errors.clear()
                this.responding=false
            },
            
            startAction(action){
                this.action = action
                this.responding=true
            }
        },
        
        mounted() {
            if(this.review.comments){
                this.form.body = this.review.comments.body
                this.action='edit'
            }
            
            this.$watch('review', review => {
                if(review.comments){
                    this.form.body = review.comments.body
                }
            });
        }
        
    }
    
</script>