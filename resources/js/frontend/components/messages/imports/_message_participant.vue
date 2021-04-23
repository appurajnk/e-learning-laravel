<template>
    <li class="clearfix" :class="{ 'bg-lightgrey': conversation.id == selected_conversation.id }">
      <!--
      <div class="custom-control custom-checkbox mr-sm-2">
        <input type="checkbox" class="custom-control-input" id="messageDe2">
        <label class="custom-control-label" for="messageDe2"></label>
      </div>-->
      <a href="#" @click.prevent="fetchConversationMessages">
        <div class="chat-list-img float-left">
          <img :src="conversation.recipient.picture" class="rounded-circle">
        </div>
        <div class="chat-list-meta">
          <div class="chat-list-date font-12 fw-300">{{ conversation.last_message.created_at }}</div>
          <div class="chat-list-title font-14 fw-600">{{ conversation.recipient.full_name }}</div>
          <div class="chat-list-des font-12 fw-400">
            {{ conversation.last_message.body | truncate(35) }}
          </div>
        </div>
      </a>
    </li>
</template>

<script>
    import { mapGetters } from 'vuex'
    import ScrollToTop from '../mixins/ScrollToTop'
    export default{
        mixins: [ScrollToTop],
        props: ['conversation'],
        
        computed: {
          ...mapGetters({
            selected_conversation: 'messages/selected_conversation',
            loading: 'messages/loading'
          })
        },
        
        methods: {
          fetchConversationMessages(){
            this.$store.dispatch('messages/fetchConversationMessages', this.conversation)
            setTimeout(() => {
                this.scrollToTop()
            }, 1000)
          }
        }
    }
    
</script>