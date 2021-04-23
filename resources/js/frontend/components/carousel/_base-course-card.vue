<template>
    <div class="course_card__slick col-md-3 col-lg-3 col-sm-6 col-xs-12 mb-4">
        <div class="post-grid-item with-popover">
            <div class="post-grid-img">
                <a :href="`/course/${course.slug}`" class="popx">
                    <img :src="course.images.thumbnail" alt="post-grid Image">
                </a>
            </div>
            <div class="post-grid-content">
                <div class="post-grid-head">
                    <h3 class="post-grid-title">
                        <a :href="`/course/${course.slug}`">{{ course.title | truncate(25) }}</a>
                    </h3>
                    <ul class="post-grid-meta">
                        <li><a :href="`/user/${course.author.username}`">{{ course.author.full_name }}</a></li>
                    </ul>
                    <ul class="post-grid-meta mt-2 d-flex align-items-center">
                        <star-rating :read-only="true" 
                            border-color="transparent" 
                            :rating="course.average_review" 
                            :increment="0.5" 
                            :star-size="14" 
                            :show-rating="false" 
                            active-color="#f4c150"></star-rating> 
                            <b class="mr-1">{{ course.average_review }}</b> 
                            ({{ course.total_reviews}})
                    </ul>
                </div>
                <div class="post-grid-footer text-right">
                    <base-currency v-if="course.price_discounted" :price="course.price_discounted" customClass="price-promo__card mr-1"></base-currency>
                    <base-currency :price="course.price" customClass="price__card"></base-currency>
                </div>
            </div>
        </div>
        
        <!-- POPOVER CONTENT -->
        <div class="webui-popover-content">
            <webui-popover-card :course="course" />
        </div>

    </div>
</template>

<script>

    import WebuiPopoverCard from './imports/WebuiPopoverCard'

    export default{
        
        name: 'CourseCard',
        
        components: {
            WebuiPopoverCard
        },

        props: {
            course: { type: [Object] }
        },
        
        mounted(){
            $('.with-popover').webuiPopover({
                trigger:'hover',
                placement:'horizontal',
                delay: {
                    show: 300,
                    hide: null
                },
                width: 345
            });
        }
        
    }
</script>
