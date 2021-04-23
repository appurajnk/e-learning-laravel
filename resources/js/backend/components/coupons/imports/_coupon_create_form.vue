<template>
    <form @submit.prevent="create" class="form-horizontal">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <div class="card card-accent-success">
                    <div class="card-header">
                        {{ trans('strings.create_coupon') }}
                    </div>
                    
                    <div class="card-body bg-light">
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-right">{{ trans('strings.code') }}:</label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" 
                                    :placeholder="trans('strings.coupon_code')" class="form-control form-control-lg font-16 fw-300">
                                <has-error :form="form" field="code"/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-right">{{ trans('strings.discount_type') }}:</label>
                            <div class="col-md-7">
                                <select v-model="type" class="form-control form-control-lg">
                                    <option value="free">{{ trans('strings.free') }}</option>
                                    <option value="discount">{{ trans('strings.discounted_price') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group row" v-if="type=='discount'">
                            <label class="col-md-5 col-form-label text-right">{{trans('strings.discount_percentage')}}:</label>
                            <div class="col-md-7">
                                <input type="number" min="5" max="95" v-model="form.percent" :class="{ 'is-invalid': form.errors.has('percent') }" 
                                    :placeholder="trans('strings.discount_percentage')" class="form-control form-control-lg font-16 fw-300">
                                <has-error :form="form" field="percent"/>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-right">{{ trans('strings.quantity')}}:</label>
                            <div class="col-md-7">
                                <input type="number" min="1" v-model="form.quantity" :class="{ 'is-invalid': form.errors.has('quantity') }" 
                                    :placeholder="trans('strings.number_of_coupons')" class="form-control form-control-lg font-16 fw-300">
                                <has-error :form="form" field="quantity"/>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-md-5 col-form-label text-right">{{ trans('strings.deadline') }}:</label>
                            <div class="col-md-7">
                                <el-date-picker 
                                    type="date"
                                    size="large"
                                    name="expires"
                                    :placeholder="trans('strings.deadline')" 
                                    prefix-icon="fa fa-calendar"
                                    value-format="yyyy-MM-dd"
                                    v-model="form.expires"
                                    :picker-options="pickerOptions"
                                    style="width: 100%"></el-date-picker>
                                <has-error :form="form" field="expires"/>
                            </div>
                        </div>
                    </div>
                    
                    <div class="card-footer">
                        <base-button :loading="form.busy" class="btn btn-sm btn-primary mr-3">
                            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                            {{ trans('strings.create') }}
                        </base-button>
                        
                        <button class="btn btn-sm btn-danger" @click.prevent="cancel()">
                            <i class="fa fa-ban"></i> 
                            {{ trans('strings.cancel') }}
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
    </form>
    
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'CreateCouponForm',
        data: () => ({
            pickerOptions:{
                disabledDate: (time) => {
                    return moment().diff(time, 'days') > 0
                }
            },
            type: 'free',
            form: new Form({
                course: null,
                code: '',
                percent: 100,
                quantity: '',
                expires: '',
                sitewide: true
            })
        }),
       
        methods: {
            create(){
                this.form.post(`/api/coupons`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('createCoupon:completed', null)
                    })
            },
            cancel(){
                this.form.reset()
                this.$bus.$emit('createCoupon:cancelled', null)
            },
            onSelectChanged(){
                if(this.type=='free'){
                    this.form.percent=100
                } else {
                    this.form.percent=10
                }
            }
            
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