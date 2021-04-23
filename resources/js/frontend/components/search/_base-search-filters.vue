<template>
    <form class="custom-form form-style" @submit.prevent="fetchCourses" @keydown="form.onKeydown($event)">

        <!-- Search Filter -->
        <div class="filter-search p-0">
            <div class="row">
                <div class="col-lg-9 col-sm-12 p-l-r">
                    <div class="row">
                        <template v-if="!showAdvanced">
                            <div class="col-lg-2 col-sm-12 mb-1 p-l-r">
                                <button class="btn btn-sm border-secondary btn-block bg-white font-16 fw-400" 
                                    @click.prevent="showAdvanced=true">
                                    <i class="sl sl-icon-equalizer"></i>
                                    {{ trans('strings.filters') }}  
                                </button>
                            </div>
                        
                            <div class="col-lg-2 col-sm-12 mb-1 p-l-r">
                                <select class="form-control border-secondary font-14 fw-300" v-model="form.rating" @change="fetchCourses()">
                                    <option v-for="rating in ratings" :value="rating.value" :key="rating.label">
                                        {{ rating.label }}
                                    </option>
                                </select>
                            </div>
                        </template>
                        <template v-else>
                            <div class="col-lg-3  col-sm-12 mb-1 p-l-r">
                                <div class="btn-group ml-0" role="group">
                                    <base-button :loading="form.busy" class="btn btn-info mr-2 rounded-0">
                                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                        {{ trans('strings.apply') }}
                                    </base-button>
                                    
                                    <button type="button" class="btn btn-outline-info rounded-0" @click="showAdvanced=false">
                                        {{ trans('strings.close') }}
                                    </button>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
                <div class="col-lg-3  col-sm-12 mb-1 d-flex align-items-center justify-content-end">
                    <select class="form-control border-secondary w-75 font-14 fw-300" 
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
        <!-- End Search Filter -->
        
        <!------------ ADVANCED SEARCH ------------------>
        <div class="py-3 advance-search-block mt-0" id="advanceSearch" v-if="showAdvanced">
            <div class="row">
                <!-- Rating -->
                <div class="col-lg-2 col-md-6 mb">
                    <div class="filter-title mb-3 font-14 fw-500">
                        {{ trans('strings.minimum_rating') }}   
                    </div>
                    <ul class="filter-list m-0 p-0">
                        <li v-for="(rating,index) in ratings" :key="rating.label">
                            <div class="custom-control custom-radio mr-sm-2 font-14 fw-300">
                                <input type="radio" v-model="form.rating" :value="rating.value" class="custom-control-input" :id="`rating-${index}`">
                                <label class="custom-control-label" :for="`rating-${index}`">{{ rating.label }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Subcategory -->
                <template v-if="subcategories.length">
                    <div class="col-lg-4 col-md-6 mb">
                        <div class="filter-title mb-3 font-14 fw-500">{{ trans('strings.subcategory') }}</div>
                        <ul class="filter-list m-0 p-0">
                            <li v-for="category in subcategories" :key="category.slug">
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" :value="category.id" v-model="form.subcategories" class="custom-control-input" :id="`category-${category.id}`">
                                    <label class="custom-control-label" :for="`category-${category.id}`">{{ category.name | truncate(25) }}</label>
                                </div>
                            </li>
                        </ul>
                    </div>
                </template>
                
                <!-- Levels -->
                <div class="col-lg-2 col-md-6 mb">
                    <div class="filter-title mb-3 font-14 fw-500">{{ trans('strings.levels') }}</div>
                    <ul class="filter-list m-0 p-0">
                        <li v-for="(level,index) in levels" :key="level">
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                    <input type="checkbox" v-model="form.levels" :value="level" class="custom-control-input" :id="`level-${index}`">
                                <label class="custom-control-label" :for="`level-${index}`">{{ trans(`strings.${level}`) }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Language -->
                <div class="col-lg-2 col-md-6 mb">
                    <div class="filter-title mb-3 font-14 fw-500">{{ trans('strings.language') }}</div>
                    <ul class="filter-list m-0 p-0">
                        <li v-for="(language,index) in languages" :key="language">
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                <input type="checkbox" v-model="form.languages" :value="language" class="custom-control-input" :id="`language-${index}`">
                                <label class="custom-control-label text-capitalize" :for="`language-${index}`">{{ language }}</label>
                            </div>
                        </li>
                    </ul>
                </div>
                
                <!-- Price -->
                <div class="col-lg-2 col-md-6 mb">
                    <div class="filter-title  mb-3 font-14 fw-500">
                        {{ trans('strings.price') }}
                    </div>
                    <ul class="filter-list m-0 p-0">
                        <li>
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                <input type="checkbox" value="free" v-model="priceFree" class="custom-control-input" id="priceFree">
                                <label class="custom-control-label my-auto" for="priceFree">
                                    {{ trans('strings.free') }}
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300">
                                <input type="checkbox" value="paid" v-model="pricePaid" class="custom-control-input" id="pricePaid">
                                <label class="custom-control-label" for="pricePaid">
                                    {{ trans('strings.paid') }}
                                </label>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-----------/ END ADVANCED SEARCH --------------->
            
    </form>
</template>

<script>
    import axios from 'axios'
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    export default {
        
        props: ['is_subcategory', 'category_id'],
        
        data(){
            return {
                showAdvanced: false,
                priceFree: false,
                pricePaid: false,
                subcategories: [],
                languages: [],
                levels: [],
                ratings: [
                    {label: this.trans('strings.all_ratings'), value: ''},
                    {label: '4.5 & up', value: 4.5},
                    {label: '4.0 & up', value: 4.0},
                    {label: '3.5 & up', value: 3.5},
                    {label: '3.0 & up', value: 3.0}
                ],
                
                form: new Form({
                    category: '',
                    subcategories: [],
                    subcategory_slug: '',
                    levels: [],
                    languages: [],
                    price: '',
                    rating: '',
                    orderBy: 'newest'
                })    
            }
        },
        
        computed: {
            ...mapGetters({
                page: 'search/page'
            }),
            finalPrice() {
                if(this.priceFree == true && this.pricePaid==true) return 'all';
                if(this.priceFree== true) return 'free';
                if (this.pricePaid==true) return 'paid';
                return 'all';
            }  
        },
        
        methods: {
            async fetchCourses(){
                this.form.page = this.page
                this.form.category=this.category_id
                this.form.price = this.finalPrice
                await this.$store.commit('search/SET_LOADING', true)
                await this.$store.dispatch('search/fetchCourses', this.form)
            },
            
            fetchFilterParameters(){
                axios.get(`/api/search/filters/${this.category_id}`)
                    .then(response => {
                        this.subcategories = response.data.subcategories
                        this.languages = response.data.languages
                        this.levels = response.data.levels
                    }).then(() => {
                        this.form.is_subcategory = this.is_subcategory
                        this.form.category = this.category_id
                        this.$store.dispatch('search/fetchCourses', this.form)
                    })
            },
        },
        
        created(){
            this.fetchFilterParameters()
        },

        mounted(){
            this.$bus.$on('fetch:course', async(page) => {
                await this.$store.commit('search/SET_PAGE', page)
                await this.fetchCourses()
            })
        }
    }
</script>