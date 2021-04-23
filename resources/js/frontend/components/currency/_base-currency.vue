<template>
    <span class='moneyx' :class="customClass">
        {{ display }} 
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default{
        computed:{
            //...mapGetters({
                // currency: 'currency/currency',
                // //currencies: 'currency/currencies',
                // conversion_rate: 'currency/conversion_rate'
            //}),
            
            display(){

                return this.price > 0 ? this.formatCurrency(this.price) : this.trans('strings.free')
                // const price = (this.price * this.conversion_rate).toFixed(2)
                // const selected_currency = this.currencies.filter(c => c.code == this.currency)[0]
                // if(selected_currency && selected_currency !== undefined){
                //     if(selected_currency.space_between){
                //         if(selected_currency.symbol_position=='left') return selected_currency.symbol+ ' ' + price
                //         return price + ' ' + selected_currency.symbol
                //     } else {
                //         if(selected_currency.symbol_position=='left') return selected_currency.symbol+price
                //         return price+selected_currency.symbol
                //     }
                // }
            }
        },
        
        props:{
            price: { type: [Number, String] },
            customClass: { type: String }
        },
        
        watch:{
            currency(val){
                
            }
        },

        
    }
</script>