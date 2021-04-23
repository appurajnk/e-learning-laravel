<template>
    <v-server-table 
        @loaded="loading=false"
        name="coursesTable"
        :url="url"
        :columns="columns" 
        ref="datatable"
        :options="options">
        
        <div slot="afterFilter" class="">
            <div class="mr-sm-2">
                <select v-model="status" class="form-control rounded-0" @change="refreshTable()">
                    <option value>{{ trans('strings.all_refunds') }}</option>
                    <option value="open">{{ trans('strings.pending') }}</option>
                    <option value="closed">{{ trans('strings.processed') }}</option>
                </select>
            </div>
        </div>
        <div slot="child_row" slot-scope="props">
            <div class="card card-body"> 
                <p>
                    {{ trans('strings.refund_reason') }}: {{props.row.comment}}
                </p>
                <div v-if="props.row.status=='open'">
                    <p v-html="trans('strings.refund_processed_details', [props.row.payment.payment_method, props.row.payment.gateway_payment_id])"></p>
                        
                    <p>
                        <inc-process-refund-button :uuid="props.row.uuid"
                            @refund-processed="refreshTable()"></inc-process-refund-button>
                    </p>
                </div>
                <div v-else>
                    <p v-html="trans('strings.refund_processed_sent_to', [props.row.refunded_to])"></p>
                </div>
            </div>
        </div>
    </v-server-table>
</template>

<script>
import axios from 'axios'
import IncProcessRefundButton from './imports/_process_refund_button'
export default {
    layout: 'admin',
    middleware: 'admin',
    components:{
        IncProcessRefundButton    
    },

    data(){
        const vm = this
        return {
            loading: true,
            url: '/api/admin/refunds',
            status: '',
            columns: ['course.title', 'requester.full_name', 'requester.email', 'amount', 'created_at', 'status', 'processed_at'],
            options: {
                childRow: true,
                requestFunction:  function (data) {
                    return axios.get(this.url, {
                        params: data
                    }).catch(function (e) {
                        this.dispatch('error', e);
                    }.bind(this));
                },
                requestAdapter(data) {
                    return {
                        page: data.page,
                        sort: data.orderBy ? data.orderBy : 'created_at',
                        direction: data.ascending ? 'desc' : 'asc',
                        query: data.query,
                        limit: data.limit,
                        status: vm.status
                    }
                },
                responseAdapter({data}) {
                    return {
                        data: data.data,
                        count: data.meta.total
                    }
                },
                highlightMatches: true,
                headings: {
                    'course.title': this.trans('strings.course'),
                    'requester.full_name': this.trans('strings.user'),
                    'requester.email': this.trans('strings.email'),
                    'created_at': this.trans('strings.created_at'),
                    'processed_at': this.trans('strings.processed_at')
                },
                
                columnsDropdown: false,
                texts:{
                    filter: "",
                    limit: ""
                },
                templates: {
                    amount(h, row) {
                        return this.formatCurrency(row.amount, false);
                    },
                    status(h, row){
                        return this.trans(`strings.${row.status}`)
                    },
                    processed_at(h, row) {
                        return row.processed_at ? moment(row.processed_at).format('DD-MM-YYYY') : '-';
                    },
                    created_at(h, row) {
                        return moment(row.created_at).format('DD-MM-YYYY');
                    }
                }
            }
        }
    },
    
    
    methods: {
        refreshTable(){
            this.$refs.datatable.refresh()
        }
    }

    

}
</script>
