<script>
import Form from 'vform'
import { setTimeout } from 'timers';
export default {
    data(){
        return {
            connection_success: false,
            loading: true,
            form: new Form({
                db_host: 'localhost',
                db_name: '',
                db_user: '',
                db_password: '',
                db_port: 3306
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/installer/database`)
                .then(response => {
                    this.connection_success = true
                }).catch(err => {
                    const error = err.response.data
                    if(error.connection_error){
                        this.form.errors.set('db_host', error.connection_error)
                    } 
                })
        },

        async getDBInfo(){
            this.loading = await true
            axios.get(`/api/installer/database`)
                .then(response => {
                    this.form.fill(response.data)
                    this.loading = false
                })
        }
    },

    beforeMount(){
        this.getDBInfo()
    }
}
</script>