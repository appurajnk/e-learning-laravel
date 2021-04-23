<template>
    <v-server-table 
        @loaded="loading=false"
        name="transactionsTable"
        url="/api/admin/transactions"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <template slot="type" slot-scope="props">
            <span class="fas fa-chevron-circle-up text-success" v-if="props.row.type == 'credit'"></span>
            <span class="fas fa-chevron-circle-down text-danger" v-else></span>
        </template>
    </v-server-table>
</template>

<script>
import axios from 'axios'
export default {
    data(){
        const vm = this
        return {
            loading:true,
            columns: ['uuid', 'created_at', 'user.full_name', 'description', 'long_description', 'amount', 'type' ],
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
                        sort: data.orderBy ? data.orderBy : 'created_at',
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
                    'uuid': '#',
                    'created_at': this.trans('strings.date'),
                    'type': '',
                    'user.full_name': this.trans('strings.user'),
                    'description': this.trans('strings.type'),
                    'long_description': this.trans('strings.description')
                },
                
                sortable:['created_at', 'amount'],
                texts:{ filter: "", limit: "" },
                templates: {
                    amount(h, row) {
                        return this.formatCurrency(row.amount, false);
                    },
                    created_at(h, row) {
                        return moment(row.created_at).format('DD-MM-YYYY');
                    }
                }
            }
        }
    }

}
</script>
