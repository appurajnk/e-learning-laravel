<template>
  <li :class="`msg-${direction} float-${direction}`">
    <div :class="`msg-${direction}-sub`">
      <img :src="message.sender.picture" class="rounded-circle" alt="">
      <div class="msg-desc font-14 fw-300">
        {{ message.body }}  
      </div>
      <small class="font-12 fw-300">
        {{ message.sender.full_name }}
        <i class="fa fa-clock-o"></i> {{ message.created_at  }}
      </small>
    </div>
  </li>
</template>

<script>
    import { mapGetters } from 'vuex'
    export default{
      props: ['user', 'message', 'direction'],
      
      computed: {
        ...mapGetters({
          selected_conversation: 'messages/selected_conversation'
        })
      }
    }
    
</script>