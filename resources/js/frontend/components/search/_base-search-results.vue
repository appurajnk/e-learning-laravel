<template>
    <div>
        <vue-element-loading :active="loading" :is-full-screen="false" spinner="bar-fade-scale" background-color="rgba(255,255,255,.9)"/>
        
        <template>
            <div v-if="courses && courses.data && courses.data.length > 0">
                <list-item v-for="course in courses.data" :course="course" :key="course.uuid" />

                <pagination 
                    class="pagination-sm justify-content-endx text-info"
                    :data="courses"
                    align="right"
                    :limit="-1"
                    size="large"
                    @pagination-change-page="fetchCourses" 
                    :show-disabled="false">
                    <span slot="prev-nav">
                        <i class="fas fa-angle-left"></i>
                        {{ trans('strings.previous') }}
                    </span>
	                <span slot="next-nav">
                        {{ trans('strings.next') }}
                        <i class="fas fa-angle-right"></i>
	                </span>
                </pagination>
            </div>
            <div v-if="courses && courses.data && courses.data.length == 0">
                <p>{{ trans('strings.no_search_results') }}</p>
            </div>
        </template>
        
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import ListItem from './imports/_search_course_list_item'
    
    export default {
        components: {
            ListItem
        },
        computed: {
            ...mapGetters({
                loading: 'search/loading',
                courses: 'search/courses',
                page: 'search/page'
            })
        },

        methods:{
            fetchCourses(page){
                this.$bus.$emit('fetch:course', page)
            }
        }
    }
    
</script>