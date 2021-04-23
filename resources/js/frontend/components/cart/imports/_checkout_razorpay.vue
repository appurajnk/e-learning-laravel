<template>
    <button :disabled="form.busy" class="btn btn-danger rounded-0 btn-lg font-16" @click="onBtnClick()">
        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
        <span>{{ trans('strings.complete_payment') }}</span>
    </button> 
</template>
<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'

    export default {
        data(){
            return {
                form: new Form({
                    razorpay_payment_id: '',
                    cart: '',
                    courses: [],
                    purchase_price: '',
                    coupons: []
                }),
                
                options: {
                    key: '',
                    amount: 1000,
                    name: '',
                    currency: 'INR',
                    handler: this.handler,
                    theme: {
                        color: "#168AFA"
                    }
                },
                
            }
        },
        
        props:{
            type: { type: String, default: 'cart' },
            api_key: { type: String, required: true }
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

            razorPayInstance(){
                return new Razorpay(this.options)
            }
        },
        
        methods: {
            onBtnClick(){
                this.options.amount = parseInt(this.cart.total_purchase_price*100)
                this.razorPayInstance.open()
            },
            
            handler(response){
                this.form.razorpay_payment_id = response.razorpay_payment_id
                this.form.courses = this.cartItems.map(item => item.product.id)
                this.form.coupons = this.cartItems.filter(item => {
                    return item.coupon_id !== null;
                }).map( item => item.coupon_id )
                
                this.form.cart = this.cart.id
                this.form.purchase_price = this.cart.total_purchase_price
                this.form.post(`/api/cart/payment/razorpay/process`)
                    .then(response => {
                        window.location.href="/home/my-courses/learning"
                    })
            }
        },
        
        beforeMount(){
            this.options.key = this.api_key
            this.options.name = window.config.appName
            //this.options.currency = window.config.default_currency

        }
        
    }
</script>