<template>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="trans('strings.info_updated')"/>
        <div class="row">
            <div class="col-md-8">
                <div class="alert alert-info d-flex">
                    <i class="fab fa-cc-paypal fa-2x mr-2"></i>
                    <p class="font-13">
                        Your payments will be processed through PayPal. Please provide your PayPal email else your payouts will not be processed.
                    </p>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label class="col-form-label">{{ trans('strings.paypal_email') }}</label>
                    <input v-model="form.paypal_email" autocomplete="OFF" :class="{ 'is-invalid': form.errors.has('paypal_email') }" class="form-control" type="text" name="paypal_email">
                    <has-error :form="form" field="paypal_email"/>
                </div>
                <button :disabled="form.busy" :class="{ 'btn-loading': form.busy }" class="btn btn-danger btn-md rounded-0">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </button>
            </div><!--/ END RIGHT SIDE -->
        
        
        
        </div>
    </form>
</template>

<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    export default {
        props:['settings'],
        data(){
            return {
                form: new Form({
                    payout_method: 'paypal',
                    paypal_email: ''
                }),
            }
        },
        
        methods: {
            update(){
                this.form.put(`/api/settings/payout`)
            }
        },

        mounted(){
            this.form.paypal_email = this.settings.paypal_email || ''
        }
    }
</script>
