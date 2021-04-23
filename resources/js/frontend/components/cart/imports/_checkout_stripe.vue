<template>
    <form id="stripe-checkout-form" @submit.prevent="submit">
        <div class="alert alert-danger" v-if="cardError">{{ cardError }}</div>
        <div id="card-errors" role="alert"></div>
        <div id="card-element"></div>
        
        <div class="form-group d-flex mt-2 justify-content-between">
            <base-button :loading="form.busy" class="btn btn-danger rounded-0 btn-sm font-16">
                <span v-if="!form.busy">{{ trans('strings.complete_payment') }}</span>
                <span v-else>
                    <i class="fas fa-spinner fa-spin"></i>
                    {{ trans('strings.processing') }}
                </span>
            </base-button> 
        </div>
    </form>
</template>
<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'

    export default {
        data(){
            return {
                form: new Form({
                    cart: '',
                    token: '',
                    courses: [],
                    purchase_price: '',
                    coupons: []
                }),
                stripe: {},
                cardError: '',
                card: {}
            }
        },
        
        props:{
            type: { type: String, default: 'cart' },
            course: { type: [Array, Object] },
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
            }
        },
        
        methods: {
            submit(){
                this.stripe.createToken(this.card)
                    .then( response => {
                        if(response.error) {
                            this.cardError = response.error.message
                        } else {
                            this.form.token = response.token.id;
                            this.submitCart()
                        }
                    })
            },
            
            submitCart(){
                this.form.courses = this.cartItems.map(item => item.product.id)
                this.form.coupons = this.cartItems.filter(item => {
                    return item.coupon_id !== null;
                }).map( item => item.coupon_id )
                
                this.form.cart = this.cart.id
                this.form.purchase_price = this.cart.total_purchase_price
                this.form.post(`/api/cart/payment/process`)
                    .then(response => {
                        location.href="/home/my-courses/learning"
                    })
            }
            
        },
        
        
        mounted(){
            setTimeout(() => {
                this.stripe = Stripe(this.api_key)
                const elements = this.stripe.elements();
                const style = {
                    base: {
                        iconColor: '#666EE8',
                        color: '#31325F',
                        lineHeight: '40px',
                        fontWeight: 300,
                        fontSize: '18px',
                        '::placeholder': {
                            color: '#CFD7E0',
                        },
                    },
                    invalid: {
                        color: '#fa755a',
                        iconColor: '#fa755a'
                    }
                };
                this.card = elements.create('card', {style: style, hidePostalCode: true});
                this.card.mount('#card-element');
                
            }, 500)
        }
        
    }
</script>