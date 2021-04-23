<template>
    <div class="row mb-3">
        <div class="col-md-12 has-popover">
            <a :href="`/course/${course.slug}`">
                <div class="course__list_item p-2">
                    <div class="row">
                        <div class="col-md-3">
                            <img :src="course.images.thumbnail" width="100%" />
                        </div>
                        
                        <div class="col-md-6 d-flex flex-column">
                            <div class="pop__course_title mb-1 mt-0 mb-2 font-16 text-dark">
                                {{ course.title | truncate(40) }}
                            </div>
                            <div class="pop__category_sm mb-2 pop__stats">
                                <base-course-stats class="text-dark" :course="course" />
                            </div>
                            <div class="pop__course_description font-13 mb-2">
                                <span>{{ course.subtitle | truncate(50) }}</span>
                            </div>
                            <div class="pop__course_description font-13">
                                <span class=" text-muted">{{ trans('strings.by') }} {{ course.author.full_name }}</span>
                            </div>
                        </div>
                        
                        <div class="col-md-3 text-right d-flex flex-column">
                            <template v-if="course.price_discounted">
                                <div class="list_item__price mb-1">
                                    <base-currency :price="course.price_discounted"></base-currency>
                                </div>
                                <div class="list_item__old_price">
                                    <base-currency :price="course.price"></base-currency>
                                </div>
                            </template>
                            <template v-else>
                                <div class="list_item__price mb-1">
                                    <base-currency :price="course.price"></base-currency>
                                </div>
                            </template>
                            
                            <div class="mt-auto text-right">
                                <div class="d-flex justify-content-end">
                                    <star-rating :read-only="true" :rating="course.average_review" :increment="0.5" :star-size="15" :show-rating="false" active-color="#f4c150"></star-rating>
                                </div>
                                <span class="d-block list_item_ratings">
                                    ({{ course.total_reviews }} {{ course.total_reviews | pluralize(trans('strings.rating'))}})
                                </span>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </a>
            
        </div>
        
        <!-- POPOVER CONTENT -->
        <div class="webui-popover-content">
            <div class="webui-popover-content__inner_sm d-flex flex-column p-2">
                <div class="pop__course_title mb-2 font-20">
                    {{ trans('strings.what_you_will_learn') }}
                </div>
                <div class="pop__course_what_you_learn">
                    <ul class="fa-ul ml-0 font-14">
                        <li class="mb-2" v-for="goal in course.what_to_learn" :key="goal.uuid">
                            <span class="fa-li"></span> 
                            <i class="fa fa-circle font-8"></i>
                            {{ goal.text | truncate(24) }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        
    </div>
</template>


<script>

    export default{
        name: 'CourseListItem',
        props: ['course'],
        
        mounted(){
            $('.has-popover').webuiPopover({
                trigger:'hover',
                placement:'horizontal',
                delay: {
                    show: 300,
                    hide: null
                },
                width: 300
            });
        }
        
    }
    
</script>

<style lang="scss">
    .course_list_item{
        
        a{
            color: #686F7A;
            font-size: 13px;
            line-height: 1.43;
        }
        
        .pop__course_title h1 {
            font-size: 18px;
            font-weight: 500;
            line-height: 1.43em;
            color: #29303B;
            padding: 0;
        }
        
        .pop__course_title{
            color: #29303B;
            font-size: 15px;
            letter-spacing: -0.25px;
            line-height: 18px;
            font-weight: 600;
            margin-top: 19px;
            margin-left: 9px;
        }
        
        .pop__course_what_you_learn{
            color: #686F7A;
        }
    }
</style>



