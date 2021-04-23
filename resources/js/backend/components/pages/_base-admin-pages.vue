<template>
    <v-server-table 
        @loaded="loading=false"
        name="coursesTable"
        url="/api/admin/pages"
        :columns="columns" 
        ref="datatable"
        :options="options">
        <div slot="beforeLimit">
            <a href="/admin/page/new" class="btn btn-sm rounded-0 btn-success">
                {{ trans('strings.create') }}
            </a>
        </div>
        <template slot="langs" slot-scope="props">
            <span v-for="lang in props.row.langs" :key="lang">
                <img :src="`/flags/${lang}.svg`" height="20" class="mr-2 mb-1 border border-secondary" :title="lang"/>
            </span>
        </template>

        <template slot="details" slot-scope="props">
            <button @click.prevent="destroy(props.row.id)" class="btn text-danger btn-link btn-sm font-13"> 
                {{ trans('strings.delete') }}
            </button>
            <a :href="`/admin/pages/${props.row.uuid}`" class="btn btn-link btn-sm font-13"> 
                {{ trans('strings.edit') }}
            </a>
        </template>
    </v-server-table>
</template>


<script>
    import axios from 'axios'
    export default {
        data(){
            const vm = this
            return {
                loading: true,
                pendingOnly: 0,
                filteredCategory: '',
                columns: [`title.${window.config.locale}`, 'slug', 'langs', 'published', 'details'],
                
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
                    filterable: ['title'],
                    headings: {
                        'slug': this.trans('strings.slug'),
                        'langs': this.trans('strings.languages'),
                        'published': this.trans('strings.status')
                    },
                    sortable:['title', 'published'],
                    texts:{
                        filter: "",
                        limit: ""
                    },
                    templates: {
                        published(h,row){
                            return row.published ? this.trans('strings.live') : this.trans('strings.draft')
                        }
                    }
                }
            }
        },
        
        methods: {
            refreshTable(){
                this.$refs.datatable.refresh()
            },

            destroy(id){
                this.$dialog.confirm({ title: this.trans('strings.confirm_delete') }, {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/admin/pages/${id}`)
                            .then(() => this.refreshTable())        
                    })
            }
        },

        beforeMount(){
            this.options.headings[`title.${window.config.locale}`] = this.trans('strings.title')
        }
    }
    
    
</script>
