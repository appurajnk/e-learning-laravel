<template>
    <div class="card shadow-sm mb-3">
        <div class="card-header bg-white d-flex">
            <div class="mr-3">
                <img :src="question.course.thumbnail" width="80" />
            </div>
            <div>
                <a :href="`/course/${question.course.slug}/learn/v1/overview`"
                    class="mb-2">
                    {{ question.course.title }}
                </a>
            </div>
        </div>
        <div class="card-body d-flex">
            <div class="mr-3 d-flex flex-column">
                <div class="mx-auto">
                    <img :src="question.user.picture" width="40" class="rounded-circle" />
                </div>
            </div>
            
            <div class="flex-grow-1">
                <div class="font-13 mb-2">
                    <a href="#">
                        {{ question.user.full_name }}
                    </a>
                    <span class="text-muted font-12">{{ question.timeago }}</span>
                </div>
                <div class="fw-600 font-14 mb-2">
                    {{ question.title }}
                </div>
                
                <div class="review__body mb-2" v-html="question.body"></div>
                
                <hr />
                
                <!-- START COMMENTS -->
                <base-comments model="\App\Models\Question" :model_id="question.id" :user="user"></base-comments>
               
                <!--/ END COMMENTS -->
                
            </div>
            
            
        </div>
    </div>
</template>
<script>
    
    import Form from 'vform'
    
    export default {
        name: 'AuthorQuestion',
        props: ['question', 'model', 'user'],
        
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
            this.$watch('question', question => {
                
            });
        }
        
    }
    
</script>