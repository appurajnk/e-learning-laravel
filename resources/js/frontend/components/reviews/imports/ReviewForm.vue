<template>
    
    <div class="modal tc-modal tc-animation-scale text-secondary" id="modalCourseRating">
        <div class="modal-dialog w-40">
            <div class="modal-content modal-padding">
                <div class="modal-header mb-2">
                    <h4 class="modal-title">
                        {{ trans('strings.rate_this_course') }}
                    </h4>
                </div>
                
                <form @submit.prevent="review ? update() : create()">
                    <div class="modal-body">
                        
                        <div class="form-group">
                            <star-rating v-model="form.rating" :increment="0.5" :star-size="30" :show-rating="true" active-color="#f4c150"></star-rating>
                            <has-error :form="form" field="rating"></has-error>
                        </div>
                        <div class="form-group">
                            <input v-model="form.title" class="form-control" 
                                :placeholder="trans('strings.review_subject')" :class="{ 'is-invalid': form.errors.has('title') }" />
                            <has-error :form="form" field="title"></has-error>
                        </div>
                        <div class="form-group">
                            <textarea v-model="form.body" class="form-control" v-autosize="form.body"
                                :class="{ 'is-invalid': form.errors.has('body') }"
                                :placeholder="trans('strings.enter_review')"></textarea>
                            <has-error :form="form" field="body"></has-error>
                        </div>
                        <div class="form-group text-right">
                            <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
                            
                            <base-button :loading="form.busy" class="btn btn-info btn-sm fw-500" v-if="!review">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                {{ trans('strings.save_review') }}
                            </base-button>
                            <base-button :loading="form.busy" class="btn btn-info btn-sm fw-500" v-if="review">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                {{ trans('strings.update_review') }}
                            </base-button>
                        </div>
                    </div>
                    
                    <div class="modal-footer" v-if="review">
                        <button class="btn btn-danger btn-md" @click.prevent="destroy()">
                            {{ trans('strings.delete_review') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</template>


<script>
    
    import Form from 'vform'
    
    export default {
        name: 'ReviewForm',
        
        props: ['course', 'review'],
        
        data(){
            
            return {
                form: new Form({
                    rating: 0,
                    body: '',
                    title: '',
                    course: ''
                }),
                
            }
        },
        
        
        methods: {
            create(){
                this.form.course = this.course.id
                this.form.post(`/api/course/storeReview`)
                    .then( () => {
                        this.cancel()
                        this.$bus.$emit('review:created', null)
                    })
            },
            
            update(){
                this.form.put(`/api/review/${this.review.id}/updateReview`)
                    .then( () => {
                        this.cancel()
                        this.$bus.$emit('review:created', null)
                    })
            },
            
            cancel(){
                if(!this.review){
                    this.form.reset()
                }
                this.form.errors.clear()
                $('#modalCourseRating').modal('hide')
            },
            
            destroy(){
                this.$dialog.confirm(this.trans('strings.confirm_delete'), {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/review/${this.review.id}/delete`)
                            .then(() => {
                                this.cancel()
                                this.form.reset()
                                this.$bus.$emit('review:created', null)
                            })        
                    })
            }
            
        },
        
        created() {
            if(this.review){
                this.form.rating = parseFloat(this.review.rating)
                this.form.comment = this.review.comment
                this.form.title = this.review.title
            }
            
            this.$watch('review', review => {
                if(review){
                    this.form.rating = parseFloat(this.review.rating)
                    this.form.comment = this.review.comment
                    this.form.title = this.review.title
                }
            });
        }
        
    }
    
</script>