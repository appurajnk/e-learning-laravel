<template>
    <div class="container">
        <h3 class="mb-3 fw-600">{{ trans('strings.purchase_history') }}</h3>
        <template>
            <purchase-table />
        </template>
        <!-- <template v-else>
            {{ trans('strings.no_purchases') }}
        </template> -->

        <hr />
        
        <h3 class="mb-3 fw-600">{{ trans('strings.refunds') }}</h3>
        <div class="row">
            <div class="col-md-12">
                <template v-if="creating">
                    <div class="card card-body">
                        <form @submit.prevent="send">
                            <div class="form-group row">
                                <label class="form-control-label d-flex justify-content-end align-items-center col-md-4">
                                    {{ trans('strings.course') }}    
                                </label>
                                <div class="col-md-8">
                                    <select v-if="payments.length" v-model='form.course' class="form-control">
                                        <option v-for="payment in payments" :value="payment.uuid" :key="payment.uuid">
                                            {{ payment.course.title }}
                                        </option>
                                    </select>
                                    <has-error :form="form" field="course"/>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="form-control-label d-flex justify-content-end align-items-center col-md-4">
                                    {{ trans('strings.refund_reason') }}</label>
                                <div class="col-md-8">
                                    <textarea v-model="form.comment" class="form-control" v-autosize="form.comment"
                                        :class="{ 'is-invalid': form.errors.has('comment') }"
                                        :placeholder="trans('strings.refund_reason_desc')"></textarea>
                                    <has-error :form="form" field="comment"></has-error>
                                </div>
                            </div>
                            <div class="form-group text-right">
                                <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
                                <base-button :loading="form.busy" class="btn btn-info btn-sm rounded-0 fw-500">
                                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                    {{ trans('strings.send_request') }}
                                </base-button>
                            </div>
                        </form>
                    </div>
                </template>
                <template v-if="!creating">
                    <button class="btn btn-sm btn-danger rounded-0 mb-2" @click.prevent="creating=true" v-if="payments.length > 0">
                        {{ trans('strings.request_refund') }}
                    </button>
                    
                    <refund-table></refund-table>
<!--                     
                    <template v-if="!user.has_refunds">
                        <div class="mt-0">
                            {{ trans('strings.no_refunds') }}
                        </div>
                    </template> -->
                </template>
            </div>
        </div>
        
    </div>
        
</template>

<script>
import Form from 'vform'
import axios from 'axios'
import { mapGetters } from 'vuex'
import PurchaseTable from './imports/_user_purchases'
import RefundTable from './imports/_user_refunds'
export default {
    components:{
        PurchaseTable,
        RefundTable
    },

    props: ['user'],

    data(){
        return{
            payments: [],
            creating: false,
            form: new Form({
                course: '',
                comment: ''
            })
        }
    },

    methods:{
        fetchRefundables(){
            axios.get(`/api/user/payments/refundable`)
                .then(res => {
                    this.payments = res.data
                })
        },
        send(){
            this.form.post(`/api/user/payment/refund`)
                .then(() => {
                    this.fetchRefundables()
                    this.$bus.$emit('refunds:refresh')
                    this.cancel()
                })
        },
        cancel(){
            this.form.reset()
            this.form.errors.clear()
            this.creating = false
        }
    },
    mounted(){
        this.fetchRefundables()
    }
}
</script>
