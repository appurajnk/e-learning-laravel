<template>
    <div class="course_card__slick">
        <div class="post-grid-item with-popover">
            <div class="post-grid-img">
                <a :href="`/course/${course.slug}`">
                    <img :src="course.images.thumbnail" alt="post-grid Image">
                </a>
            </div>
            <div class="post-grid-content">
                <div class="post-grid-head">
                    <h3 class="post-grid-title font-weight-normal">
                        <a :href="`/course/${course.slug}`">{{ course.title | truncate(15) }}</a>
                    </h3>
                    <ul class="post-grid-meta">
                        <li>{{ trans('strings.by') }} 
                        <a :href="`/user/${course.author.username}`">{{ course.author.full_name | truncate(20) }}</a></li>
                    </ul>
                    <ul class="post-grid-meta mt-2 d-flex">
                        <star-rating :read-only="true" :rating="course.average_review" :increment="0.5" 
                            :star-size="15" 
                            :show-rating="false" 
                            active-color="#f4c150"></star-rating>
                            <span class="list_item_ratings ml-2">
                                <b>{{ course.average_review }}</b> ({{ course.total_reviews }})
                            </span>
                    </ul>
                </div>
                <div class="post-grid-footer text-right">
                    <template v-if="course.price_discounted">
                        <base-currency v-if="course.price_discounted" :price="course.price" customClass="price-promo__card mr-1"></base-currency>
                        <base-currency :price="course.price_discounted" customClass="price__card"></base-currency>
                    </template>
                    <template v-else>
                        <base-currency :price="course.price" customClass="price__card"></base-currency>
                    </template>
                    
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

    import WebuiPopoverCard from './WebuiPopoverCard'

    export default{
        name: 'CourseCardSlick',
        components: {
            WebuiPopoverCard
        },

        props: {
            title: { type: String, default: null },
            course: { type: [Array, Object] }
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

<style>
    .course_card__slick{
        max-width: 100%;
        padding-right: 7px;
        padding-left: 7px;
    }

    .webui-popover-content__inner{
        min-height: 400px;
        height: auto;
    }
    .webui-popover{
        border-radius: 0 !important;
    }
    .pop__updated_at{
        font-size: 11px;
        color: darkgrey;
    }
    .pop__course_title a{
        color: grey;
    }
    .pop__course_description p{
        line-height: 1.6em;
    }
    .pop__category_sm{
        font-size: 11px;
    }
    .pop__category_sm .context_info{
        color:#686f7a;
        font-size:11px;
        overflow:auto;
    }
    .bestseller-badge{
        background: #f4c150;
        color: #29303b;
        font-size: 9px;
        padding: 1px 5px;
        display: inline-block;
        font-weight: 600;
        line-height: 1.4;
        text-transform: uppercase;
        position: relative;
        margin-right: 8px;
    }
    .bestseller-badge:after{
        right: -6px;
        background: inherit;
        content: "";
        height: 10px;
        position: absolute;
        top: 2px;
        transform: rotate(45deg);
        width: 10px;
        z-index: 1;
        display: block;
    }
    
</style>