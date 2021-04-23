<template>
    <div>
        <form @submit.prevent="fetchCourses()">
            <section class="all-designersx">
                <div class="container">
                    <div class="py-2">
                        <div class="row align-items-center">
                            <div class="col-lg-2 p-l-r mb">
                                <div class="form-group mb-0">
                                    <label class="text-uppercase font-12 fw-500">
                                    {{ trans('strings.sort_by') }}
                                    </label>
                                    <select class="form-control font-14 fw-300 rounded-0 border border-secondary" 
                                        @change="fetchCourses" v-model="form.orderBy">
                                        <option value="recently_enrolled">{{ trans('strings.recently_enrolled') }}</option>
                                        <option value="earliest_enrolled">{{ trans('strings.earliest_enrolled') }}</option>
                                        <option value="title_asc">{{ trans('strings.title_asc') }}</option>
                                        <option value="title_desc">{{ trans('strings.title_desc') }}</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-2 p-l-r mb">
                                <div class="form-group mb-0">
                                    <label class="text-uppercase font-12 fw-500">
                                        {{ trans('strings.filter_by') }}
                                    </label>
                                    <select class="form-control font-14 fw-300 rounded-0 border border-secondary" 
                                        @change="fetchCourses" v-model="form.category">
                                        <option value="">{{ trans('strings.all_categories') }}</option>
                                        <option v-for="category in categories" :value="category.id" :key="category.id">
                                            {{ category.name }}
                                        </option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-lg-3 p-l-r mb">
                                <div class="form-group mb-0">
                                    <label class="text-uppercase font-12 fw-500"></label>
                                    <div class="input-group">
                                        <input type="text" :placeholder="trans('strings.search_my_courses')"
                                            class="form-control white-bg-color rounded-0 border border-secondary font-14 fw-300"
                                            v-model="form.query">
                                        <div class="input-group-append">
                                            <base-button :loading="form.busy" class="btn rounded-0 btn-sm text-white btn-info">
                                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                                <i class="fa fa-search"></i>
                                            </base-button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-2" v-if="form.busy">
                                <label class="text-uppercase font-12 fw-500"></label>
                                <i class="fa fa-spinner fa-spin text-primary"></i>
                            </div>

                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!--/ END FILTERS -->
        <section class="cards-block">
            <div class="container">
                <template v-if="courses.data && courses.data.length">
                    <transition-group name="slidedown" tag="div" class="row">
                        <user-course-card v-for="course in courses.data" :course="course" :key="course.id"></user-course-card>
                    </transition-group>
                </template>
                <template v-else>
                    <div class="row">
                        <div class="col-md-12">
                            {{ trans('strings.no_courses_yet') }}
                        </div>
                    </div>
                </template>
                <div class="row">
                    <div class="col-md-12">
                        <pagination 
                            class="pagination-sm justify-content-center text-info"
                            :data="courses" 
                            @pagination-change-page="fetchCourses" 
                            :show-disabled="true">
                            <span slot="prev-nav">
                                <i class="fa fa-angle-double-left"></i>
                            </span>
                            <span slot="next-nav">
                                <i class="fa fa-angle-double-right"></i>
                            </span>
                        </pagination>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import UserCourseCard from './imports/_user_course_card'
export default {
    name: 'PageUserDashboardCourses',
    components:{
        UserCourseCard    
    },
    data() {
        return {
            categories: [],
            courses: {},
            form: new Form({
                pageNumber: 1,   
                query: '',
                category: '',
                orderBy: 'recently_enrolled',
            }),
            
        }    
    },
    methods: {
        fetchCategories(){
            axios.get('/api/user/categories/all')
                .then(response => {
                    this.categories = response.data
                })
        },
        
        fetchCourses(page=1){
            this.loading = true
            this.form.pageNumber = page
            this.form.post(`/api/user/courses/learning`)
                .then( response => {
                    //console.log(response.data)
                    this.courses = response.data
                    this.loading = false
                }).finally( error => {
                    this.loading = false
                })
        }
        
    },
    
    created(){
        this.fetchCategories()
        this.fetchCourses()
    }
}
</script>

