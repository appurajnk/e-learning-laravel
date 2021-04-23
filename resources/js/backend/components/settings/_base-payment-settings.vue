<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8">
                <!-- Gateways -->
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.payment_gateways') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-5 form-control-label">{{ trans('strings.enable_paypal_payment') }}</label>
                        <div class="col-md-7">
                            <div class="form-group rowx mb-1">
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                    <input id="enable_paypal" name="enable_paypal" :value="true" v-model="form.enable_paypal" 
                                        class="custom-control-input rounded-0" 
                                        type="checkbox">
                                    <label class="custom-control-label" for="enable_paypal">
                                        {{ trans('strings.yes') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="form-group row mb-1">
                        <label class="col-md-5 form-control-label">{{ trans('strings.enable_credit_card') }}</label>
                        <div class="col-md-7">
                            <div class="form-group rowx mb-1">
                                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                    <input id="enable_credit_card" name="enable_credit_card" :value="true" v-model="form.enable_credit_card" 
                                        class="custom-control-input rounded-0" 
                                        type="checkbox">
                                    <label class="custom-control-label" for="enable_credit_card">
                                        {{ trans('strings.yes') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <template v-if="form.enable_credit_card">
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.credit_card_processor') }}</label>
                            <div class="col-md-7">
                                <select v-model="form.credit_card_processor" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('credit_card_processor') }">
                                    <option value="stripe">Stripe</option>
                                    <option value="razorpay">RazorPay</option>
                                </select>
                                <has-error :form="form" field="credit_card_processor"></has-error>
                            </div>
                        </div>
                    </template>
                </fieldset>

                <!-- PAYPAL SETTINGS -->
                <template v-if="form.enable_paypal">
                    <fieldset>
                        <legend class="scheduler-border">{{ trans('strings.paypal_settings') }}</legend>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">{{ trans('strings.paypal_mode') }}</label>
                            <div class="col-md-7">
                                <el-switch
                                    style="display: block"
                                    v-model="form.paypal_mode"
                                    active-color="#13ce66"
                                    inactive-color="#ff4949"
                                    :active-text="trans('strings.live')"
                                    :inactive-text="trans('strings.sandbox')"
                                    active-value="live"
                                    inactive-value="sandbox">
                                </el-switch>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">
                                {{ trans('strings.paypal_sandbox_client_id') }}
                            </label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_sandbox_client_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_sandbox_client_id') }">
                                <has-error :form="form" field="paypal_sandbox_client_id"></has-error>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">
                                {{ trans('strings.paypal_sandbox_secret') }}
                            </label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_sandbox_secret" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_sandbox_secret') }">
                                <has-error :form="form" field="paypal_sandbox_secret"></has-error>
                            </div>
                        </div>

                        <hr />
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">
                                {{ trans('strings.paypal_live_client_id') }}
                            </label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_live_client_id" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_live_client_id') }">
                                <has-error :form="form" field="paypal_live_client_id"></has-error>
                            </div>
                        </div>
                        <div class="form-group row mb-1">
                            <label class="col-md-5 form-control-label">
                                {{ trans('strings.paypal_live_secret') }}
                            </label>
                            <div class="col-md-7">
                                <input type="text" v-model="form.paypal_live_secret" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('paypal_live_secret') }">
                                <has-error :form="form" field="paypal_live_secret"></has-error>
                            </div>
                        </div>
                    </fieldset>
                </template>

                <template v-if="form.enable_credit_card">
                    <!-- Stripe Settings -->
                    <template v-if="form.credit_card_processor == 'stripe'">
                        <fieldset>
                            <legend class="scheduler-border">{{ trans('strings.stripe_settings') }}</legend>
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.stripe_mode') }}</label>
                                <div class="col-md-7">
                                    <el-switch
                                        style="display: block"
                                        v-model="form.stripe_mode"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        :active-text="trans('strings.live')"
                                        :inactive-text="trans('strings.sandbox')"
                                        active-value="live"
                                        inactive-value="sandbox">
                                    </el-switch>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.stripe_sandbox_public_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.stripe_sandbox_public_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('stripe_sandbox_public_key') }">
                                    <has-error :form="form" field="stripe_sandbox_public_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.stripe_sandbox_secret_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.stripe_sandbox_secret_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('stripe_sandbox_secret_key') }">
                                    <has-error :form="form" field="stripe_sandbox_secret_key"></has-error>
                                </div>
                            </div>

                            <hr />
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.stripe_live_public_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.stripe_live_public_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('stripe_live_public_key') }">
                                    <has-error :form="form" field="stripe_live_public_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.stripe_live_secret_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.stripe_live_secret_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('stripe_live_secret_key') }">
                                    <has-error :form="form" field="stripe_live_secret_key"></has-error>
                                </div>
                            </div>
                        </fieldset>
                    </template>

                    <template v-if="form.credit_card_processor == 'razorpay'">
                        <!-- Razorpay Settings -->
                        <fieldset>
                            <legend class="scheduler-border">{{ trans('strings.razorpay_settings') }}</legend>
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_mode') }}</label>
                                <div class="col-md-7">
                                    <el-switch
                                        style="display: block"
                                        v-model="form.razorpay_mode"
                                        active-color="#13ce66"
                                        inactive-color="#ff4949"
                                        :active-text="trans('strings.live')"
                                        :inactive-text="trans('strings.sandbox')"
                                        active-value="live"
                                        inactive-value="sandbox">
                                    </el-switch>
                                </div>
                            </div>
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_sandbox_public_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.razorpay_sandbox_public_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('razorpay_sandbox_public_key') }">
                                    <has-error :form="form" field="razorpay_sandbox_public_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_sandbox_secret_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.razorpay_sandbox_secret_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('razorpay_sandbox_secret_key') }">
                                    <has-error :form="form" field="razorpay_sandbox_secret_key"></has-error>
                                </div>
                            </div>

                            <hr />
                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_live_public_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.razorpay_live_public_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('razorpay_live_public_key') }">
                                    <has-error :form="form" field="razorpay_live_public_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-5 form-control-label">{{ trans('strings.razorpay_live_secret_key') }}</label>
                                <div class="col-md-7">
                                    <input type="text" v-model="form.razorpay_live_secret_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('razorpay_live_secret_key') }">
                                    <has-error :form="form" field="razorpay_live_secret_key"></has-error>
                                </div>
                            </div>
                        </fieldset>
                    </template>
                </template>

            </div>

            <!-- RIGHT -->
            <div class="col-md-6"></div>

            <div class="col-md-12">
                <base-button :loading="form.busy" class="btn rounded-0 btn-lg btn-success">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </div>
    </form>
</template>

<script>
import axios from 'axios'
import Form from 'vform'
export default {
    data(){
        return {
            form: new Form({
                enable_paypal: false,
                enable_credit_card: false,
                credit_card_processor: 'stripe',

                paypal_mode: 'sandbox',
                paypal_sandbox_client_id: '',
                paypal_sandbox_secret: '',
                paypal_live_client_id: '',
                paypal_live_secret: '',
                
                stripe_mode: 'sandbox',
                stripe_sandbox_public_key: '',
                stripe_sandbox_secret_key: '',
                stripe_live_public_key: '',
                stripe_live_secret_key: '',

                razorpay_mode: 'sandbox',
                razorpay_sandbox_public_key: '',
                razorpay_sandbox_secret_key: '',
                razorpay_live_public_key: '',
                razorpay_live_secret_key: ''
            })
        }
    },
    methods:{
        submit(){
            this.form.post(`/api/admin/settings/payment`)
                .then(res => {
                    this.settings = res.data.payments
                }).catch(err => {
                    //console.log(this.form)
                })
            
        },
        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.payments

                    for(const key of this.form.keys()){
                        if(window.config.demo_mode==1 && !['enable_paypal', 'enable_credit_card', 'credit_card_processor', 'paypal_mode', 'stripe_mode', 'razorpay_mode'].includes(key)){
                            this.form[key] = await 'xxxxxxx-DEMO-MODE-xxxxxxx'
                        } else {
                            if(settings[key] && parseInt(settings[key])==1) settings[key] = await true
                            if(settings[key] && parseInt(settings[key])==0) settings[key] = await false
                            this.form[key] = await settings[key] || this.form[key]
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
