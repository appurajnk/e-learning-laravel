<template>
    <tr>
        <td><input class="form-control form-control-sm" v-model="form.code" /></td>
        <td><input class="form-control form-control-sm" v-model="form.name" /></td>
        <td><input class="form-control form-control-sm" v-model="form.symbol" /></td>
        <td><input :readonly="form.is_primary" class="form-control form-control-sm" v-model="form.conversion_rate" /></td>
        <td>
            <select class="form-control form-control-sm" v-model="form.symbol_position" @change="update()">
                <option value="left">{{ trans('strings.left_short') }}</option>
                <option value="right">{{ trans('strings.right_short') }}</option>
            </select>
        </td>
        <td class="text-left">
            <el-checkbox v-model="form.space_between" 
                @change="update()" 
                :border="false" 
                :label="trans('strings.space_between_sm')"
                class="m-0 d-inline"></el-checkbox>
        </td>
        <td class="bg-light">{{ formatted }}</td>
        <td>
            <el-switch
                @change="enabledChanged()"
                :disabled="form.is_primary == true"
                style="display: block"
                v-model="form.enabled"
                active-color="#13ce66"
                inactive-color="#ff4949"
                active-text=""
                inactive-text="">
            </el-switch>
        </td>
        <td>
            <button class="btn btn-sm btn-success" @click.prevent="update()">
                <i class="fa fa-save" v-if="!form.busy"></i>
                <i class="fas fa-spinner fa-spin" v-else></i>
            </button>
            <button class="btn btn-sm btn-danger ml-2" v-if="!form.is_primary" @click.prevent="destroy()">
                <i class="fa fa-trash" v-if="!form.busy"></i>
                <i class="fas fa-spinner fa-spin" v-else></i>
            </button>
        </td>
    </tr>
    
</template>

<script>
import Form from 'vform'
import axios from 'axios'
export default {
    props: {
        prop_currency: { type: Object, required: true },
    },

    watch:{
        prop_currency:{
            deep: true,
            handler(val){
                this.form.keys().forEach(key => {
                    this.form[key] = val[key]
                })
            }
        }
    },
    data(){
        return {
            form: new Form({
                id: '',
                name: '',
                is_primary: true,
                conversion_rate: 1,
                symbol: '',
                code: '',
                symbol_position: '',
                space_between: false,
                enabled: 1
            })
        }
    },

    computed:{
        formatted(){
            let rtn_val = 10.99;
            if(this.form.space_between){
                if(this.form.symbol_position == 'left'){
                    rtn_val = this.form.symbol + ' ' + rtn_val;
                } else {
                    rtn_val = rtn_val + ' ' + this.form.symbol;
                }
            } else {
                if(this.form.symbol_position == 'left'){
                    rtn_val = this.form.symbol + rtn_val;
                } else {
                    rtn_val = rtn_val + this.form.symbol;
                }
            }

            return rtn_val;
        }
    },

    methods:{
        update(){
            this.form.put(`/api/admin/currencies/${this.form.id}`)
                .then(() => this.$bus.$emit('currency:created', null))
        },
        primaryChanged(){
            axios.put(`/api/admin/currency/${this.form.id}/mark_as_primary`) 
                .then(() => {
                    this.$bus.$emit('currency:created', null)
                })
        },

        enabledChanged(){
            axios.put(`/api/admin/currency/${this.form.id}/toggle_enabled`) 
                .then(() => {
                    this.$bus.$emit('currency:created', null)
                })
        },
        destroy(){
            this.$dialog.confirm({title: this.trans('strings.confirm_delete')}, {animation: 'fade'})
                .then(dialog => {
                    axios.delete(`/api/admin/currencies/${this.form.id}`) 
                        .then(() => {
                            this.$bus.$emit('currency:created', null)
                        })
                })
        },
    },

    mounted(){
        this.form.keys().forEach(key => {
            this.form[key] = this.prop_currency[key]
        })
    }
}
</script>

<style scoped>
    .el-checkbox__input{
        display: inline !important;
        padding-right: 0 !important;
    }
   
</style>
