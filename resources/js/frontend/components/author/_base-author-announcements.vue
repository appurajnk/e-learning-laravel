<template>
    <section class="course__list py-4">
        <div class="container">
            <div class="card border-secondary shadow-sm card-body" style="min-height: 60vh;">
                <template v-if="showCreate || showEdit">
                    <div class="row">
                        <div class="col-md-8 mx-auto">
                            <inc-announcement-form v-if="showCreate" 
                                :courses="courses"
                                :announcement="selected_for_edit"
                                :editing="false"></inc-announcement-form>

                            <inc-announcement-form v-if="showEdit && Object.keys(selected_for_edit).length > 0" 
                                :courses="courses"
                                :announcement="selected_for_edit"
                                :editing="true"></inc-announcement-form>
                        </div>
                    </div>
                </template>
                <template v-else>
                    <div class="row">
                        <div class="col-md-12" v-if="courses.length">
                            <button class="btn rounded-0 btn-sm btn-danger" @click.prevent="showCreate=true">
                                <i class="fa fa-plus-circle"></i> {{ trans('strings.compose') }}
                            </button>
                        </div>

                        <div class="col-md-12 mt-4">

                            <v-server-table v-if="url" 
                                name="announcementsTable"
                                :url="url"
                                :columns="columns" 
                                ref="datatable"
                                :options="options">
                                <template slot="title" slot-scope="props">
                                    <a href="#"> 
                                        {{ props.row.title }}    
                                    </a>
                                </template>
                                <template slot="courses" slot-scope="props">
                                    <span v-for="(course,index) in props.row.courses" :key="course.uuid">
                                        <span v-if="index > 0">, </span> {{ course.title }}
                                    </span>
                                </template>
                                <template slot="action" slot-scope="props">
                                    <a href="javascript:void(0)" class="text-danger mr-2" @click.prevent="destroy(props.row.uuid)"> 
                                        {{ trans('strings.delete') }} 
                                    </a>
                                    <button @click.prevent="edit(props.row)" class="btn btn-link">
                                        {{ trans('strings.edit') }}
                                    </button>
                                    <a :href="`/course/${props.row.courses[0].slug}/learn/v1/announcements`" target="_blank" class="text-info">
                                        {{ trans('strings.view') }}
                                    </a>
                                </template>
                            </v-server-table>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </section>
</template>


<script>
    import axios from 'axios'
    import IncAnnouncementForm from './imports/_announcement_create_form'
    export default {
        components: {
            IncAnnouncementForm
        },

        data(){
            return {
                selected_for_edit: {},
                showCreate: false,
                showEdit: false,
                courses: [],
                url: '/api/author_announcements',
                columns: ['title', 'created_at', 'courses', 'action'],
                options: {
                    requestFunction:  function (data) {
                        return axios.get(this.url, {
                            params: data
                        }).catch(function (e) {
                            this.dispatch('error', e);
                        }.bind(this));
                    },
                    headings: {
                        'title': this.trans('strings.announcement'),
                        'created_at': this.trans('strings.created'),
                        'courses': this.trans('strings.courses'),
                        'action': ''
                    },
                    sortable:['created_at', 'title'],
                    templates: {
                        created_at(h, row) {
                          return moment(row.created_at).format('MMM DD, YYYY');
                        }
                    }
                }
            }
        },

        methods: {
            async edit(payload){
                this.selected_for_edit = await payload
                this.showEdit = await true
            },

            destroy(uuid){
                this.$dialog.confirm({ title: this.trans('strings.confirm_delete') }, {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/announcements/${uuid}`)
                            .then(() => this.$refs.datatable.refresh())        
                    })
            },

            fetchAuthorCourses(){
                axios.post(`/api/author/courses?query=&orderBy=title_a-z`)
                    .then(response => {
                        this.courses = response.data.live;
                    })
            }
        },

        beforeMount(){
            this.fetchAuthorCourses()
        },

        mounted(){
            this.$bus.$on('create_announcement:cancelled', () => {
                this.showCreate = false
                this.showEdit = false
                this.selected_for_edit = {}
            })
            .$on('announcement:created', () => {
                this.showCreate = false
                this.showEdit = false
                this.selected_for_edit = {}
                if(this.$refs.datatable !== undefined){
                    this.$refs.datatable.refresh()
                }
            })
        }
        
        
    }
    
    
</script>
