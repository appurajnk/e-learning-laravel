<template>
    <section class="course__list py-4">
        <div class="container">
            <div class="card border-secondary mb-4">
                <div class="card-header bg-white d-flex align-items-center justify-content-between">
                    <strong>
                        {{ trans('strings.sales_performance') }}
                    </strong>
                    <div>
                        <select class="form-control form-control-sm" 
                            v-model="period" @change="getSalesChartData()">
                            <option value="7">{{ trans('strings.last_x_days', {days: 7 }) }}</option>
                            <option value="30">{{ trans('strings.last_x_days', { days: 30 }) }}</option>
                            <option value="60">{{ trans('strings.last_x_days', { days: 60 }) }}</option>
                            <option value="90">{{ trans('strings.last_x_days', { days: 90 }) }}</option>
                            <option value="all">{{ trans('strings.all_time') }}</option>
                        </select>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <area-chart :data="chartData" :discrete="true" :ytitle="trans('strings.sales')" 
                                :download="true" :curve="false" legend="top" label="Sales"
                                    v-if="show_chart"></area-chart>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="border border-secondary">
                <v-server-table 
                    name="revenueTable"
                    :url="url"
                    :columns="columns" 
                    ref="datatable"
                    :options="options">
                    <template slot="period" slot-scope="props">
                        <a :href="props.row.report_url" v-if="props.row.total_revenue > 0">
                            {{ props.row.start_string }}
                        </a>   
                        <span v-else>{{ props.row.start_string }}</span>
                    </template>
                    <template slot="comment" slot-scope="props">
                        {{ props.row.status == 'open' ? trans('strings.total_not_yet_finalized') : '' }}  
                    </template>
                </v-server-table>
            </div>
        </div>
    </section> 
</template>


<script>
    import axios from 'axios'
    export default {
  
        data(){
            return {
                chartData: {},
                show_chart: false,
                period: 90,
                url: '/api/revenue',
                columns: ['period', 'total_revenue', 'expected_payment_date', 'comment'],
                
                options: {
                    perPage: 10,
                    requestAdapter(data) {
                        return {
                            page: data.page,
                            sortBy: data.orderBy ? data.orderBy : 'end_time',
                            direction: data.ascending ? 'desc' : 'asc',
                            query: data.query,
                            limit: data.limit
                        }
                    },
                    requestFunction:  function (data) {
                        return axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            this.dispatch('error', e);
                        }.bind(this));
                    },
                    responseAdapter({data}) {
                        return {
                            data: data.data,
                            count: data.total
                        }
                    },
                    headings: {
                        'period': this.trans('strings.time_period'),
                        'total_revenue': this.trans('strings.amount'),
                        'expected_payment_date': this.trans('strings.expected_payment_date'),
                        'comment': this.trans('strings.notes')
                    },
                    sortable:[],
                    templates: {
                        total_revenue(h, row) {
                            return this.formatCurrency(row.total_revenue, false)
                        }
                    }
                }
            }
        },
        
        methods: {
            getSalesChartData(){
                axios.get(`/api/sales-summary?period=${this.period}`)
                    .then(response => {
                        this.chartData = response.data
                        this.show_chart = true
                    })
            }
        },
        
        mounted(){
            this.getSalesChartData()
        }
        
        
    }
    
    
</script>
