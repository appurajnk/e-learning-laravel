<template>
    <div class="col-md-3 mb-3">
        <a :href="`/courses/${category.parent.slug}/${category.slug}`" class="d-block text-dark">
            <div class="card card-body d-flex flex-row align-items-center">
    			<!-- <div class="mr-2 category__icon font-22">
    				<span :class="icon"></span>
    			</div> -->
    			<div class="font-16 font-weight-light">
    				{{ category.name }}
    			</div>
  		    </div>
        </a>
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default{
        
        name: 'CategoryCard',
        
        props: {
            icon: { type: String, default: null },
            category: { type: Object },
        }
    }
</script>