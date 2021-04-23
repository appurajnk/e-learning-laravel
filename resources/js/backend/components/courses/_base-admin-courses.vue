<template>
    <v-server-table 
        @loaded="loading=false"
        name="coursesTable"
        url="/api/admin/courses"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <div slot="afterFilter" class="ml-3">
            <div class="custom-control custom-checkbox mr-sm-2">
                <input type="checkbox" value="1" v-model="pendingOnly" class="custom-control-input" id="pendingOnly" @change="refreshTable()">
                <label class="custom-control-label" for="pendingOnly">
                    {{ trans('strings.pending_admin_approval') }}
                </label>
            </div>
        </div>
        <div slot="afterFilter" class="ml-3 d-flex">
            <select class="form-control mr-sm-2" id="filterCategory" v-model="filteredCategory" @change="refreshTable()">
                <option value>{{ trans('strings.all_categories') }}</option>
                <option v-for="cat in subcategories" :value="cat.id" :key="cat.id">{{ cat.name }}</option>
            </select>
        </div>
        
        <template slot="cover_image" slot-scope="props">
            <div class="d-flex">
                <div>
                    <img :src="props.row.images.thumbnail" width="100" class="rounded shadow-sm mr-2" />
                </div>
            </div>
        </template>
        <template slot="details" slot-scope="props">
            <a :href="`/admin/courses/${props.row.uuid}`" class="btn btn-outline-info btn-sm font-13"> 
                {{ trans('strings.details') }}
            </a>
        </template>
    </v-server-table>
</template>


<script>
    import axios from 'axios'
    export default {
        props: ['subcategories'],
        data(){
            const vm = this
            return {
                loading: true,
                pendingOnly: 0,
                filteredCategory: '',
                columns: ['cover_image', 'title', 'category.name', 'author.full_name', 'approved', 'price', 'created_at', 'details'],
                
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
                            limit: data.limit,
                            pendingOnly: vm.pendingOnly,
                            category: vm.filteredCategory
                        }
                    },
                    responseAdapter({data}) {
                        return {
                            data: data.data,
                            count: data.meta.total
                        }
                    },
                    highlightMatches: true,
                    filterable: ['title'],
                    headings: {
                        'cover_image': '',
                        'title': '',
                        'author.full_name': this.trans('strings.instructor'),
                        'category.name': this.trans('strings.category'),
                        'approved': this.trans('strings.status'),
                        'price': this.trans('strings.price'),
                        'details': '',
                        'created_at': this.trans('strings.created_at')
                    },
                    sortable:['title', 'approved', 'created_at', 'category.name', 'author.full_name', 'price'],
                    texts:{
                        filter: "",
                        limit: ""
                    },
                    templates: {
                        approved(h, row) {
                            return this.trans(`strings.${row.status_code}`)
                        },
                        price(h, row) {
                          return '$'+row.price;
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
