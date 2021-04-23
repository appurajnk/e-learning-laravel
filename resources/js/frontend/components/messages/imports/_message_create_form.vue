<template>
    <textarea @keydown="handleMessageInput" v-autosize="form.message"
        v-model="form.message" class="form-control rounded-0 border-0 font-13 fw-300" :placeholder="trans('strings.type_and_hit_enter')"></textarea>
</template>

<script>
    
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    import ScrollToTop from '../mixins/ScrollToTop'
    
    export default {
        mixins: [ScrollToTop],
        data(){
            return {
                form: new Form({
                    message: ''
                })
            }
        },
        
        computed:{
            ...mapGetters({
                conversation: 'messages/selected_conversation'
            })
        },

        
        methods: {
            handleMessageInput(e){
                if($.trim(this.form.message).length == 0) return;
                if(e.keyCode == 13 && !e.shiftKey){
                    e.preventDefault();
                    this.send();
                    setTimeout(()=>{
                        this.scrollToTop();
                    }, 1000)
                    
                }
            },
            
            send(){
                this.form.post(`/api/conversations/${this.conversation.id}/messages`)
                    .then(response => {
                        this.form.reset()
                        this.$store.commit('messages/SET_MESSAGES', response.data)
                    })
            }
        }
    }
    
</script>