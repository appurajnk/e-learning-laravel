<template>
    <form @submit.prevent="submit">
        <div class="row">
            <div class="col-md-8">
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.queues') }}</legend>
                    <div class="form-group row mb-1">
                        <div class="col-md-12">
                            <div class="alert alert-primary p-2">
                                <h4 class="text-darkx mb-0 font-weight-light">
                                    <i class="fas fa-info-circle"></i> {{ trans('strings.info') }}</h4>
                                <p class="font-13 text-darkx mb-0">{{ trans('strings.queue_connection_explanation') }}</p>
                            </div>
                        </div>
                        <label class="col-md-4 form-control-label">{{ trans('strings.queue_connection') }}</label>
                        <div class="col-md-8">
                            <select v-model="form.queue_connection" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('queue_connection') }">
                                <option value="sync">{{ trans('strings.queue_sync') }}</option>
                                <option value="database">{{ trans('strings.queue_database') }}</option>
                            </select>
                            <has-error :form="form" field="queue_connection"></has-error>
                        </div>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend class="scheduler-border">{{ trans('strings.video_settings') }}</legend>
                    <div class="form-group row mb-1">
                        <label class="col-md-4 form-control-label">{{ trans('strings.video_providers') }}</label>
                        <div class="col-md-8">
                            <select v-model="form.video_providers" class="form-control"
                                :class="{ 'is-invalid': form.errors.has('video_providers') }">
                                <option value="upload">{{ trans('strings.upload_only') }}</option>
                                <option value="youtube">{{ trans('strings.youtube_only') }}</option>
                                <option value="both">{{ trans('strings.both') }}</option>
                            </select>
                            <has-error :form="form" field="video_providers"></has-error>
                        </div>
                    </div>

                    

                    <template v-if="form.video_providers !== 'youtube'">
                        <hr />
                        <div class="form-group rowx mb-1">
                            <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-0">
                                <input id="encode_videos" name="encode_videos" :value="true" v-model="form.encode_videos" 
                                    class="custom-control-input rounded-0" 
                                    type="checkbox">
                                <label class="custom-control-label" for="encode_videos">
                                {{ trans('strings.enable_video_encoding') }}
                                </label>
                            </div>
                            <div class="alert alert-warning p-2">
                                <h4 class="text-darkx mb-0 font-weight-light">{{ trans('strings.important') }}</h4>
                                <p class="font-13 text-darkx mb-0">{{ trans('strings.enable_video_encoding_explanation') }}</p>
                            </div>
                        </div>

                        <template v-if="form.encode_videos">
                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.video_hd_dimension') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.video_hd_dimension" class="form-control" placeholder="1280, 720"
                                        :class="{ 'is-invalid': form.errors.has('video_hd_dimension') }">
                                    <has-error :form="form" field="video_hd_dimension"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.video_sd_dimension') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.video_sd_dimension" class="form-control" placeholder="640, 360"
                                        :class="{ 'is-invalid': form.errors.has('video_sd_dimension') }">
                                    <has-error :form="form" field="video_sd_dimension"></has-error>
                                </div>
                            </div>
                        </template>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.video_max_size_mb') }}</label>
                            <div class="col-md-8">
                                <input type="text" v-model="form.video_max_size_mb" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('video_max_size_mb') }">
                                <has-error :form="form" field="video_max_size_mb"></has-error>
                            </div>
                        </div>

                        <div class="form-group row mb-1">
                            <label class="col-md-4 form-control-label">{{ trans('strings.video_upload_location') }}</label>
                            <div class="col-md-8">
                                <select v-model="form.video_upload_location" class="form-control"
                                    :class="{ 'is-invalid': form.errors.has('video_upload_location') }">
                                    <option value="s3">{{ trans('strings.amazon_s3_bucket') }}</option>
                                    <option value="local">{{ trans('strings.local_server') }}</option>
                                </select>
                                <has-error :form="form" field="video_upload_location"></has-error>
                            </div>
                        </div>

                        <template v-if="form.video_upload_location == 's3'">
                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_access_id') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_access_id" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_access_id') }">
                                    <has-error :form="form" field="s3_access_id"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_secret_access_key') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_secret_access_key" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_secret_access_key') }">
                                    <has-error :form="form" field="s3_secret_access_key"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_default_region') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_default_region" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_default_region') }">
                                    <has-error :form="form" field="s3_default_region"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_bucket') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_bucket" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_bucket') }">
                                    <has-error :form="form" field="s3_bucket"></has-error>
                                </div>
                            </div>

                            <div class="form-group row mb-1">
                                <label class="col-md-4 form-control-label">{{ trans('strings.s3_url') }}</label>
                                <div class="col-md-8">
                                    <input type="text" v-model="form.s3_url" class="form-control"
                                        :class="{ 'is-invalid': form.errors.has('s3_url') }">
                                    <has-error :form="form" field="s3_url"></has-error>
                                </div>
                            </div>
                        </template>

                        
                    </template>
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
                encode_videos: false,
                video_upload_location: 'local',
                video_max_size_mb: 20,
                video_hd_dimension: '1280, 720',
                video_sd_dimension: '640, 360',
                video_providers: 'both',
                s3_access_id: '',
                s3_secret_access_key: '',
                s3_default_region: '',
                s3_bucket: '',
                s3_url: '',
                queue_connection: 'sync'
            })
        }
    },

    methods:{
        submit(){
            this.form.post(`/api/admin/settings/site?type=videos`)
        },

        fetchSettings(){
            axios.get('/api/admin/settings')
                .then(async res => {
                    const settings = await res.data.site
                    if(settings !== undefined){
                        for(const key of this.form.keys()){
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