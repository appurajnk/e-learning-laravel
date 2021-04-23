<script>
import Form from 'vform'
export default {
    data(){
        return {
            form: new Form({
                import: true
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/installer/finish`)
                .then(response => {
                    window.location.href="/"
                }).catch(err => {
                    //
                })
        }
    },

    beforeMount(){
        
    }
}
</script>