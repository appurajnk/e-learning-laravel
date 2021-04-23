<template>
    <div class="nav__wishlist_dropdown visible-lg-block">
        <div class="gabs__dropdown dropdown--on-hover dropdown_icon dropdown__shoppinglist">
            <a href="javascript:void(0)" class="gabs__dropdown-toggle gabs__hover_grey" role="button">
                <div class="fx pos-r text-center">
                    <span class="fa fa-shopping-cart dropdown__main_icon gicon"></span>
                    <!-- <span class="badge bg-transparent text-secondary" v-if="loading">
                        <span class="fa fa-circle-o-notch font-10 fa-spin"></span>
                    </span> -->
                    <template v-if="!loading && cart.item_count > 0">
                        <span class="badge">
                            {{ cart.item_count > 9 ? '9+' : cart.item_count }}
                        </span>
                    </template>
                </div>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <template v-if="cart.item_count > 0">
                    <li class="shopping_list_items" role="presentation">
                        <ul>
                            <li role="presentation" v-for="item in cartItems" 
                                :key="item.product.uuid"
                                class="mycourses__item nav__cart mb-2">
                                <a :href="`/course/${item.product.slug}`">
                                    <div class="fx-lt">
                                        <div class="mycourses__image">
                                            <img :src="item.product.thumbnail" width="100">
                                        </div>
                                        <div class="fx ml-space-sm">
                                            <div class="metadata__title">
                                                {{ item.product.title | truncate(25) }}
                                            </div>
                                            <div class="meta_info">
                                                <span class="metadata__instructor">
                                                    {{ trans('strings.by') }} 
                                                    {{ item.product.author.full_name }}
                                                    {{ item.product.author.tagline }}
                                                </span>
                                                <div class="mt-0 mb-space-0 nav__price">
                                                    <template v-if="item.has_discount">
                                                        <span class="nav__price_final">
                                                            <base-currency :price="item.purchase_price"></base-currency> 
                                                        </span>
                                                        <span class="nav__price_discount line-through">
                                                            <base-currency :price="item.unit_price"></base-currency> 
                                                        </span>
                                                    </template>
                                                    <template v-else>
                                                        <span class="nav__price_final">
                                                            <base-currency :price="item.unit_price"></base-currency> 
                                                        </span>
                                                    </template>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li role="presentation" class="d-flex">
                        <div class="dropdown__footer dropdown__footer_with_btn p-3">
                            <div class="h5" v-if="cart.has_discount">
                                {{ trans('strings.total') }}: 
                                <base-currency :price="cart.total_purchase_price"></base-currency> 
                                <del class="text-muted font-16">
                                    <base-currency :price="cart.total_price"></base-currency> 
                                </del>
                            </div>
                            <div class="h5" v-else>
                                {{ trans('strings.total') }}:
                                <base-currency :price="cart.total_price"></base-currency>
                            </div>
                            <div>
                                <a href="/cart" class="btn btn-info rounded-0 text-white">
                                    {{ trans('strings.go_to_cart') }} 
                                </a>
                            </div>
                        </div>
                    </li>
                </template>
                
                <template v-else>
                    <li role="presentation">
                        <div class="zero-state__detail px-2 py-4 text-center">
                            <p class="mb-2">{{ trans('strings.your_cart_is_empty') }} </p>
                            <a href="/" class="font-16 fw-600">
                                {{ trans('strings.keep_shopping') }}     
                            </a>
                        </div>
                    </li>
                </template>
            </ul>
        </div>
    </div>
    
</template>

<script>
    import { mapGetters } from 'vuex'
    import Cookie from 'js-cookie'
    
    export default{
        props: {
            is_mobile: {
                type: Boolean,
                default: false
            }
        },
        computed:{
            user(){
                return this.auth.user ? this.auth.user : null
            },
            ...mapGetters({
                cart: 'cart/cart',
                cartItems: 'cart/items',
                loading: 'cart/loading'
            }),
        },
        
        async beforeMount(){
            await this.$store.dispatch('cart/fetchCartItems')
        },

        mounted(){
            if(this.currencies.length === 0){
                this.$store.dispatch('currency/fetchCurrencies')
            }
        }
    }
    
</script>