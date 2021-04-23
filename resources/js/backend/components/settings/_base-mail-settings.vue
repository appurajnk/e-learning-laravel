<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8">
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.mail_provider') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.mail_driver') }}</label>
                        <div class="col-md-8">
                            <select v-model="form.driver" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('driver') }">
                                <option value="smtp">SMTP</option>
                                <option value="sendmail">SendMail</option>
                                <option value="ses">SES</option>
                                <option value="sparkpost">SparkPost</option>
                                <option value="mailgun">Mailgun</option>
                                <option value="postmark">PostMark</option>
                            </select>
                            <has-error :form="form" field="driver"></has-error>
                        </div>
                    </div>

                    <!-- Mailgun -->
                    <template v-if="form.driver == 'mailgun'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.mailgun_domain') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.mailgun_domain" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('mailgun_domain') }">
                                    <has-error :form="form" field="mailgun_domain"></has-error>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.mailgun_secret') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.mailgun_secret" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('mailgun_secret') }">
                                    <has-error :form="form" field="mailgun_secret"></has-error>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.mailgun_endpoint') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.mailgun_endpoint" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('mailgun_endpoint') }">
                                    <has-error :form="form" field="mailgun_endpoint"></has-error>
                            </div>
                        </div>
                    </template>

                    <!-- Postmark -->
                    <template v-if="form.driver == 'sparkpost'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.postmark_token') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.postmark_token" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('postmark_token') }">
                                    <has-error :form="form" field="postmark_token"></has-error>
                            </div>
                        </div>
                    </template>

                    <!-- Sparkpost -->
                    <template v-if="form.driver == 'sparkpost'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.sparkpost_secret') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.sparkpost_secret" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('sparkpost_secret') }">
                                    <has-error :form="form" field="sparkpost_secret"></has-error>
                            </div>
                        </div>
                    </template>

                    <!-- SENDMAIL -->
                    <template v-if="form.driver == 'sendmail'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.sendmail_path') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.sendmail_path" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('sendmail_path') }">
                                    <has-error :form="form" field="sendmail_path"></has-error>
                            </div>
                        </div>
                    </template>

                    <!-- SES -->
                    <template v-if="form.driver == 'ses'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.ses_key') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.ses_key" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('ses_key') }">
                                    <has-error :form="form" field="ses_key"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.ses_secret') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.ses_secret" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('ses_secret') }">
                                    <has-error :form="form" field="ses_secret"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.ses_region') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.ses_region" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('ses_region') }">
                                    <has-error :form="form" field="ses_region"></has-error>
                            </div>
                        </div>
                    </template>

                    <!-- SMTP -->
                    <template v-if="form.driver == 'smtp'">
                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.smtp_host') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.smtp_host" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('smtp_host') }">
                                    <has-error :form="form" field="smtp_host"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.smtp_port') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.smtp_port" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('smtp_port') }">
                                    <has-error :form="form" field="smtp_port"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.smtp_username') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.smtp_username" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('smtp_username') }">
                                    <has-error :form="form" field="smtp_username"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.smtp_password') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.smtp_password" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('smtp_password') }">
                                    <has-error :form="form" field="smtp_password"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.smtp_encryption') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.smtp_encryption" class="form-control form-control-sm" 
                                    :class="{ 'is-invalid': form.errors.has('smtp_encryption') }">
                                    <has-error :form="form" field="smtp_encryption"></has-error>
                            </div>
                        </div>
                    </template>
                </fieldset>

                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.mail_settings') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.from_address') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.from_address" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('from_address') }">
                                <has-error :form="form" field="from_address"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.from_name') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.from_name" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('from_name') }">
                                <has-error :form="form" field="from_name"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.mailing_address') }}</label>
                        <div class="col-md-8 ">
                            <textarea v-model="form.mailing_address" class="form-control" :class="{ 'is-invalid': form.errors.has('mailing_address') }"></textarea>
                            <has-error :form="form" field="mailing_address"></has-error>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- RIGHT -->
            <div class="col-md-4"></div>

            <div class="col-md-6">
                <base-button :loading="form.busy" class="btn btn-lg rounded-0 btn-success"> 
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </div>
    </form>
</template>

<script>
import Form from 'vform'
export default {
    data(){
        return {
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
            this.form.post(`/api/admin/settings/mail`)
        },

        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.mail
                    if(settings !== undefined){
                        for(const key of this.form.keys()){
                            if(window.config.demo_mode==1 && key !== 'driver'){
                                this.form[key] = await 'xxxxxxx-DEMO-MODE-xxxxxxx'
                            } else {
                                this.form[key] = await settings[key] || this.form[key]
                            }
                        }
                    }
                })
        }
    },

    beforeMount(){
        this.fetchSettings()
    }
}
</script>
