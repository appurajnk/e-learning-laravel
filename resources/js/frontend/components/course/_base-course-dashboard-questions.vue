<template>
    <div class="container">
        <div class="row" v-if="showCreate">
            <div class="col-md-10 offset-md-1">
                <div class="card border-secondary">
                    <div class="card-body">
                        <inc-course-question-form :course="course" action="create"></inc-course-question-form>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row" v-else>
            <div class="col-md-12">
                <form @submit.prevent="search">
                    <div class="card border-secondary rounded-0">
                        <div class="card-body d-flex align-items-center">
                            <div class="flex-grow-1">
                                <input class="form-control rounded-0" 
                                    v-model="form.query" :placeholder="trans('strings.search')"
                                    @keyup="fetchQuestions()"/>
                            </div>
                            <div class="mx-4">{{ trans('strings.or') }}</div>
                            <div class="">
                                <button class="btn btn-md btn-danger rounded-0"
                                    @click.prevent="showCreate=true">
                                    {{ trans('strings.ask_a_new_question') }}
                                </button>
                            </div>
                        </div>
                    </div>
                    
                    <template>
                        <div class="my-4 d-flex justify-content-between">
                            <div>
                                <select class="form-control border-secondary font-14 fw-300"
                                    v-model="form.orderBy"
                                    @change="fetchQuestions()">
                                    <option value="recent">{{ trans('strings.sort_by_recency') }}</option> 
                                    <option value="popular">{{ trans('strings.sort_by_popularity') }}</option> 
                                </select>
                            </div>
                            
                            <div class="d-flex align-items-center">
                                <div class="custom-control custom-checkbox mr-sm-2">
                                    <input type="checkbox" id="questions-unanswered" class="custom-control-input"
                                        value="true" v-model="form.questionsWithoutResponse"
                                        @change="fetchQuestions()"> 
                                    <label for="questions-unanswered" class="custom-control-label">
                                        {{ trans('strings.see_questions_without_responses') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </template>
                </form>
                <div v-if="!loading">
                    <template v-if="questions.data && questions.data.length > 0">
                        <div class="list-group">
                            <a class="list-group-item d-flex align-items-center text-dark" v-for="question in questions.data"
                                :href="`/course/${course.slug}/learn/v1/questions/${question.uuid}`" :key="question.uuid">
                                <div class="mr-3">
                                    <img :src="question.user.picture" width="50" class="rounded-circle" />
                                </div>
                                <div class="flex-grow-1">
                                    <h6 class="fw-600 mb-2">{{ question.title }}</h6>
                                    <p class="font-13">{{ question.short_body }}</p>
                                </div>
                                <div class="d-flex flex-column text-center">
                                    <span class="fw-600">
                                        {{ question.total_answers }}
                                    </span>
                                    <span class="font-13">
                                        {{ question.total_answers | pluralize(trans('strings.response')) }}
                                    </span>
                                </div>
                            </a>
                        </div>
                    </template>
                    <template v-else>
                        <div class="my-4 py-4">
                            {{ trans('strings.no_questions') }}
                        </div>
                    </template>
                </div>
                <vue-element-loading :active="loading" :is-full-screen="false" spinner="bar-fade-scale" color="#ea5352"></vue-element-loading>
            </div>    
            
        </div>
        
    </div>
</template>


<script>
    
    import IncCourseQuestionForm from './imports/_question_form'
    import { mapGetters } from 'vuex'
    import Form from 'vform'
    export default {
        components: {
            IncCourseQuestionForm
        },
        
        props:['course'],

        computed: {
            // ...mapGetters({
            //     loading: 'course/loading'
            // })
        },
        data() {
            return {
                showCreate: false,
                loading: true,
                form: new Form({
                    query: '',
                    orderBy: 'recent',
                    questionsFollowing: false,
                    questionsWithoutResponse: false,
                    questionsWithoutAnswer: false,
                    course: null,
                    page: 1
                }),
                questions: {}
            };
        },    
        
        methods: {
            async fetchQuestions(page = 1){
                this.loading = await true
                this.form.course = await this.course.id
                await this.form.post(`/api/questions/fetchQuestions`)
                    .then(response => {
                        this.questions = response.data
                    }).finally( () =>{
                        this.loading = false
                    })
            }
        },
        
        beforeMount(){
            setTimeout(()=>{
                this.fetchQuestions()
            },100)
            
            this.$bus.$on('create_question:cancelled', () => {
                this.showCreate = false
            })
            .$on('question:created', () => {
                this.fetchQuestions()
                this.showCreate = false
            })
        }
        
        
    }
    
    
</script>
