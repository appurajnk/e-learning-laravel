<template>
    <div class="container">
        <vue-element-loading :active="loading" :is-full-screen="false" spinner="bar-fade-scale" color="#FF6700"/>
        <template v-if="!loading">

            <div class="row" v-if="cart.item_count > 0">
                <!-- LEFT SIDE -->
                <div class="col-md-8">
                    <div class="h5">

                        {{ cart.item_count }} 
                        {{ cart.item_count | pluralize(trans('course')) }} 
                        {{ trans('strings.in_cart') }}
                    </div>
                    <div class="list-group">
                        <div class="list-group-item p-2" v-for="item in cartItems" :key="item.id">
                            <div class="d-flex justify-content-between">
                                <div class="d-flex">
                                    <div class="mr-3">
                                        <img :src="item.product.thumbnail" width="120" />
                                    </div>
                                    <a :href="`/course/${item.product.slug}`">
                                        <h5 class="fw-600">{{ item.product.title | truncate(40) }}</h5>
                                        <span class="text-muted font-12">
                                            {{ trans('strings.by') }}
                                            {{ item.product.author.full_name }}
                                        </span>
                                    </a>
                                </div>
                                <div class="d-flex flex-column ml-4 text-right font-13">
                                    <a href="" class="mb-2" @click.prevent="removeFromCart(item.product.id)">
                                        {{ trans('strings.remove') }}
                                    </a>
                                </div>

                                <div class="d-flex flex-column justify-content-right text-right" v-if="item.has_discount">
                                    <h5 class="text-danger fw-600 mb-1">
                                        <span v-if="item.purchase_price > 0">
                                            <base-currency :price="item.purchase_price"></base-currency>
                                        </span>
                                        <span v-else>{{ trans('strings.free') }}</span>
                                    </h5>
                                    <del class="text-muted font-13">
                                        <base-currency :price="item.unit_price"></base-currency>
                                    </del>
                                    <div class="mt-2" v-if="item.coupon">
                                        <i class="sl sl-icon-tag"></i>
                                        <span class="badge badge-info promo__badge">
                                            {{ item.coupon.code }} 
                                            <button type="button" class="close" 
                                                @click="removeCoupon(item.id)" 
                                                aria-label="remove">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </span>
                                        <div v-if="item.coupon.expires" class="font-10 text-danger mt-1">
                                            {{ trans('strings.expires') }} {{ item.coupon.expires }}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex flex-column justify-content-right text-right" v-else>
                                    <h5 class="text-danger fw-600 mb-2">
                                        <base-currency :price="item.unit_price"></base-currency>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
                <!--/ END LEFT -->
                
                <div class="col-md-4 d-flex flex-column">
                    <!-- <div class="font-20">
                        {{ trans('strings.total') }}
                    </div> -->
                    
                    <!-- cart has discount -->
                    <div v-if="cartHasDiscount">
                        <h3 class="fw-600 h3">
                            <base-currency :price="cart.total_purchase_price"></base-currency>
                            <del class="text-muted h5">
                                <base-currency :price="cart.total_price"></base-currency>
                            </del>
                        </h3>
                    </div>
                    <div v-else>
                        <h3 class="fw-600 h3">
                            <base-currency :price="cart.total_price"></base-currency>
                        </h3>
                    </div>
                    
                    <base-enroll-now-button :courses="cartItems" v-if="cart.total_purchase_price == 0" />
                    
                    <a href="/cart/checkout" class="btn btn-block btn-danger rounded-0 fw-600" v-else>
                        {{ trans('strings.checkout') }}
                    </a>
                    <hr />
                    
                    <form @submit.prevent="applyCoupon">
                        <div class="form-group">
                            <div class="input-group mb-3">
                                <input type="text" v-model="form.code" 
                                    :class="{ 'is-invalid': form.errors.has('code') }"
                                    :placeholder="trans('strings.apply_coupon_code')" class="form-control rounded-0">
                                <div class="input-group-append">
                                    <base-button :loading="form.busy" class="btn rounded-0 text-white btn-info">
                                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                        {{ trans('strings.apply') }}
                                    </base-button>
                                </div>
                                <has-error :form="form" field="code"/>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- CART IS EMPTY -->
            <div class="row" v-else>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body d-flex flex-column justify-content-center align-items-center">
                            <i class="fa fa-shopping-cart fa-4x text-muted pt-4 mt-4"></i>
                            <p>{{ trans('strings.your_cart_is_empty') }}</p>
                            <a href="/" class="btn btn-danger btn-lg mb-4 mt-2 font-14">
                                {{ trans('strings.keep_shopping') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </template>
        
    </div>
</template>

<script>
    import { mapGetters } from 'vuex'
    import Form from 'vform'

    export default {
        data(){
            return {
                form: new Form({
                    cart: '', //course ids 
                    code: ''
                })
            }
        },

        computed: {
            ...mapGetters({
                cartItems: 'cart/items',
                cart: 'cart/cart',
                sitewideCoupon: 'cart/sitewideCoupon',
                loading: 'cart/loading'
            }),
            
            cartHasDiscount(){
                return this.cart.total_price > this.cart.total_purchase_price
            }
        },

        methods: {
            async removeFromCart(id){
                const res = this.$store.dispatch('cart/removeFromCart', {
                    id: id
                })
            },
            
            async applyCoupon(){
                this.form.cart = await this.cart.id
                await this.$store.dispatch('cart/applyCoupon', this.form)
            },
            
            async removeCoupon(itemId){
                const res = await this.$store.dispatch('cart/removeCoupon', {
                    itemId: itemId
                })
            }
        },
        
        mounted(){
            setTimeout(() => {
                if(this.sitewideCoupon){
                    this.form.code = this.sitewideCoupon.code
                    if(this.form.code){
                        this.applyCoupon()
                    }
                }
            }, 2000)
        }

    }
</script>

<style>

</style>