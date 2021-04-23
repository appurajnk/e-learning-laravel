<script>
import Form from 'vform'
export default {
    data(){
        return {
            success: false,
            form: new Form({
                site_name: '',
                first_name: '',
                last_name: '',
                username: '',
                email: '',
                password: '',
                password_confirmation: ''
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/installer/settings`)
                .then(response => {
                    this.success = true
                    window.location.href="/install/mail-settings"
                }).catch(err => {
                    // console.log(this.form.errors.flatten())
                    //const error = err.response.data
                    // if(error.connection_error){
                    //     this.form.errors.set('site_name', error.connection_error)
                    // }
                    // if(this.form.) {
                    //     this.form.errors.set('database_error', error.database_error)
                    // }
                    // console.log("Issues")
                    // console.log(this.form)
                })
        }
    }
}
</script>