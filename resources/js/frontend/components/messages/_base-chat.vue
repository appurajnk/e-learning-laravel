<template>
    <div>
        <div class="bg-white">
            <section class="chat-messaing">
                <div class="container">
                    <div class="row no-gutters shadow-sm border border-secondary">
                        <div class="col-md-4">
                            <div class="message-sidebar white-bg-color">
                                <div class="head-section border-right">
                                  <div class="row align-items-center">
                                    <div class="col-md-6 font-18 fw-500">
                                      <!-- <div class="custom-control custom-checkbox mr-sm-2">
                                        <input type="checkbox" class="custom-control-input" id="messageDel">
                                        <label class="custom-control-label" for="messageDel"></label>
                                      </div> -->
                                      <span class="pl-5x">{{ trans('strings.inbox') }}</span>
                                    </div>
                                    <div class="col-md-6 text-right">
                                      <!-- <a class="btn btn-primary primery-bg-color font-14 fw-500" href="#0" title="Compose">Compose</a> -->
                                    </div>
                                  </div>
                                </div>
                                <div class="chat-list-outer msg-content  border-right">
                                    <ul class="chat-list">
                                        <message-participant v-for="conversation in conversations" 
                                            :conversation="conversation" :key="conversation.id"></message-participant>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8">
                            <div class="right-message white-bg-color">
                                <div class="head-section" v-if="selected_conversation !== undefined && selected_conversation.recipient">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 head-title font-18 fw-500">
                                            {{ trans('strings.message_with') }}
                                          <a :href="`/user/${selected_conversation.recipient.username}`">
                                              {{ selected_conversation.recipient.full_name }}
                                          </a>
                                        </div>
                                    </div>
                                </div>
                                <div id="msg-content" class="message msg-content">
                                    
                                    <!-- Start Message Chat -->
                                    <template v-if="!loading">
                                        <ul>
                                            <chat-message v-for="message in messages" 
                                                :message="message"
                                                :user="user" 
                                                :direction="message.sender.id == selected_conversation.recipient.id ? 'left' : 'right'"
                                                :key="message.id"></chat-message>
                                            
                                        </ul>
                                    </template>
                                    <!-- End Message Chat -->
                                    <vue-element-loading :active="loading" :is-full-screen="false" 
                                            spinner="bar-fade-scale" color="#ea5352"></vue-element-loading>
                                </div>
                                
                                <div class="right-section-bottom p-0" v-if="Object.keys(selected_conversation).length > 0">
                                    <message-create-form></message-create-form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>    
</template>


<script>
    import { mapGetters } from 'vuex'
    import ScrollToTop from './mixins/ScrollToTop'
    import MessageCreateForm from './imports/_message_create_form'
    import MessageParticipant from './imports/_message_participant'
    import ChatMessage from './imports/_message'

    export default {
        props: ['user'],
        mixins: [ScrollToTop],
        components:{
            MessageCreateForm,
            MessageParticipant,
            ChatMessage
        },
        computed:{
            ...mapGetters({
                loading: 'messages/loading',
                conversations: 'messages/conversations',
                selected_conversation: 'messages/selected_conversation',
                messages: 'messages/messages'
            })    
        },
        methods: {
            async getUserConversations(){
                await this.$store.commit('messages/SET_LOADING', true)
                await this.$store.dispatch('messages/fetchUserConversations')
                this.$store.commit('messages/SET_LOADING', false)
                setTimeout(() => {
                    this.scrollToTop()
                }, 1000)
            }
        },
        
        mounted(){
            this.getUserConversations()
            setTimeout(() => {
                this.scrollToTop()
            }, 1000)
            
        }
        
    }
</script>