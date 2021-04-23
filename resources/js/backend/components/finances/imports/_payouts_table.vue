<template>
    <v-client-table
        name="payoutTable"
        :data="tableData"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <div slot="child_row" slot-scope="props">
            <div class="card card-body d-flex mb-0">
                <div v-if="props.row.comment">
                    <template>
                        <div>
                            <b>{{ trans('strings.comment')}}: </b>{{props.row.comment}}
                        </div>
                        <div>
                            <b>{{ trans('strings.gateway_payout_id')}}: </b>{{ props.row.payout_batch_id }}
                        </div>
                    </template>
                </div>
                <template v-if="!props.row.user.paypal_email">
                    <div class="mb-2">
                        {{ trans('strings.paypal_email_missing') }}
                    </div>
                    <div>
                        <button :disabled="form.busy" class="btn btn-info btn-sm"
                            @click="sendEmailReminder(props.row.id)">
                            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                            <span>
                                {{ trans('strings.send_email_reminder', {user: props.row.user.full_name}) }}
                            </span>
                        </button>
                    </div>
                </template>
            </div>
        </div>
        <template slot="action" slot-scope="props">
            <div v-if="props.row.is_processed == false">
                <template v-if="props.row.user.paypal_email">
                    <process-payout-button :uuid="props.row.uuid"></process-payout-button>
                </template>
                <template v-else>
                    <button class="btn btn-sm" :class="isChildOpen(props.row.id) ? 'btn-danger' : 'btn-success'" 
                        @click="toggleChildRow(props.row.id)">
                        <span v-if="isChildOpen(props.row.id)">
                            <i class="fas fa-minus-square"></i> {{ trans('strings.close') }}
                        </span>
                        <span v-else>
                            <i class="fas fa-plus-square"></i> {{ trans('strings.open') }}
                        </span>
                    </button>
                </template>
            </div>
            <update-payout-batch-status-button v-if="props.row.payout_batch_status && props.row.payout_batch_status !== 'SUCCESS'" 
                :uuid="props.row.uuid"></update-payout-batch-status-button>
        </template>
    </v-client-table>
</template>

<script>
    
    import Form from 'vform'
    import ProcessPayoutButton from './_process_payout_button'
    import UpdatePayoutBatchStatusButton from './_update_payout_batch_status_button'

    export default {
        name: 'PageUserDashboardPurchases',
        components:{
            ProcessPayoutButton,
            UpdatePayoutBatchStatusButton
        },

        props:['tableData'],

        data() {
            return {
                columns: ['period.start_string', 'user.full_name', 'user.paypal_email', 'net_earnings', 'expected_payout_date', 'processed_at', 'is_processed', 'payout_batch_status', 'action'],
                openChildRows: [],
                form: new Form({payout: null}),
                options: {
                    perPage: 25,
                    perPageValues:[25,50,100],
                    childRow: true,
                    highlightMatches: true,
                    filterable: ['user.full_name', 'email', 'is_processed'],
                    headings: {
                        'period.start_string': this.trans('strings.period'),
                        'user.full_name': this.trans('strings.user'),
                        'user.paypal_email': this.trans('strings.paypal_email'),
                        'is_processed': this.trans('strings.status'),
                        'net_earnings': this.trans('strings.amount'),
                        'expected_payout_date': this.trans('strings.payout_date'),
                        'processed_at': this.trans('strings.date_processed'),
                        'payout_batch_status': this.trans('strings.payout_gateway_status'),
                        'action': ''
                    },
                    filterByColumn:false,
                    sendEmptyFilters: false,
                    pagination: { 
                        chunk:2, 
                        dropdown: false,
                        edge: false
                    },
                    sortable:['expected_payout_date', 'status'],
                    columnsDropdown: false,
                    texts:{
                        filter: "",
                        limit: ""
                    },
                    templates: {
                        expected_payout_date(h, row) {
                          return moment(row.expected_payout_date).format('DD-MM-YYYY');
                        },
                        net_earnings(h, row) {
                          return this.formatCurrency(row.net_earnings, false);
                        },
                        is_processed(h, row){
                            return row.is_processed==1 ? this.trans('strings.processed') : this.trans('strings.pending')
                        },
                        'user.paypal_email': function(h, row){
                            return row.paypal_email ? row.paypal_email : this.trans('strings.not_provided');
                        }
                    }
                }
            }    
        },
        
        watch:{
            tableData: {
                deep: true,
                handler(value) {
                    
                }
            }
        },

        methods:{
            toggleChildRow(id){
                this.$refs.datatable.toggleChildRow(id)
                this.openChildRows = this.$refs.datatable.openChildRows
            },
            isChildOpen(id){
                return this.openChildRows.includes(id);
            },
            async sendEmailReminder(id){
                this.form.payout = await id
                await this.form.post(`/api/admin/send_reminder_for_paypal_email`)
                    .then(response => {
                        
                    })
            }
        }
    }
    
</script>
