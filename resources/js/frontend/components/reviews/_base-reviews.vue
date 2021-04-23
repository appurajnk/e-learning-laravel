<template>
    <div class="row mt-4">
        <div class="col-md-12 mb-4">
            <div class="d-flex justify-content-between border border-left-0 border-right-0 border-top-0 py-2 align-items-center">
                <base-heading :text="trans('strings.reviews')"></base-heading>
            </div>
        </div>
        
        <div class="col-md-12" v-if="reviews && reviews.data && reviews.data.length > 0">
            
            <review v-for="review in reviews.data" :review="review" :key="review.id"></review>
            
            <div class="comments__pagination mt-4">
                <pagination 
                    class="pagination-sm justify-content-endx text-info"
                    :data="reviews"
                    align="right"
                    @pagination-change-page="fetchCourseReviews" 
                    :show-disabled="true">
                    <span slot="prev-nav">
                        <i class="fas fa-angle-left"></i>
                    </span>
	                <span slot="next-nav">
	                    <i class="fas fa-angle-right"></i>
	                </span>
                </pagination>
            </div>
            
        </div>
        <div class="col-md-12 text-center" v-else>
            {{ trans('strings.no_reviews') }}
        </div>
    </div>
</template>

<script>
    import ReviewForm from './imports/ReviewForm'
    import Review from './imports/Review'
    import Form from 'vform'
    
    export default {
        components: {
          Review,
          ReviewForm
        },
        
        props: ['course'],
        
        data(){
            
            return {
                reviews: {},
                form: new Form({
                    query: '',
                    rating: ''
                })
                
            }
        },
        
        
        methods: {
            fetchCourseReviews(page=1){
                this.form.page = page
                this.form.post(`/api/course/${this.course.id}/fetchReviews`)
                    .then(response => {
                        this.reviews = response.data
                    })
            }
            
        },
        
        mounted() {
          if(this.course.id){
            this.fetchCourseReviews()
          }
          this.$bus.$on('reviews:fetch', (rating) => {
              this.form.rating = rating
              this.fetchCourseReviews()
          })
        }
        
    }
    
</script>







