<template>
    <section class="course__list py-4">
        <div class="container">
            <form @submit.prevent="fetchAuthorCourses">
                <div class="row py-3">
                    <div class="col-md-3 col-lg-3">
                        <div class="d-flex align-items-center">
                            <div class="mr-2">
                                {{ trans('strings.sort_by') }}:
                            </div>
                            <div class="flex-grow-1">
                                <select class="form-control font-14 fw-300 border border-secondary rounded-0"
                                    v-model="form.orderBy"
                                    @change="fetchAuthorCourses()">
                                    <option value="created_at_a-z">{{ trans('strings.date_created_asc') }}</option> 
                                    <option value="created_at_z-a">{{ trans('strings.date_created_desc') }}</option> 
                                    <option value="title_a-z">{{ trans('strings.title_asc') }}</option>
                                    <option value="title_z-a">{{ trans('strings.title_desc') }}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-5 col-lg-6 text-rightx">
                        <a href="/home/course/create" class="btn btn-danger  rounded-0 btn-md border">
                            {{ trans('strings.create_new_course') }}
                        </a>
                    </div>

                    <div class="col-md-4 col-lg-3">
                        <div class="input-group mb-3">
                            <input type="text" v-model="form.query" :placeholder="trans('strings.search')"
                                class="form-control border border-secondary  rounded-0">
                            <div class="input-group-append">
                                <base-button :loading="form.busy" class="btn  rounded-0 text-white btn-info">
                                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                    <i class="fa fa-search"></i>
                                </base-button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            <inc-course-unpublished v-for="course in draft_courses" :course="course" :key="course.uuid"></inc-course-unpublished>
                
            <inc-course-published v-for="course in live_courses" :course="course" :key="course.uuid"></inc-course-published>
        </div>
    </section>
</template>

<script>
    import IncCoursePublished from './imports/_course_published'
    import IncCourseUnpublished from './imports/_course_unpublished'
    import Form from 'vform'
    export default {
        components: {
            IncCoursePublished,
            IncCourseUnpublished
        },
        
        data(){
            return {
                live_courses: [],
                draft_courses: [],
                
                form: new Form({
                    query: '',
                    orderBy: 'created_at_a-z'
                })
            }
        },
        
        
        methods: {
            fetchAuthorCourses(){
                this.form.post(`/api/author/courses`)
                    .then(response => {
                        this.live_courses = response.data.live
                        this.draft_courses = response.data.draft
                    })
            }
            
        },
        
        created(){
            this.fetchAuthorCourses()
        }
    }
</script>

