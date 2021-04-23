<template>
    <div class="container">
        <div class="row">
            <div class="col-md-3">
                <form @submit.prevent="fetchAuthorReviews">
                    <div class="dashboard__searchform border border-secondary p-2 rounded">
                        <select class="form-control font-14 fw-300 border border-secondary"
                            v-model="form.course"
                            @change="fetchAuthorReviews()">
                            <option value>{{ trans('strings.all_courses') }}</option>
                            <option v-for="course in live_courses" :value="course.id" :key="course.id">
                                {{ course.title | truncate(20) }}
                            </option> 
                        </select>
                        
                        <ul class="filer-list mt-4">
                            <li>
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="true" v-model="form.noResponse" 
                                        class="custom-control-input" id="no_response" @change="fetchAuthorReviews()">
                                    <label class="custom-control-label" for="no_response">
                                        {{ trans('strings.has_no_response') }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                        <hr />
                        
                        <ul class="filer-list mt-4">
                            <li>
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="1" v-model="form.rating" 
                                        class="custom-control-input" id="star-1" @change="fetchAuthorReviews()" >
                                    <label class="custom-control-label" for="star-1">
                                        {{ trans('strings.1_star') }}
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="2" v-model="form.rating" 
                                        class="custom-control-input" id="star-2" @change="fetchAuthorReviews()" >
                                    <label class="custom-control-label" for="star-2">
                                        {{ trans('strings.stars', {number: 2}) }}
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="3" v-model="form.rating" 
                                        class="custom-control-input" id="star-3" @change="fetchAuthorReviews()" >
                                    <label class="custom-control-label" for="star-3">
                                        {{ trans('strings.stars', {number: 3}) }}
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="4" v-model="form.rating" 
                                        class="custom-control-input" id="star-4" @change="fetchAuthorReviews()" >
                                    <label class="custom-control-label" for="star-4">
                                        {{ trans('strings.stars', {number: 4}) }}
                                    </label>
                                </div>
                                
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" value="5" v-model="form.rating" 
                                        class="custom-control-input" id="star-5" @change="fetchAuthorReviews()" >
                                    <label class="custom-control-label" for="star-5">
                                        {{ trans('strings.stars', { number: 5 }) }}
                                    </label>
                                </div>
                            </li>
                        </ul>
                        
                        <hr />
                        
                        <div>
                            {{ trans('strings.sort_by') }}
                            <select class="form-control font-14 fw-300 border border-secondary"
                                v-model="form.orderBy"
                                @change="fetchAuthorReviews()">
                                <option value="desc">
                                    {{ trans('strings.newest_first') }}
                                </option> 
                                <option value="asc">
                                    {{ trans('strings.oldest_first') }}
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
                <div v-if="reviews && reviews.data && reviews.data.length > 0">
                    <transition-group name="slidedown">
                        <inc-author-review 
                            v-for="review in reviews.data" 
                            :review="review" 
                            model="\App\Models\Review"
                            :key="review.id"></inc-author-review>
                    </transition-group>
                    <div class="d-block">
                        <pagination 
                            class="pagination-sm justify-content-endx text-info"
                            :data="reviews" 
                            @pagination-change-page="fetchAuthorReviews" 
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
                    <p>{{ trans('strings.no_reviews') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Form from 'vform'
    import IncAuthorReview from './imports/_author_review'
    export default {
        components: {
            IncAuthorReview
        },
        
        data(){
            return {
                loading: true,
                live_courses: [],
                draft_courses: [],
                reviews: {},
                form: new Form({
                    query: '',
                    orderBy: 'created_at_a-z',
                    course: '',
                    hasComment: '',
                    noResponse: '',
                    rating: [],
                    orderBy: 'desc',
                    page: 1
                }),
                current_page: 1
                
            }
        },
        
        
        methods: {
            fetchAuthorCourses(){
                this.form.post(`/api/author/courses`)
                    .then(response => {
                        this.live_courses = response.data.live
                        this.draft_courses = response.data.draft
                    })
            },
            
            fetchAuthorReviews(page = 1){
                this.loading = true
                this.form.page = page
                this.form.post(`/api/author/reviews`)
                    .then(response => {
                        this.reviews = response.data
                        this.current_page = response.data.current_page
                        this.loading = false
                    })
            }
            
        },
        
        created(){
            this.fetchAuthorCourses()
            this.fetchAuthorReviews()
            this.loading = false
            
            this.$bus.$on('response:created', () => {
                this.fetchAuthorReviews()
            })
        }
        
        
    }
    
    
</script>
