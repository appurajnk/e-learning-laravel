<template>
    <ul role="menu" class="dropdown-menu">
        <li class="h100p">
            <ul class="dropdown-menu__list dropdown-menu__list--level-one">
                <category-level-one v-for="(category,key) in categories" :key="key" :link="category" />
            </ul>
        </li>
    </ul>
</template>

<script>
    import CategoryLevelOne from './imports/_nav_category_level_one'
    export default {
        data(){
            return {
                isHovering: false
            }
        },
        
        components:{
            CategoryLevelOne
        },

        props:{
            categories: Array
        }
        
    }
    
</script>