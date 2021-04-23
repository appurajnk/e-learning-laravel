<template>
    <div class="container">
        <div class="row">
            <div class="col-md-9 mx-auto">
                <div v-if="announcements && announcements.data && announcements.data.length > 0">
                    <transition-group name="slidedown">
                        <inc-announcement v-for="announcement in announcements.data" 
                            :announcement="announcement" 
                            model="\App\Models\Announcement"
                            :user="user"
                            :key="announcement.id"></inc-announcement>
                    </transition-group>
                    <div class="d-block">
                        <pagination 
                            class="pagination-sm justify-content-endx text-info"
                            :data="announcements" 
                            @pagination-change-page="fetchAnnouncements" 
                            :show-disabled="true">
                            <span slot="prev-nav">
                                <i class="fas fa-angle-double-left"></i>
                            </span>
                            <span slot="next-nav">
                                <i class="fas fa-angle-double-right"></i>
                            </span>
                        </pagination>
                    </div> 
                </div>
                    
                <div class="text-center" v-else>
                    <p>{{ trans('strings.no_announcements') }}</p>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import Form from 'vform'
    import IncAnnouncement from './imports/_announcement'
    import { mapGetters } from 'vuex'
    export default {
        components: {
            IncAnnouncement
        },

        props: ['course', 'user'],

        data(){
            return {
                announcements: {},
                form: new Form({
                    orderBy: 'recent',
                    page: 1
                })
            }
        },
        
        computed: {
            ...mapGetters({
                loading: 'course/loading'
            })
        },
        
        methods: {
            fetchAnnouncements(page=1){
                this.form.page = page
                this.form.post(`/api/course/announcements/${this.course.uuid}`)
                    .then(response => {
                        this.announcements = response.data
                    })
            }
        },

        mounted(){
            this.fetchAnnouncements()
        }
        
    }
    
    
</script>
