<template>
    <v-client-table
        name="purchaseTable"
        :data="tableData"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <template slot="course" slot-scope="props">
            <a :href="`/course/${props.row.course.slug}`" target="_blank">{{ props.row.course.title }}</a>
        </template>
    </v-client-table>
</template>

<script>
    
    import Form from 'vform'

    export default {
        name: 'PageUserDashboardPurchases',
        
        props:['tableData'],
        
        data() {
            return {
                columns: ['gateway_payment_id', 'course', 'course.author.full_name', 'created_at', 'payment_method', 'amount', 'author_earning', 'user.full_name'],
                
                options: {
                    perPage: 25,
                    perPageValues:[25,50,100],
                    filterable: false,
                    headings: {
                        'gateway_payment_id': this.trans('strings.gateway_payment_id'),
                        'course': this.trans('strings.course'),
                        'created_at': this.trans('strings.purchase_date'),
                        'payment_method': this.trans('strings.payment_type'),
                        'amount': this.trans('strings.amount'),
                        'author_earning': this.trans('strings.author_earning'),
                        'user.full_name': this.trans('strings.purchased_by'),
                        'course.author.full_name': this.trans('strings.author')
                    },
                    filterByColumn:false,
                    sendEmptyFilters: false,
                    pagination: { 
                        chunk:2, 
                        dropdown: false,
                        edge: false
                    },
                    sortable:['created_at'],
                    columnsDropdown: false,
                    texts:{
                        filter: "",
                        limit: ""
                    },
                    templates: {
                        created_at(h, row) {
                          return moment(row.created_at).format('DD-MM-YYYY');
                        },
                        amount(h, row) {
                            return this.formatCurrency(row.amount, false);
                        },
                        author_earning(h, row) {
                            return this.formatCurrency(row.author_earning, false);
                        }
                    }
                }
            }    
        }
        
        
    }
    
</script>
