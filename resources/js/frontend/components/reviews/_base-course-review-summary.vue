<template>
    <div class="row mt-4">
        <div class="col-md-12">
            <base-heading :text="trans('strings.student_feedback')"></base-heading>
        </div>    
        <div class="col-md-3">
            <div class="text-center">
                <h1 class="h1 display-4 m-0 fw-500">{{ course_avg }}</h1> 
                <star-rating 
                    :rating="course_avg"
                    :increment="0.5"
                    :read-only="true" 
                    :show-rating="false"
                    :inline="true"
                    class="mb-2"
                    :star-size="20"/> <br>
                {{ trans('strings.average_rating') }}
            </div>
            
        </div>
        <div class="col-sm-9">
            <div class="rating-desc">
                <a href="#" class="row mb-2" v-for="review in stats" :key="review.rating"
                    @click.prevent="fetchReviews(review.rating)">
                    <div class="col-xs-6 col-md-6">
                        <div class="progress" :class="{'opacity-10' : filter && filter !== review.rating}">
                            <div class="progress-bar bg-secondary" role="progressbar" :style="`width: ${review.width}%;`" :aria-valuenow="review.width" aria-valuemin="0" aria-valuemax="100"></div>
                        </div>
                    </div>
                    
                    <div class="col-sx-6 col-md-6">
                        <star-rating 
                            :rating="parseFloat(review.rating)" 
                            :read-only="true" 
                            :show-rating="false"
                            :inline="true"
                            :star-size="20"/>
                        <span class="font-14">{{ review.width.toFixed(0) }}%</span>
                        
                        <span class="font-14" v-if="review.rating==filter">
                            <i class="fa fa-times"></i>
                        </span>
                    </div>
                </a>
            </div>
            <!-- end row -->
            
            
        </div>
    </div>
</template>


<script>
    
    import Form from 'vform'
    import axios from 'axios'
    export default {
        name: 'CourseReviewSummary',
        
        props: ['course'],
        
        data(){
            return {
                stats: [],
                course_avg: 0,
                filter: ''
            }
        },
        
        
        methods: {
            fetchSummary(){
                axios.get(`/api/course/${this.course.id}/reviews/fetchSummary`)
                    .then(response => {
                        this.stats = response.data.summary
                        this.course_avg = response.data.course_avg
                    })
            },
            
            fetchReviews(rating){
                if(this.filter==rating){
                    this.filter = '' 
                } else {
                    this.filter = rating
                }
                this.$bus.$emit('reviews:fetch', this.filter) 
                
            }
            
        },
        
        mounted() {
            if(this.course.id){
                this.fetchSummary()
            }
        }
        
    }
    
</script>

<style>
    .opacity-10{
        opacity: 0.15 !important;
    }
</style>