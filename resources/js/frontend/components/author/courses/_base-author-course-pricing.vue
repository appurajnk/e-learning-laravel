<template>
        <div class="setting-body white-bg-color">

            <div class="row">
                <div class="col-md-12">
                    <div class="font-weight-bold mb-2">
                        <h2>
                            {{ trans('strings.course_price_tier') }}    
                        </h2>
                    </div>
                    <!-- <p class="mb-1">
                        {{ trans('strings.select_price_tier') }}
                    </p> -->
                    <form @submit.prevent="UpdatePrice" @keydown="priceForm.onKeydown($event)">
                        <div class="form-row mb-4">
                            <div class="col-md-5">
                                <input class="form-control rounded-0" type="number" step="0.01" v-model="priceForm.price">
                                <has-error :form="priceForm" field="price"/>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="d-flex align-items-center">
                                    <base-button :loading="priceForm.busy" class="btn rounded-0 btn-danger">
                                        <i class="fas fa-spinner fa-spin" v-if="priceForm.busy"></i>
                                        {{ trans('strings.save') }}
                                    </base-button>
                                    <div class="font-weight-bold ml-3 border border-secondary p-2">
                                        {{ formatCurrency(priceForm.price) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div> <!--/ END PRICING -->
                
                
                <div class="col-md-12">
                    <hr />
                    <div class="font-weight-bold mb-2">
                        <h3 class="">
                            {{ trans('strings.course_coupons') }}
                        </h3>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <button type="button" class="btn btn-outline-info btn-md" 
                                    v-if="!createNewCoupon" @click="createNewCoupon=true">
                                    {{ trans('strings.create_new_coupon') }}
                                </button>
                            </div>
                            <inc-create-coupon-form :course="course" v-if="createNewCoupon"></inc-create-coupon-form>
                        </div>
                    </div>
                    
                    <!-- COUPONS -->
                    <div class="row">
                        <div class="col-md-12">
                            <inc-coupon-data-table :course="course"></inc-coupon-data-table>
                        </div>
                    </div>
                </div> <!--/ END COUPONS -->
            </div>
        
        </div>
</template>

<script>
    import IncCreateCouponForm from './imports/_course_coupon_form'
    import IncCouponDataTable from './imports/_coupon_data_table'
    import { mapGetters } from 'vuex'
    import Form from 'vform'
    export default {
        components: {
            IncCreateCouponForm,
            IncCouponDataTable
        },
        props: ['course'],
        data: () => ({
            createNewCoupon: false,
            priceForm: new Form({
                price: 0
            }),
            coupons: [],
            showTable: false
        }),
        
        methods: {
            FindCouponsByCourseId(){
                axios.get(`/api/coupons/findByCourse/${this.course.id}`)
                    .then(response => {
                        this.coupons = response.data.data
                        this.rows = response.data.data
                        this.showTable = true
                    })
            },
            
            UpdatePrice(){
                this.priceForm.put(`/api/courses/updatePrice/${this.course.id}`)
            }
        },

        mounted(){
            this.priceForm.price = this.course.price
            this.$bus.$on('createCoupon:cancelled', () => {
                this.createNewCoupon = false
            })
            .$on('createCoupon:completed', () => {
                this.createNewCoupon = false
            })
        }

    }
</script>
