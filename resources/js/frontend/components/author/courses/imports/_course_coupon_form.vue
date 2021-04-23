<template>
    <form @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="form-group">
            <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" 
                :placeholder="trans('strings.coupon_code')" class="form-control form-control-lg font-16 fw-300">
            <has-error :form="form" field="code"/>
        </div>
        <div class="form-group form-row d-flex">
            <div class="col-md-8 justify-content-center align-self-center">
                <select v-model="type" class="form-control">
                    <option value="free">{{ trans('strings.free') }}</option>
    		        <option value="discount">{{ trans('strings.discounted_price') }}</option>
                </select>
		    </div>
		    <div class="col-md-4 justify-content-center align-self-center">
		        {{ trans('strings.final_price') }}: 
                    <span class="badge badge-success">
                        {{ formatCurrency(finalPrice) }}
                    </span>
		    </div>
        </div>
        
        <div class="form-group" v-if="type=='discount'">
            <input type="number" min="5" max="95" v-model="form.percent" :class="{ 'is-invalid': form.errors.has('percent') }" 
                :placeholder="trans('strings.discount_percentage')" class="form-control form-control-lg font-16 fw-300">
            <has-error :form="form" field="percent"/>
        </div>
        
        <div class="form-group">
            <input type="number" min="1" v-model="form.quantity" :class="{ 'is-invalid': form.errors.has('quantity') }" 
                :placeholder="trans('strings.number_of_coupons')" class="form-control form-control-lg font-16 fw-300">
            <has-error :form="form" field="quantity"/>
        </div>
        
        <div class="form-group form-row d-flex">
            <div class="col-md-8 justify-content-center align-self-center">
                <el-date-picker 
                    type="date"
                    name="expires"
                    :placeholder="trans('strings.deadline')" 
                    value-format="yyyy-MM-dd"
                    prefix-icon="fa fa-calendar"
                    v-model="form.expires"
                    :picker-options="pickerOptions"
                    style="width: 100%"></el-date-picker>

                <has-error :form="form" field="expires"/>
            </div>
            <div class="col-md-4 justify-content-center align-self-center">({{ trans('strings.optional') }})</div>
        </div>
        
        <div class="form-group d-flex text-right">
            <div class="justify-content-center align-self-center">
                <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.create') }}
                </base-button>
            </div>
            <div class="justify-content-center align-self-center ml-3">
                <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
            </div>
        </div>
    </form>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'CreateCouponForm',
        props: ['course'],
        data: () => ({
            pickerOptions:{
                disabledDate: (time) => {
                    return moment().diff(time, 'days') > 0
                }
            },
            type: 'free',
            form: new Form({
                course: '',
                code: '',
                percent: 10,
                quantity: '',
                expires: '',
                sitewide: false
            })
        }),
        computed:  {
            finalPrice: function () {
              return (this.course.price - ((this.form.percent/100)*this.course.price)).toFixed(2)
            },
        },

        watch:{
            type(value){
                if(value == 'free') this.form.percent = 100
            }
        },
          
        methods: {
            create(){
                this.form.course = this.course.id
                this.form.post(`/api/coupons`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('createCoupon:completed', null)
                    })
            },
            cancel(){
                this.form.reset()
                this.$bus.$emit('createCoupon:cancelled', null)
            }
            
        },
        
        mounted(){
            if(this.type=='free'){
                this.form.percent=100
            }
            
            this.$bus.$on('chosen:changed', data => {
                this.type = data
                if(data=='free'){
                    this.form.percent=100
                } else {
                    this.form.percent=10
                }
            })
        }
        
        
    }
</script>

<style>
    .vdp-datepicker .form-control[readonly] {
        background-color: #ffffff !important;
    }
    .vdp-datepicker__calendar{
        width: 100% !important;
    }
</style>