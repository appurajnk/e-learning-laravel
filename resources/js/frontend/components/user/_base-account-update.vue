<template>
    <div>
        <div class="d-flex align-items-center justify-content-center mb-3 flex-column">
            <div class="mb-2">
                <img :src="picture" width="120" class="rounded-circle" />
            </div>
            <div class="">
                <button id="pick-avatar" :disabled="isLoading" :class="{ 'btn-loading': isLoading }" class="btn btn-sm btn-info">
                    {{ trans('strings.choose_image') }}
                </button>

                <avatar-cropper
                    @uploaded="handleUploaded"
                    @uploading="handleUploading"
                    trigger="#pick-avatar"
                    upload-form-name="photo"
                    upload-url="/api/settings/picture/upload"
                    :cropper-options="croper_options"
                    :labels="{ submit: trans('strings.submit'), cancel: trans('strings.cancel') }"/>
            </div>
        </div>


        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <alert-success :form="form" :message="trans('strings.info_updated')"/>
            <div class="row">
                <div class="col-md-6">
                    <!-- UName -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.username') }}</label>
                        <input v-model="form.username" disabled :class="{ 'is-invalid': form.errors.has('username') }" class="form-control rounded-0" type="text" name="username">
                        <has-error :form="form" field="username"/>
                    </div>
                    
                    <!-- FName -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.first_name') }}</label>
                        <input v-model="form.first_name" :class="{ 'is-invalid': form.errors.has('first_name') }" class="form-control rounded-0" type="text" name="first_name">
                        <has-error :form="form" field="first_name"/>
                    </div>
                    
                    <!-- LName -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.last_name') }}</label>
                        <input v-model="form.last_name" :class="{ 'is-invalid': form.errors.has('last_name') }" class="form-control rounded-0" type="text" name="last_name">
                        <has-error :form="form" field="last_name"/>
                    </div>
                    
                    <!-- Headline -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.tagline') }}</label>
                        <input v-model="form.tagline" :class="{ 'is-invalid': form.errors.has('tagline') }" class="form-control rounded-0" type="text" name="tagline">
                        <has-error :form="form" field="tagline"/>
                    </div>
                    
                    <!-- Headline -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.biography') }}</label>
                        <quill-editor :content="form.bio"
                            :options="editorOption"
                            @change="onEditorChange($event)">
                        </quill-editor>
                        <has-error :form="form" field="bio"/>
                    </div>
                    
                </div><!--/ END RIGHT SIDE -->
            
            
                <div class="col-md-6">
                    <!-- Website -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.website') }}</label>
                        <input v-model="form.website" :class="{ 'is-invalid': form.errors.has('website') }" class="form-control rounded-0" type="text" name="website">
                        <has-error :form="form" field="website"/>
                    </div>
                    
                    <!-- Linkedin -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.linkedin') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-right-0 rounded-0 font-13">https://linkedin.com/</span>
                            </div>
                            <input v-model="form.linkedin" :class="{ 'is-invalid': form.errors.has('linkedin') }" class="form-control rounded-0" type="text" name="linkedin">
                        </div>
                        <has-error :form="form" field="linkedin"/>
                    </div>
                    
                    <!-- Twitter -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.twitter') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-right-0 rounded-0 font-13">https://twitter.com/</span>
                            </div>
                            <input v-model="form.twitter" :class="{ 'is-invalid': form.errors.has('twitter') }" class="form-control rounded-0" type="text" name="twitter">
                        </div>
                        <has-error :form="form" field="twitter"/>
                    </div>
                    
                    <!-- Facebook -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.facebook') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-right-0 rounded-0 font-13">https://facebook.com/</span>
                            </div>
                            <input v-model="form.facebook" :class="{ 'is-invalid': form.errors.has('facebook') }" class="form-control rounded-0" type="text" name="facebook">
                        </div>
                        <has-error :form="form" field="facebook"/>
                    </div>
                    
                    
                    <!-- Youtube -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.youtube') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-right-0 rounded-0 font-13">https://youtube.com/</span>
                            </div>
                            <input v-model="form.youtube" :class="{ 'is-invalid': form.errors.has('youtube') }" class="form-control rounded-0" type="text" name="youtube">
                        </div>
                        <has-error :form="form" field="youtube"/>
                    </div>
                    
                    <!-- Youtube -->
                    <div class="form-group">
                        <label class="col-form-label">{{ trans('strings.github') }}</label>
                        <div class="input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text border-right-0 rounded-0 font-13">https://github.com/</span>
                            </div>
                            <input v-model="form.github" :class="{ 'is-invalid': form.errors.has('github') }" class="form-control rounded-0" type="text" name="github">
                        </div>
                        <has-error :form="form" field="github"/>
                    </div>
                </div>
            
            
                <!-- Submit Button -->
                <div class="col-md-12 text-right">
                    <button :disabled="form.busy" :class="{ 'btn-loading': form.busy }" class="btn btn-danger btn-md rounded-0">
                        {{ trans('strings.save') }}
                    </button>
                </div>
            
            </div>
        </form>
    </div>
</template>

<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    import AvatarCropper from "vue-avatar-cropper"
    export default {
        props:['user'],
        data(){
            return {
                isLoading: false,
                picture: '',
                croper_options: {
                    //aspectRatio: 16 / 9,
                    autoCropArea: 1
                },
                form: new Form({
                    first_name: '',
                    last_name: '',
                    username: '',
                    tagline: '',
                    bio: '',
                    website: '',
                    linkedin: '',
                    twitter: '',
                    facebook: '',
                    youtube: '',
                    github: ''
                }),
                
                editorOption: {
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline']
                        ]
                    }
                },
            }
        },
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.bio = html
            },
            update () {
                this.form.put(`/api/settings/profile`)
            },
            handleUploaded(resp) {
                this.picture = resp.picture
                this.isLoading = false
            },
            handleUploading(){
              this.isLoading = true;
            }
        },
        mounted(){
            this.picture = this.user.picture
            this.form.keys().forEach(key => {
                this.form[key] = this.user[key]
            })
        }
    }
</script>
