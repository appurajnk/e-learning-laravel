<template>
    
    <v-server-table v-if="url" 
        name="purchaseTable"
        :url="url"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <template slot="cover_image" slot-scope="props">
            <div class="d-flex">
                <div>
                    <img :src="props.row.course.thumbnail" width="120" class="rounded shadow-sm mr-2" />
                </div>
                <div>
                    <h3>
                        <a :href="`/course/${props.row.course.slug}`">{{ props.row.course.title }}</a>
                    </h3>
                </div>
            </div>
        </template>
        
        <template slot="download" slot-scope="props">
            <a :href="`/home/purchases/${props.row.uuid}/receipt`" class="btn btn-outline-info btn-sm font-12"> {{ trans('strings.receipt') }} </a>
        </template>
    </v-server-table>
</template>

<script>
    
    import Form from 'vform'
    import axios from 'axios'
    export default {
        name: 'PageUserDashboardPurchases',
        data() {
            return {
                url: '/api/user/purchases/all',
                columns: ['cover_image', 'created_at', 'payment_method', 'amount', 'download'],
                
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
                            count: data.total
                        }
                    },
                    headings: {
                        'cover_image': '',
                        'created_at': this.trans('strings.purchase_date'),
                        'payment_method': this.trans('strings.purchase_type'),
                        'amount': this.trans('strings.amount'),
                        'download': ''
                    },
                    sortable:['created_at'],
                    templates: {
                        created_at(h, row) {
                          return moment(row.created_at).format('DD-MM-YYYY');
                        },
                        payment_method(h, row){
                            const val = row.payment_method
                            return val.charAt(0).toUpperCase() + val.slice(1)
                        },
                        amount(h, row) {
                            return this.formatCurrency(row.amount, false)
                        }
                    }
                }
            }    
        },

        
        
    }
    
</script>
