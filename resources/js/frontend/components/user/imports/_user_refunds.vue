<template>
    <v-server-table v-if="url" 
        name="refundTable"
        :url="url"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <template slot="cover_image" slot-scope="props">
            <div class="d-flex">
                <div>
                    <img :src="props.row.course.thumbnail" width="120" class="rounded-0 shadow-sm mr-2" />
                </div>
                <div>
                    <h3>
                        <a :href="`/course/${props.row.course.slug}`">{{ props.row.course.title }}</a>
                    </h3>
                </div>
            </div>
        </template>
    </v-server-table>
</template>

<script>
    
    import Form from 'vform'

    export default {
        data() {
            return {
                url: '/api/user/refunds/all',
                columns: ['cover_image', 'created_at', 'refunded_to', 'amount', 'status'],
                
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
                        'created_at': this.trans('strings.date'),
                        'refunded_to': this.trans('strings.refunded_to'),
                        'amount': this.trans('strings.amount')
                    },
                    sortable:['created_at'],
                    templates: {
                        created_at(h, row) {
                          return moment(row.created_at).format('DD-MM-YYYY');
                        },
                        amount(h, row) {
                            return this.formatCurrency(row.amount, false);
                        }
                    }
                }
            }    
        },
        
        methods:{
            refreshTable(){
                this.$refs.datatable.refresh()
            }
        },

        mounted(){
            //this.$bus.$on('refunds:refresh', () => this.refreshTable())
        }
        
        
    }
    
</script>
