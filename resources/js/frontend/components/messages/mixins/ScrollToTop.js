export default {
    methods: {
        scrollToTop(){
            let element = document.getElementById("msg-content");
            element.scrollTop = element.scrollHeight;
        }
    }
  }