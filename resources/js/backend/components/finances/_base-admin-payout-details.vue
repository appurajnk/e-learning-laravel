<template>
    <div>
        <ul class="nav nav-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#nav-payouts" role="tab">
                    {{ trans('strings.payouts') }}
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#nav-purchases" role="tab">
                    {{ trans('strings.purchase_details') }}
                </a>
            </li>
        </ul>
        <div class="tab-content card-min-height" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-payouts" role="tabpanel">
                <template v-if="period.can_be_closed">
                    <form @submit.prevent="closePeriod">
                        <div class="text-center d-block">
                            <p>
                                {{ trans('strings.period_can_be_closed') }}
                            </p>
                            <base-button :loading="form.busy" class="btn btn-lg btn-danger rounded-0">
                                <span v-if="form.busy">
                                    <i class="fas fa-spinner fa-spin"></i>
                                    {{ trans('strings.processing') }}
                                </span>
                                <span v-else>
                                    <i class="fa fa-lock"></i> {{ trans('strings.close_period') }}
                                </span>
                            </base-button>
                        </div>
                    </form>
                </template>
                <div v-else>
                    <template v-if="period.is_open">
                        <span v-html="trans('strings.you_cannot_close_period', {date: period.end_time})"></span>"
                    </template>
                    <template v-else>
                        <inc-payouts-table :tableData="payoutsTableData"></inc-payouts-table>
                    </template>
                </div>
            </div>
            
            <div class="tab-pane fade" id="nav-purchases" role="tabpanel">
                <inc-purchase-table :tableData="purchaseTableData"></inc-purchase-table>  
            </div>
        </div>
    </div>
                
</template>


<script>
    import axios from 'axios'
    import Form from 'vform'
    import IncPurchaseTable from './imports/_purchase_table'
    import IncPayoutsTable from './imports/_payouts_table'
    export default {
        props: ['period'],
        components: {
            IncPurchaseTable,
            IncPayoutsTable
        },
        
        data(){
            return {
                form: new Form({}),
                payoutsTableData: [],
                purchaseTableData: []

            }
        },
        
        methods: {
            closePeriod(){
                this.form.post(`/api/admin/periods/${this.period.uuid}/close`)
                    .then(response => {
                        location.reload()
                    })
            },

            fetchPayoutDetails(){
                axios.get(`/api/admin/periods/${this.period.uuid}`)
                    .then(response => {
                        this.payoutsTableData = response.data.payouts
                        this.purchaseTableData = response.data.data.purchases
                    })
            }
        },

        created(){
            this.fetchPayoutDetails()
        },

        mounted(){
            this.$bus.$on('payout-processed', () => {
                this.fetchPayoutDetails()
            })
            
        }
    }
    
</script>
