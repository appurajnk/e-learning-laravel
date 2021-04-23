<template>
    <el-dropdown>
        <el-button type="plain">
            <i class="fas fa-money-bill-alt"></i>
            <span class="text-uppercase">{{ currency }} </span>
            <i class="el-icon-arrow-up el-icon--right"></i>
        </el-button>
            
        <el-dropdown-menu slot="dropdown">
            <el-dropdown-item v-for="c in selected" :key="c.code">
                <a href="javascript:void(0);" class="d-block" @click.prevent="switchCurrency(c.code)">
                    {{ c.name }}
                </a>
            </el-dropdown-item>
        </el-dropdown-menu>
    </el-dropdown>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default{
        computed:{
            ...mapGetters({
                currencies: 'currency/currencies'
            }),
            
            currency:{
                get(){
                    return this.$store.state.currency.currency
                },
                
                set(val){
                    this.$store.commit('currency/SET_CURRENCY', val)
                }
            },

            selected(){
                return this.currencies.filter(c => c.code !== this.currency)
            }
        },

        methods:{
            async switchCurrency(cur){
                await this.$store.commit('currency/SET_CURRENCY', cur)
            }
        }
        
        
    }
</script>