<template>
    <div>
        <!-- Filters -->
        <form class="custom-form form-style" @submit.prevent="fetchCourses">
            <section class="bg-light mt-0 py-4">
                <div class="container">
                    <div class="filter-search p-0">
                        <div class="row">
                            <div class="col-md-9 p-l-r">
                                <div class="row">
                                    <div class="col-lg-2 p-l-r">
                                        <select class="form-control border border-secondary font-14 fw-300" v-model="form.rating" @change="fetchCourses()">
                                            <option v-for="rating in ratings" :value="rating.value" :key="rating.label">
                                                {{ rating.label }}
                                            </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-2 p-l-r">
                                        <select class="form-control border border-secondary font-14 fw-300" 
                                            v-model="form.orderBy"
                                            @change="fetchCourses()">
                                            <option value="newest">{{ trans('strings.newest_first') }}</option>
                                            <option value="price_a-z">{{ trans('strings.price_lowest') }}</option>
                                            <option value="price_z-a">{{ trans('strings.price_highest') }}</option>
                                            <option value="rating">{{ trans('strings.highest_rated') }}</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <!-- Search Results -->
        <section class="course__list py-4">
            <div class="container">
                <div class="row">
                    <div class="col-md-9">
                        <base-search-results></base-search-results>
                    </div>

                    <!-- Right side -->
                    <div class="col-md-3">
                        <div class="card card-body rounded-0 mb-4">
                            <h3 class="mb-2 font-18">
                                <i class="fa fa-shield"></i>
                                {{ trans('strings.not_sure') }}
                            </h3>
                            <p class="text-muted font-13">
                                {{ trans('strings.courses_have_guarantee') }}
                            </p>
                        </div>
                        
                        <div class="card card-body rounded-0 mb-4">
                            <h3 class="mb-2 font-18">
                                <i class="fa fa-users"></i>
                                {{ trans('strings.join_happy_students') }}
                            </h3>
                            <p class="text-muted font-13">
                                {{ trans('strings.join_happy_students_desc') }}
                            </p>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </div>
</template>
<script>
import { mapGetters } from 'vuex'
import Form from 'vform'
export default {
    props:['query'],
    data(){
        return {
            ratings: [
                {label: this.trans('strings.all_ratings'), value: ''},
                {label: '4.5 & up', value: 4.5},
                {label: '4.0 & up', value: 4.0},
                {label: '3.5 & up', value: 3.5},
                {label: '3.0 & up', value: 3.0}
            ],
            form: new Form({
                q: '',
                rating: '',
                orderBy: 'newest'
            })
        }
    },

    computed: {
        ...mapGetters({
            page: 'search/page'
        }),
    },

    methods:{
        async fetchCourses(){
            this.form.page = this.page
            this.form.q = await this.query
            await this.$store.commit('search/SET_LOADING', true)
            this.$store.dispatch('search/fetchCourses', this.form)
            this.$store.commit('search/SET_LOADING', false)
        },
    },

    beforeMount(){
        this.fetchCourses()
    },

    mounted(){
        this.$bus.$on('fetch:course', async(page) => {
            await this.$store.commit('search/SET_PAGE', page)
            await this.fetchCourses()
        })
    }
}
</script>