<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8">
                <fieldset>
                    <div class="alert alert-warning p-2">
                        <h4 class="text-darkx mb-0 font-weight-light">{{ trans('strings.important') }}</h4>
                        <p class="font-13 text-darkx mb-0">{{ trans('strings.license_information_explanation') }}</p>
                    </div>

                    <legend class="scheduler-border">{{ trans('strings.license_information') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.purchase_code') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.purchase_code" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('purchase_code') }">
                            <has-error :form="form" field="purchase_code"></has-error>
                        </div>
                    </div>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.envato_username') }}</label>
                        <div class="col-md-8">
                            <input type="text" v-model="form.envato_username" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('envato_username') }">
                            <has-error :form="form" field="envato_username"></has-error>
                        </div>
                    </div>
                </fieldset>
            </div>

            <!-- RIGHT -->
            <div class="col-md-4"></div>

            <div class="col-md-12">
                <base-button :loading="form.busy" class="btn btn-lg rounded-0 btn-success">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>

        </div>
    </form>
</template>

<script>
import AvatarCropper from "vue-avatar-cropper"
import Form from 'vform'
export default {
    components: {
        AvatarCropper
    },

    data(){
        return {
            form: new Form({
                purchase_code: '',
                envato_username: '',
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/admin/settings/site`)
        },

        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.site
                    if(settings !== undefined){
                        for(const key of this.form.keys()){
                            if(window.config.demo_mode==1){
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