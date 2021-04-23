<template>
    <section class="course__list py-4">
        <div class="container">
            <v-client-table
                name="purchaseTable"
                :data="sales_data" 
                :columns="columns" 
                :options="options"></v-client-table>
        </div>
    </section>
</template>


<script>
    import axios from 'axios'
    export default {
        props: ['statement'],
        data(){
            return {
                sales_data: [],
                columns: ['created_at', 'user.full_name', 'course.title', 'coupon.code', 'amount', 'author_earning'],
                options: {
                    perPage: 10,
                    filterable: false,
                    headings: {
                        'created_at': this.trans('strings.date'),
                        'user.full_name': this.trans('strings.customer_name'),
                        'course.title': this.trans('strings.course'),
                        'coupon.code': this.trans('strings.coupon_code'),
                        'amount': this.trans('strings.price_paid'),
                        'author_earning': this.trans('strings.your_revenue')
                    },
                    templates: {
                        created_at(h, row) {
                          return moment(row.created_at).format("MMM DD 'YY");
                        },
                        amount(h, row) {
                            return this.formatCurrency(row.amount, false)
                        },
                        author_earning(h, row) {
                            return this.formatCurrency(row.author_earning, false)
                        }
                    }
                }
            }  
        },
        
        methods: {
            async fetchStatementDetails(){
                await axios.get(`/api/statements/${this.statement}`)
                    .then(response => {
                        this.sales_data = response.data.purchases
                    })
            }
        },
        
        created(){
            this.fetchStatementDetails()
        }
        
        
    }
    
</script>
