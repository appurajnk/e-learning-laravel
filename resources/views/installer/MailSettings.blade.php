@extends('frontend.layouts.install')

@section('content')
<base-installer-mail-settings inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card border border-secondary ">
            <div class="card-header bg-white py-4">
                <h2 class="h2 m-0">@lang('install.mail_settings')</h2>
            </div>
            <div class="card-body" style="min-height: 50vh;">
                <p>
                @lang('install.mail_settings_exp')
                </p>
                <hr />
                <alert-error :form="form" :message="form.errors.get('message')"></alert-error>
                <alert-success :form="form" message="Mail settings successfully saved"></alert-success>
                
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.mail_driver')
                    </label>
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
                        <label class="col-md-4 form-control-label">@lang('install.mailgun_domain')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.mailgun_domain" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('mailgun_domain') }">
                                <has-error :form="form" field="mailgun_domain"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.mailgun_secret')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.mailgun_secret" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('mailgun_secret') }">
                                <has-error :form="form" field="mailgun_secret"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.mailgun_endpoint')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.mailgun_endpoint" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('mailgun_endpoint') }">
                                <has-error :form="form" field="mailgun_endpoint"></has-error>
                        </div>
                    </div>
                </template>

                <!-- Postmark -->
                <template v-if="form.driver == 'postmark'">
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.postmark_token')</label>
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
                        <label class="col-md-4 form-control-label">@lang('install.sparkpost_secret')</label>
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
                        <label class="col-md-4 form-control-label">@lang('install.sendmail_path')</label>
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
                        <label class="col-md-4 form-control-label">@lang('install.ses_key')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.ses_key" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('ses_key') }">
                                <has-error :form="form" field="ses_key"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.ses_secret')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.ses_secret" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('ses_secret') }">
                                <has-error :form="form" field="ses_secret"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.ses_region')</label>
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
                        <label class="col-md-4 form-control-label">@lang('install.smtp_host')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.smtp_host" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('smtp_host') }">
                                <has-error :form="form" field="smtp_host"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.smtp_port')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.smtp_port" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('smtp_port') }">
                                <has-error :form="form" field="smtp_port"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.smtp_username')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.smtp_username" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('smtp_username') }">
                                <has-error :form="form" field="smtp_username"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.smtp_password')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.smtp_password" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('smtp_password') }">
                                <has-error :form="form" field="smtp_password"></has-error>
                        </div>
                    </div>

                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">@lang('install.smtp_encryption')</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.smtp_encryption" class="form-control form-control-sm" 
                                :class="{ 'is-invalid': form.errors.has('smtp_encryption') }">
                                <has-error :form="form" field="smtp_encryption"></has-error>
                        </div>
                    </div>
                </template>

                <div class="form-group row mb-1">
                    <label class="col-md-4 form-control-label">@lang('install.mail_from_address')</label>
                    <div class="col-md-8">
                        <input type="text" v-model="form.from_address" class="form-control form-control-sm" 
                            :class="{ 'is-invalid': form.errors.has('from_address') }">
                            <has-error :form="form" field="from_address"></has-error>
                    </div>
                </div>

                <div class="form-group row mb-1">
                    <label class="col-md-4 form-control-label">@lang('install.mail_from_name')</label>
                    <div class="col-md-8">
                        <input type="text" v-model="form.from_name" class="form-control form-control-sm" 
                            :class="{ 'is-invalid': form.errors.has('from_name') }">
                            <has-error :form="form" field="from_name"></has-error>
                    </div>
                </div>

            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <a href="{{ route('frontend.installer.finish') }}" class="btn btn-info btn-sm rounded-0" v-if="!form.busy && success">
                @lang('install.next')
                </a>
                <base-button :disabled="form.busy" class="btn btn-danger btn-sm rounded-0" v-else>
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        @lang('install.busy_wait')
                    </span>
                    <span v-else>
                    @lang('install.save')
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-mail-settings>
@endsection
