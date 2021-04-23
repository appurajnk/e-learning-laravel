<template>
    <div>
        <ul class="nav nav-tabs">
            <li v-for="category in categories" :key="category.uuid" class="nav-item mr-2" 
                :class="{ 'active' : category.uuid == form.category }">
                <a class="nav-link" :class="{ 'active' : category.id == form.category }" href="javascript:void(0)"
                    @click="fetchCategoryCourses(category.id)">
                    {{ category.name }}
                </a>
            </li>
        </ul>
        <div class="tab-content tc-post-grid-style1 sec-spacer">
            <div class="tab-panex">
                <vue-element-loading :active="form.busy" :is-full-screen="false" spinner="bar-fade-scale" background-color="rgba(255,255,255,.9)"/>
                <base-slick-carousel :courses="courses" :num_slides="4"></base-slick-carousel>
            </div>
        </div>	 
    </div>
</template>

<script>
import Form from 'vform'
export default {
    props:{
        categories: { type: Array }
    },

    data(){
        return {
            courses: [],
            form: new Form({
                category: ''
            }),
        }
    },

    methods:{
        async fetchCategoryCourses(id){
            this.form.category = await id
            this.form.busy = await true
            const { data } = await axios.get(`/api/home/getCategoryCourses?category=${id}`)
            this.courses = await data.data
            this.form.busy = await false
        }
    },

    created(){
        if(this.categories.length > 0){
            this.form.category = this.categories[0].id
        }
    },

    async beforeMount(){
        if(this.form.category){
            this.fetchCategoryCourses(this.form.category)
        }
    }

}
</script>