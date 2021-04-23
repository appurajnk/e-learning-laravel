<template>
    <div class="card shadow-sm mb-3">
        <div class="card-body d-flex">
            <div class="mr-3 d-flex flex-column">
                <div class="mx-auto">
                    <img :src="announcement.user.picture" width="40" class="rounded-circle" />
                </div>
            </div>
            
            <div class="flex-grow-1">
                <div class="font-13 mb-2">
                    <a href="#">
                        {{ announcement.user.full_name }}
                    </a>
                    <span class="text-muted font-12">{{ announcement.created_at }}</span>
                </div>
                <div class="fw-600 font-14 mb-2">
                    {{ announcement.title }}
                </div>
                
                <div class="review__body mb-2" v-html="announcement.body"></div>
                
                <hr />
                
                <!-- START COMMENTS -->
                <base-comments
                    :show_mark_as_answer="false"
                    model="\App\Models\Announcement" 
                    :model_id="announcement.id" 
                    :user="user"></base-comments>
               
                <!--/ END COMMENTS -->
                
            </div>
            
            
        </div>
    </div>
</template>
<script>
    
    import Form from 'vform'
    
    export default {
        name: 'AnnouncementShow',
        props: ['announcement', 'model', 'user'],
        
        data(){
            return {
                responding: false,
                action: 'create',
                form: new Form({
                    body: '',
                    model: '',
                    model_id: ''
                })
                
            }
        },
        
        mounted() {
            this.$watch('announcement', announcement => {});
        }
    }
    
</script>