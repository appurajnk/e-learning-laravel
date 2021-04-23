<template>
    <div class="nav__wishlist_dropdown dropdown__user visible-lg-block">
        <div class="gabs__dropdown dropdown--on-hover dropdown_icon">
            <a href="javascript:void(0)" class="gabs__dropdown-toggle gabs__hover_grey" role="button">
                <div class="fx pos-r text-center">
                    <img :src="user.picture"
                        class="user-avatar"/>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <li class="menu__link">
                    <a :href="`/user/${user.username}`">
                        <img :src="user.picture" class="user-avatar"/>
                        <span class="fx ml-3">
                            <span class="text-midnight ellipsis">{{ user.full_name }}</span>
                            <span class="a11 text-midnight-lighter ellipsis">{{ user.email }}</span>
                        </span>
                    </a>
                </li>
                <li role="presentation" class="menu__link">
                    <a href="/home/messages" role="menuitem">
                        <span>{{ trans('strings.messages') }}</span>
                    </a>
                </li>
                <li role="presentation" class="menu__link">
                    <a href="/home/my-courses/purchases" role="menuitem">
                        <span>{{ trans('strings.purchase_history') }}</span>
                    </a>
                </li>
                <li role="presentation" class="menu__link">
                    <a href="/account" role="menuitem">
                        <span>{{ trans('strings.account') }}</span>
                    </a>
                </li>
                <!-- show only on ipad size 
                <li role="presentation" class="menu__link">
                    <a href="/home/teaching" role="menuitem">
                        <span>Instructor Dashboard</span>
                    </a>
                </li>
                
                <li role="presentation" class="menu__link">
                    <a href="#" role="menuitem">
                        <span>My Wishlist</span>
                    </a>
                </li>
                end show on ipad size -->
                <li role="presentation" class="menu__link">
                    <a href="/home/instructor/revenue" role="menuitem">
                        <span>{{ trans('strings.revenue_report') }}</span>
                    </a>
                </li>
                
                <li role="presentation" class="menu__link" v-if="isadmin">
                    <a href="/admin/dashboard" role="menuitem">
                        <span>{{ trans('strings.admnin_dashboard') }}</span>
                    </a>
                </li>
               
                <li role="presentation" class="menu__link">
                    <a href="/logout" role="menuitem">
                        <span>{{ trans('strings.logout') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    
    export default {
        props: ['user', 'isadmin'],
        
        methods:{
            
        }
    }    
    
    
</script>




