<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form @submit.prevent="fetchAuthorQuestions">
                    <div class="dashboard__searchform border border-secondary p-2 rounded">
                        <select class="form-control font-14 fw-300 border border-secondary"
                            v-model="form.course"
                            @change="fetchAuthorQuestions()">
                            <option value>{{ trans('strings.all_courses') }}</option>
                            <option v-for="course in live_courses" :value="course.id" :key="course.id">
                                {{ course.title | truncate(25) }}
                            </option> 
                        </select>
                        <hr />
                        
                        <ul class="filer-list mt-4">
                            <li>
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="true" v-model="form.questionsWithoutResponse" 
                                        class="custom-control-input" id="questions-no-responses" 
                                        @change="fetchAuthorQuestions()">
                                    <label class="custom-control-label" for="questions-no-responses">
                                        {{ trans('strings.questions_without_responses') }}
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="true" v-model="form.questionsWithoutAnswer" 
                                        class="custom-control-input" id="questions-unanswered" 
                                        @change="fetchAuthorQuestions()">
                                    <label class="custom-control-label" for="questions-unanswered">
                                        {{ trans('strings.no_answer_marked') }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <hr />
                        
                        <div>
                            <div class="mb-2">{{ trans('strings.sort_by') }}</div>
                            <select class="form-control font-14 fw-300 border border-secondary"
                                v-model="form.orderBy"
                                @change="fetchAuthorQuestions()">
                                <option value="recent">
                                    {{ trans('strings.recency') }}
                                </option> 
                                <option value="popular">
                                    {{ trans('strings.popularity') }}
                                </option> 
                            </select>
                        </div>
                        
                        <div class="row mt-4" v-if="loading">
                            <div class="col-md-12 text-center">
                                <span class="loader loader-quart-1"></span>
                            </div>    
                        </div>
                        
                    </div>
                    
                </form>
            </div>
            
            <div class="col-md-9">
                    <div v-if="questions && questions.data && questions.data.length > 0">
                    <transition-group name="slidedown">
                        <inc-author-question v-for="question in questions.data" 
                            :question="question" 
                            model="\App\Models\Question"
                            :user="user"
                            :key="question.id"></inc-author-question>
                    </transition-group>
                    <div class="d-block">
                        <pagination 
                            class="pagination-sm justify-content-endx text-info"
                            :data="questions" 
                            @pagination-change-page="fetchAuthorQuestions" 
                            :show-disabled="true"
                            >
                            <span slot="prev-nav">
                                <i class="fa fa-angle-double-left"></i>
                            </span>
                            <span slot="next-nav">
                                <i class="fa fa-angle-double-right"></i>
                            </span>
                        </pagination>
                    </div> 
                    </div>
                    
                    <div class="text-center" v-else>
                    <p>{{ trans('strings.no_questions') }}</p>
                </div>
                
            </div>
        
        </div>
    </div>
</template>


<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    import IncAuthorQuestion from './imports/_author_question'
    export default {
        components: {
            IncAuthorQuestion
        },
        
        props: ['user'],

        data(){
            return {
                loading: true,
                live_courses: [],
                questions: {},
                form: new Form({
                    query: '',
                    course: '',
                    questionsWithoutResponse: false,
                    questionsWithoutAnswer: false,
                    questionsFollowing: false,
                    orderBy: 'recent',
                    page: 1
                })
            }
        },
        
        
        methods: {
            fetchAuthorCourses(){
                this.form.post(`/api/author/courses`)
                    .then(response => {
                        this.live_courses = response.data.live
                    })
            },
            
            fetchAuthorQuestions(page=1){
                this.loading = true
                this.form.page = page
                this.form.post(`/api/questions/fetchQuestions`)
                    .then(response => {
                        this.loading = false
                        this.questions = response.data
                    })
            }
        },
        
        created(){
            this.fetchAuthorCourses()
            this.fetchAuthorQuestions()
            this.loading = false
            
        }
        
        
    }
    
    
</script>
