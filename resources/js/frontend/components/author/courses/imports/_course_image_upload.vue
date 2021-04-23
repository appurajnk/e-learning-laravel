<template>
    <div class="form-group">
        <img class="w-100 mb-2" :src="image_path">
        
        <button id="pick-image" class="btn btn-lg font-12" :class="uploading ? 'btn-danger' : 'btn-info'">
            <span v-if="uploading==false">
                {{ trans('strings.choose_image') }}
            </span>
            <span v-if="uploading==true">
                <i class="fa fa-cog fa-spin"></i> {{ trans('strings.processing') }}
            </span>
        </button>

        <avatar-cropper
            @uploaded="handleUploaded"
            @uploading="handleUploading"
            trigger="#pick-image"
            :upload-url="url"
            :labels="labels"
            upload-form-name="photo"
            mimes="image/png, image/gif, image/jpeg"
            :cropper-options="croper_options"/>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'
    
    
    export default{
        name: 'CourseImageUpload',
        props: ['course', 'initial_image'],

        data(){
            return {
                image_path: '',
                uploading: false,
                url: '',
                labels: {
                    submit: this.trans('strings.upload'),
                    cancel: this.trans('strings.cancel')
                },
                croper_options: {
                    aspectRatio: 16 / 9,
                    autoCropArea: 2
                }
            }
        },

        methods: {
            handleUploaded(response) {
                this.image_path = response.url
                this.uploading = false
            },
            
            handleUploading(){
                this.uploading = true
            }
        },

        beforeMount(){
            this.image_path = this.course.images.cover_image
            this.url = `/api/courses/upload-cover-image/${this.course.id}`
        }
    }
</script>