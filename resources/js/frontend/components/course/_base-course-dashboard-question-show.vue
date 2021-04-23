<template>
    <div class="container">
        <div class="row" v-if="showEdit">
            <div class="col-md-10 mx-auto">
                <div class="card border-secondary shadow-sm">
                    <div class="card-body">
                        <inc-course-question-form 
                            :course="course" 
                            :question="question" 
                            action="edit"></inc-course-question-form>
                    </div>
                </div>
            </div>
        </div>
        
        
        <div class="row" v-else>
            <div class="col-md-10 mx-auto">
                <div class="mb-3">
                    <a :href="`/course/${course.slug}/learn/v1/questions`">
                        {{ trans('strings.back_to_questions') }}
                    </a>
                </div>
                
                <div class="card border-secondary rounded-0 shadow-sm" v-if="question">
                    <div class="card-body d-flex">
                        <div class="mr-3">
                            <img :src="question.user.picture" width="50" class="rounded-circle" />
                        </div>
                        <div class="flex-grow-1">
                            <h6 class="fw-600">
                                {{ question.title }}
                            </h6>
                            <p class="text-muted font-13">
                                {{ question.user.full_name }} |
                                <span>{{ question.timeago }}</span>
                            </p>
                            <div v-html="question.body" class="font-14"></div>
                            <div class="mt-2 text-right font-13" v-if="user.id == question.user_id">
                                <a href="#" @click.prevent="showEdit=true">{{ trans('strings.edit') }}</a> | 
                                <a href="#" @click.prevent="destroyQuestion()" class="text-danger">{{ trans('strings.delete') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <base-comments inline-template model="\App\Models\Question" :model_obj="question" :model_id="question.id" :user="user">
                        <div class="card-footer">
                            <div class="comment__list mb-4">
                                <div class="list-group">
                                    <base-comment inline-template 
                                        v-for="comment in comments.data" 
                                        :obj_comment="comment" 
                                        :model_obj="model_obj"
                                        :key="comment.id" 
                                        :user="user"
                                        v-bind="{ fetchComments }">
                                        <div class="list-group-item border border-0 d-flex mb-2" 
                                            :class="{ 'bg-warning-light' : obj_comment.marked_as_answer }">
                                            <div class="mr-3">
                                                <img :src="obj_comment.user.picture" width="45" class="rounded-circle" />
                                            </div>
                                            <div class="flex-grow-1" v-if="!showEdit">
                                                <h6 class="fw-600 mb-2">
                                                    {{ obj_comment.user.full_name }} |
                                                    <span class="text-muted font-12">{{ obj_comment.timeago }}</span>
                                                    <span class="font-12 ml-2" v-if="obj_comment.marked_as_answer">
                                                        <i class="fa fa-star text-warning"></i>
                                                        {{ trans('strings.answer') }}
                                                    </span>
                                                </h6>
                                                
                                                <div v-html="obj_comment.body" class="font-13"></div>
                                                
                                                <div class="mt-3 font-12">
                                                    <template v-if="user.id == model_obj.user_id || user.id == model_obj.course.author.id">
                                                        <a href="#" class="text-success mr-3"
                                                            v-if="! obj_comment.marked_as_answer" 
                                                            @click.prevent="markAsAnswer()">
                                                            {{ trans('strings.mark_as_answer') }}
                                                        </a>
                                                    </template>
                                                    
                                                    <span v-if="user.id == obj_comment.user_id">
                                                        <a href="#" @click.prevent="showEdit=true">{{ trans('strings.edit') }}</a> | 
                                                        <a href="#" @click.prevent="destroy()" class="text-danger">{{ trans('strings.delete') }}</a>
                                                    </span>
                                                </div>
                                            </div>
                                            <div class="flex-grow-1" v-else>
                                                <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                                                    <div class="form-group bg-white">
                                                        <div class="quill-editor" 
                                                            :content="form.body"
                                                            @change="onEditorChange($event)"
                                                            v-quill:myQuillEditor="editorOption"></div>
                                                        <has-error :form="form" field="body"/>
                                                    </div>
                                                    
                                                    <div class="text-right">
                                                        <a href="#" @click.prevent="showEdit=false" class="mr-3">
                                                            {{ trans('strings.cancel') }}
                                                        </a>
                                                        <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500">
                                                            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                                            {{ trans('strings.update') }}
                                                        </base-button>
                                                    </div>
                                                    
                                                </form>
                                            </div>
                                        </div>    
                                    </base-comment>
                                    
                                    <div class="comments__pagination">
                                        <pagination 
                                            class="pagination-sm justify-content-end text-info"
                                            :data="comments" 
                                            @pagination-change-page="fetchComments" 
                                            :show-disabled="true"
                                            :limit="2"></pagination>
                                    </div>
                                    
                                </div>
                            </div>
                            
                            
                            <form @submit.prevent="create" @keydown="form.onKeydown($event)" v-if="!showEditComment">
                                <div class="form-group bg-white">
                                    <quill-editor :content="form.body"
                                        :options="editorOption"
                                        @change="onEditorChange($event)">
                                    </quill-editor>
                                    <has-error :form="form" field="body"/>
                                </div>
                                <div class="text-right">
                                    <base-button :loading="form.busy" class="btn btn-danger rounded-0 font-12 fw-500">
                                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                        {{ trans('strings.post_answer') }}
                                    </base-button>
                                </div>
                            </form>
                        </div>
                    </base-comments>
                    
                </div>
                
            </div>  
        </div>
    </div>
</template>


<script>

    import IncCourseQuestionForm from './imports/_question_form'
    import { mapGetters } from 'vuex'
    import Form from 'vform'
    import axios from 'axios'
    export default {
        components: {
            IncCourseQuestionForm
        },

        props: ['course', 'p_question', 'user'],
        
        data() {
            return {
                showEdit: false,
                showEditComment: false,
                question: null
            };
        },    
        
        computed: {
            ...mapGetters({
                loading: 'course/loading',
            })
        },

        methods: {
            fetchQuestion(){
                axios.get(`/api/questions/${this.question.uuid}`)
                    .then(response => {
                        this.question = response.data
                    })
            },
            
            destroyQuestion(){
                this.$dialog.confirm({title: this.trans('strings.confirm_delete'), body: this.trans('strings.question_and_replies_will_be_deleted')}, {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/questions/${this.question.id}`)
                            .then(() => {
                                location.href=`/course/${this.course.slug}/learn/v1/questions`
                            })        
                    })
            }
        },
        
        created(){
            this.question = this.p_question
            this.$bus.$on('create_question:cancelled', () => {
                this.showEdit = false
            })
            .$on('question:updated', () => {
                this.fetchQuestion()
                this.showEdit = false
            })
        }
        
    }
    
    
</script>
