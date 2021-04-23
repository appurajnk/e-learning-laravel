<template>
    <div>
        <v-server-table 
            v-if="url" 
            name="couponsTable"
            :url="url"
            class="font-13"
            :columns="columns" 
            ref="datatable"
            :options="options">
            
            <!-- <template slot="child_row" slot-scope="props">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" :value="props.row.link">
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary rounded-0" 
                            @click="CopyLink(props.row.link)" type="button">
                            {{ trans('strings.copy_to_clipboard') }}
                        </button>
                    </div>
                </div>
                <div class="text-success" v-if="copiedId==props.row.id">
                    {{ trans('strings.link_copied') }}
                </div>
            </template> -->
            <template slot="status" slot-scope="props">
                <el-switch
                    :value="props.row.active"
                    active-color="#13ce66"
                    @change="ToggleActive(props.row.id)">
                </el-switch>
            </template>
        </v-server-table>
    </div>
</template>

<script>
    import axios from 'axios'
    export default {
        name: 'CouponDataTable',
        props: ['course'],
        data: () => ({
            url: '',
            copiedId: null,
            columns: ['code', 'expires', 'quantity', 'totalUsed', 'status'],
            options: {
                perPage:4,
                perPageValues:[4,10,25,50,100],
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
                filterable: ['code'],
                headings: {
                    code: '',
                    expires: '',
                    quantity: '',
                    totalUsed: ''
                },
                filterByColumn:false,
                sendEmptyFilters: false,
                pagination: { 
                    chunk:2, 
                    dropdown: false,
                    edge: false
                },
                skin: 'table table-md table-bordered',
                sortIcon: {
                    base:'fa', 
                    up:'fa-long-arrow-up', 
                    down:'fa-long-arrow-down', 
                    is:'fa-sort' 
                },
                sortable:['code', 'quantity'],
                childRow: false,
                childRowTogglerFirst:false,
                columnsDropdown: false,
                texts:{
                    filter: "",
                    limit: ""
                }
            }
        }),
        
        methods: {
            ToggleActive(id){
                axios.put(`/api/coupons/${id}/activate`)
                    .then(() => {
                        this.$refs.datatable.refresh()
                    })
            },
            
            CopyLink(link){
                this.$copyText(link).then(e => {
                    alert('Copied')
                }, e => {
                  alert('Cannot copy')
                })
            }
            
        },
        
        mounted(){
            this.url = `/api/coupons/findByCourse/${this.course.id}`
            this.$bus.$on('createCoupon:completed', () => {
                this.$refs.datatable.refresh()
            })
            
            this.options.headings.code = this.trans('strings.code'),
            this.options.headings.expires = this.trans('strings.expires'),
            this.options.headings.quantity = this.trans('strings.quantity'),
            this.options.headings.totalUsed = this.trans('strings.total_used')

        }
        
        
    }
</script>
