
<script>
import Form from 'vform'
export default {

    data(){
        return {
            messages: {},
            errors: 0,
            requirements: [],
            form: new Form({})
        }
    },

    methods:{
        checkRequirements(){
            this.form.post(`/api/installer/requirements`)
                .then(response => {
                    this.errors = response.data.errors
                    this.requirements = response.data.requirements
                    // if(response.data.errors > 0)this.message = 'Please fix the errors shown below and re-run the check'   
                    // if(response.data.errors == 0)this.message = 'Your server seems to meet the minimum requirements to run this application'   
                })
        }
    },

    beforeMount(){
        this.checkRequirements()
    }

}
</script>

<style>

</style>