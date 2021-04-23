<template>
    <div class="mt-4">
        <form @submit.prevent="submitForReview">
            <base-button :loading="form.busy" class="btn btn-block btn-lg font-14 btn-danger rounded-0">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ trans('strings.submit_for_review') }}
            </base-button>
        </form>

        <div class="modal fade" id="submitForReview" 
            tabindex="-1" role="dialog" aria-labelledby="submitForReviewModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">
                            {{ trans('strings.why_cant_i_submit') }}
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <p>
                            {{ trans('strings.almost_ready') }}
                        </p>
                        <div class="list-group list-group-flush">
                            <li class="list-group-item" v-if="!check.content_check_passed">
                                <span v-html="trans('strings.submit_error_missing_content', {'url': `/course/${uuid}/manage/curriculum` })"></span>
                            </li>
                            <li class="list-group-item" v-if="!check.course_image_passed">
                                <span v-html="trans('strings.submit_error_missing_image', {'url': `/course/${uuid}/manage/basics` })"></span>
                            </li>
                            <li class="list-group-item" v-if="!check.course_description_passed">
                                <span v-html="trans('strings.submit_error_missing_description', {'url': `/course/${uuid}/manage/basics` })"></span>
                            </li>
                            <li class="list-group-item" v-if="!check.target_students_passed">
                                <span v-html="trans('strings.submit_error_missing_target', {'url': `/course/${uuid}/manage/goals` })"></span>
                            </li>
                            <li class="list-group-item" v-if="!check.what_to_learn_passed">
                                <span v-html="trans('strings.submit_error_missing_goals', {'url': `/course/${uuid}/manage/goals` })"></span>
                            </li>
                            <li class="list-group-item" v-if="!check.requirements_passed">
                                <span v-html="trans('strings.submit_error_missing_requirements', {'url': `/course/${uuid}/manage/goals` })"></span>
                            </li>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">
                            {{ trans('strings.close') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </div>
</template>

<script>
    
    import Form from 'vform'
    export default {
        props: ['uuid'],
        data(){
            return {
                form: new Form({}),
                check: []
            }
        },
        
        methods: {
            showModal(){
                $('#submitForReview').modal({
                    backdrop: 'static',
                    keyboard: false
                })
            },
            submitForReview(){
                this.form.get(`/api/author/course/${this.uuid}/submit`)
                        .then(response => {
                            if(!response.data.message){
                                this.check = response.data
                                this.showModal()
                            } else {
                                location.reload();
                            }
                    })
                
                
            }
        }
        
        
    }
    
</script>