<template>
    <form class="auth-form" @submit.prevent="addToCart">
        <a href="/cart" :class="css_class" v-if="is_in_cart">
            {{ trans('strings.go_to_cart') }}
        </a>
        <base-button :loading="form.busy" type="" :class="css_class" v-else>
            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
            {{ trans('strings.add_to_cart') }}
        </base-button>  
    </form>
</template>


<script>
    import axios from 'axios'
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    export default {
        props: ['course', 'css_class'],
        
        data(){
            return {
                is_in_cart: false,
                form: new Form({
                    id: this.course.id,
                    title: this.course.title,
                    price: this.course.price
                }),
                couponForm: new Form({
                    cart: '', //course ids 
                    code: ''
                })
            }
          
        },
        
        computed: {
            ...mapGetters({
                cartItems: 'cart/items',
                cart: 'cart/cart',
                sitewideCoupon: 'cart/sitewideCoupon'
            }),
            
            cartHasDiscount(){
                return this.cart.total_price > this.cart.total_purchase_price
            },
        },
        
        methods: {
            async addToCart(){
                const res = await this.$store.dispatch('cart/addToCart', this.form)
                if(this.sitewideCoupon){
                    this.couponForm.code = await this.sitewideCoupon.code
                    this.couponForm.cart = await this.cart.id
                    if(this.couponForm.code){
                        await this.$store.dispatch('cart/applyCoupon', this.couponForm)
                    }
                }
                await this.$store.dispatch('cart/fetchCartItems')
                this.is_in_cart = await true
            },
            
            checkIfCourseIsInCart(){
                const lst = this.cartItems.map(ci => ci.product_id)
                if(lst.length == 0) return false
                this.is_in_cart = lst.includes(this.course.id)
            }
        },
        
        mounted(){
            setTimeout(() => {
                this.checkIfCourseIsInCart()
                this.form.id = this.course.id 
                this.form.title = this.course.title 
                this.form.price = this.course.price 
            }, 1000)
            
        }
        
        
    }
    
</script>