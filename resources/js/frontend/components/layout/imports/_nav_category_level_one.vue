<template>
    <li class="menu__link"
        @mouseover="isHovering=true" 
        @mouseout="isHovering=false"
        :class="{'maintain-hover' : isHovering }" >
        <a :href="`/courses/${link.slug}`">
            <span :class="`menu__icon gicon fa fa-angle-right`"></span>
            <span class="fx">{{ link.name }}</span>
            <i class="menu__arrow gicon fa fa-angle-right"></i>
        </a>
        <div class="dropdown-menu dropdown-menu--sub dropdown-menu--level-two">
            <div class="fxdc h100p">
                <ul class="dropdown-menu__list dropdown-menu__list--level-two">
                    <li class="menu__link" role="presentation">
                        <a :href="`/courses/${link.slug}`">
                            <span class="fx fw-600">
                                {{ trans('strings.all_in_category', {category: link.name }) }}
                            </span>
                        </a>
                    </li>
                    <li class="menu__link" role="presentation" v-for="child in link.children" :key="child.uuid">
                        <a :href="`/courses/${link.slug}/${child.slug}`">
                            <span class="fx">{{ child.name }}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </li>
</template>

<script>
    
    export default {
        data(){
            return {
                isHovering: false
            }
        },
        
        props:{
            link: Object
        }
    }
    
</script>