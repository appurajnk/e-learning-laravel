<template>
    <span class='moneyx' :class="customClass">
        {{ display }} 
    </span>
</template>

<script>
    import { mapGetters } from 'vuex'
    
    export default{
        computed:{
            display(){
                return this.price > 0 ? this.formatCurrency(this.price) : this.trans('strings.free')
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

        mounted(){
            
        }


        
    }
</script>