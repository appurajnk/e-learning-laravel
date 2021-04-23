<template>
    <div class="d-flex border border-top-0 border-left-0 border-right-0 pb-3 mb-3">
        <div class="mr-3">
            <img :src="review.user.picture" width="40" class="rounded-circle" />
        </div>
        <div class="mr-4 d-flex flex-column">
            <p><span class="fw-600">{{ review.user.full_name }}</span></p>
            <p class="font-13 text-muted">
                {{ review.timeago }}
            </p>
        </div>
        <div class="flex-grow-1">
            <div>
                <star-rating 
                    :rating="parseFloat(review.rating)"
                    :increment="0.5"
                    :read-only="true" 
                    :show-rating="false"
                    :inline="true"
                    class="mb-2"
                    :star-size="20"></star-rating>
            </div>
            <div class="fw-600 font-14 mb-2">
                {{ review.title }}
            </div>
            <div class="font-13">
                {{ review.body }}
            </div>
            
            
            <div class="review__instructor_response mt-3 p-2 font-13" v-if="review.comments">
                <div class="review__instructor_response_arrow"></div>
                <h4 class="mb-2">
                    <span class="fw-600">{{ review.comments.user.full_name}} ({{ trans('strings.instructor') }})</span> 
                    <span class="font-13 text-muted">
                        {{ review.comments.timeago }}
                    </span>
                </h4>
                {{ review.comments.body}}
            </div>
           
        </div>
    </div>
</template>
<script>
    
    export default {
        name: 'Review',
        props: ['review']
    }
    
</script>