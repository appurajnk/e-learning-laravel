<template>
    <div>
        <vue-element-loading :active="loading" background-color="#FFFFFF"  :is-full-screen="false" spinner="bar-fade-scale"/>
        <transition name="slidedown">
            <template v-if="creating">
                <inc-create-coupon-form />
            </template>
        </transition>
        
        <v-server-table 
            @loaded="loading=false"
            name="couponsTable"
            :url="url"
            :columns="columns" 
            ref="datatable"
            :options="options">
            
            <div slot="afterLimit" class="text-right">
                <button class="btn btn-sm btn-success" @click="creating=true"> 
                    <i class="fa fa-plus-circle"></i> {{ trans('strings.create') }}
                </button>
            </div>
            <toggle-button 
                :value="props.row.active" 
                slot="status" 
                slot-scope="props"
                :sync="true"
                :id="props.row.id"
                @change="ToggleActive(props.row.id)"/>
        </v-server-table>
    </div>
</template>

<script>
import IncCreateCouponForm from './imports/_coupon_create_form'
export default {
    data(){
        return {
            creating: false,
            loading: true,
            url: `/api/admin/coupons`,
            creating: false,
            columns: ['code', 'expires', 'quantity', 'totalUsed', 'status'],
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
                        sort: data.orderBy ? data.orderBy : 'active',
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
                filterable: ['code'],
                headings: {
                    code: '',
                    expires: '',
                    quantity: '',
                    status: ''
                },
                sortable:['code', 'quantity'],
                texts:{
                    filter: "",
                    limit: ""
                }
            }
        }
    },
    
    components:{
        IncCreateCouponForm
    },

    methods: {
        ToggleActive(id){
            axios.put(`/api/coupons/${id}/activate`)
        }
    },
    
    mounted(){
        this.$bus.$on('createCoupon:completed', () => {
            this.$refs.datatable.refresh()
            this.creating = false
        })
        .$on('createCoupon:cancelled', () => {
            this.creating = false
        })
        
        this.options.headings.code = this.trans('strings.code')
        this.options.headings.expires = this.trans('strings.expires')
        this.options.headings.quantity = this.trans('strings.quantity')
        this.options.headings.totalUsed = this.trans('strings.total_used')
    }

}
</script>
