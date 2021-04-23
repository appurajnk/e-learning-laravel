<template>
    <div class="webui-popover-content__inner d-flex flex-column p-2">
        <div class="pop__updated_at mb-2">
            {{ trans('strings.last_updated') }}: {{ $moment(course.updated_at).format('M/YYYY') }}
        </div>
        <div class="pop__course_title fw-600 mb-1">
            <a href="#" class="font-18">
                {{ course.title | truncate(20) }}
            </a>
        </div>
        
        <div class="pop__category_sm mb-2">
            <!-- <span class="bestseller-badge badge-accented yellow">bestseller</span> -->
            <span class="context_info">
                <a :href="course.category.link">
                    {{ course.category.name }}
                </a> | {{ course.category.parent_name }}
            </span>
        </div>
        
        <div class="pop__stats font-12 d-flex mb-3">
            <base-course-stats class="text-dark" :course="course" />
        </div>
        
        <div class="pop__course_description mb-4 font-13">
            <p>
                {{ course.short_description }}
            </p>
            <ul class="fa-ul">
                <li v-for="w in limitBy(course.what_to_learn, 4)" :key="w.uuid">
                    <span class="fa-li text-light">
                        <i class="fas fa-circle font-13"></i>
                    </span> {{ w.text }}
                </li>
            </ul>
        </div>
    
        <div class="d-flex mt-auto">
            <div class="w-100x">
                <template v-if="course.price > 0">
                    <base-add-to-cart
                        :course="course" 
                        css_class="btn btn-danger px-2 btn-lg rounded-0" />
                </template>
                <template v-else>
                    <base-enroll-now-button :courses="course" source="course" />
                </template>
            </div>
            <!-- <div class="flex-shrink-1 ml-4 align-self-center text-center">
                <a href="#" class="text-danger">
                    <i class="fa fa-heart-o fa-2x"></i>
                </a>
            </div> -->
        </div>
    </div>
</template>

<script>
import Vue2Filters from 'vue2-filters'
export default {
    mixins: [Vue2Filters.mixin],
    props:{
        course: { type: Object }
    }
}
</script>