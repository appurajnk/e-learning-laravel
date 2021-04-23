<template>
    <v-server-table 
        @loaded="loading=false"
        name="periodsTable"
        :url="url"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <template slot="uuid" slot-scope="props">
            <a :href="`/admin/payouts/period/${props.row.uuid}`">{{props.row.uuid}}</a>
        </template>
    </v-server-table>
</template>

<script>
import axios from 'axios'
export default {
    layout: 'admin',
    middleware: 'admin',
    data(){
        const vm = this
        return {
            loading: true,
            url: '/api/admin/periods',
            columns: ['uuid', 'start_string', 'payout_date', 'total_payments', 'total_refunds', 'pending_payouts', 'status'],
            options: {
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
                        sort: data.orderBy ? data.orderBy : 'start_time',
                        direction: data.ascending ? 'desc' : 'asc',
                        query: data.query,
                        limit: data.limit
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
                    'uuid': this.trans('strings.period_id'),
                    'start_string': this.trans('strings.period'),
                    'start_time': this.trans('strings.from'),
                    'end_time': this.trans('strings.to'),
                    'payout_date': this.trans('strings.payout_date'),
                    'status': this.trans('strings.status'),
                    'total_payments': this.trans('strings.purchases'),
                    'total_refunds': this.trans('strings.refunds'),
                    'pending_payouts': this.trans('strings.pending_payouts')
                },
                sortable:['start_time', 'end_time'],
                texts:{ filter: "", limit: "" },
                templates: {
                    payout_date(h, row) {
                        return moment(row.payout_date).format('MMMM DD, YYYY')
                    },
                    total_payments(h, row) {
                        return row.payments.length
                    },
                    total_refunds(h, row) {
                        return row.refunds.length
                    },
                    status(h, row){
                        return this.trans(`strings.${row.status}`)
                    }
                }
            }
        }
    }


}
</script>
