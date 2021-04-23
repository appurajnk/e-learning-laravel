<script>
import Form from 'vform'
export default {
    data(){
        return {
            success: false,
            form: new Form({
                driver: 'smtp',
                sendmail_path: '/usr/sbin/sendmail -bs',
                mailgun_domain: '',
                mailgun_secret: '',
                mailgun_endpoint: '',
                postmark_token: '',
                sparkpost_secret: '',
                ses_key: '',
                ses_secret: '',
                ses_region: '',
                smtp_host: '',
                smtp_port: '',
                smtp_username: '',
                smtp_password: '',
                smtp_encryption: '',
                from_address: '',
                from_name: '',
                mailing_address: ''
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/installer/mail`)
                .then(response => {
                    this.success = true
                   window.location.href="/install/finish"
                }).catch(err => {
                    
                })
        }
    }
}
</script>