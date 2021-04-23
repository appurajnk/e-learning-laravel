<template>
        <div class="row">
            <div class="col-md-12 mb-2 font-13">
                <div class="alert alert-info">
                    <p>{{ trans('strings.attachment_explanation') }}</p>
                </div>
            </div>
            <div class="col-md-5">
                <div class="form-group">
                    <select v-model="lesson" id="lesson" class="form-control font-13">
                        <option :value="null">{{ trans('strings.select_a_lesson') }}</option>
                        <option v-for="lesson in lessons" :key="lesson.uuid" :value="lesson.id">{{ lesson.title }}</option>
                    </select>
                </div>

                <div class="mb-2" v-if="lesson">
                    <div class="text-danger mb-2" v-if="error">{{ error }}</div>
                    <el-upload 
                        class="upload-demo"
                        ref="upload"
                        :action="url"
                        :auto-upload="false"
                        :multiple="true"
                        name="file"
                        :accept="accept"
                        :on-change="uploadChanged"
                        :on-error="uploadError"
                        :on-success="uploadSuccess"
                        :on-remove="uploadRemoved"
                        :before-remove="beforeRemove"
                        :before-upload="beforeUploadCheckSize"
                        :on-progress="uploadProgress"
                        :limit="5"
                        list-type="text">
                        <el-button slot="trigger" size="small" type="primary" v-if="!fileSelected">
                            <i class="fas fa-paperclip"></i> {{ trans('strings.choose_attachment') }}
                        </el-button>
                        <div class="el-upload__tip" slot="tip" v-if="!fileSelected">
                            {{ trans('strings.max_video_size', {size: `${window_max_size}mb`, number: 5}) }}
                        </div>
                    </el-upload>
                </div>

                <el-button :disabled="uploading" size="small" type="warning" @click.prevent="submitUpload" v-if="fileSelected">
                    <i class="fas fa-cloud-upload-alt"></i> {{ trans('strings.upload') }}
                </el-button>
            </div>

            <div class="col-md-7">
                <div class="list-group font-13" v-if="attachments.length > 0">
                    <div class="list-group-item d-flex justify-content-between align-items-center"
                        v-for="attachment in attachments" :key="attachment.uuid">
                        <span>
                            {{ attachment.original_filename }} 
                            <span class="font-12">({{ attachment.lesson.title | truncate(40) }})</span>
                        </span>
                        <span>
                            <a href="javascript:void(0)" class="text-danger" @click.prevent="deleteAttachment(attachment.id)">
                                <i class="fas fa-trash"></i>
                            </a>
                        </span>
                    </div>
                </div>
                <span v-else>
                    {{ trans('strings.no_attachments') }}
                </span>
            </div>
        </div>
        
</template>

<script>
import Form from 'vform'
export default {
    props:{
        lessons: { type: Array , required: true },
        course_id: { type: Number, required: true }
    },

    data(){
        return {
            attachments: [],
            lesson: null,
            window_max_size: null,
            uploading: false,
            fileSelected: false,
            error: '',
            accept: '.zip,.txt,.xls,.xlsx,.doc,.docx,.pdf,.jpg,.jpeg,.png,.tiff,.ppt,.pptx'
        }
    },

    computed:{
        url(){
            return `/api/lessons/${this.lesson}/attachments`
        }
    },

    watch:{
        lessons:{
            deep: true,
            handler(lesson){}
        }
    },

    methods:{
        submitUpload(){
            this.$refs.upload.submit();
        },
        uploadChanged(file, fileList){
            this.fileSelected = true
        },
        uploadSuccess(response, file, fileList){
            this.fetchAttachments()
        },
        uploadError(error, file, fileList){
            this.fileSelected = false
            this.uploading = false
            this.error = "Error while uploading the file"
        },
        uploadRemoved(file, fileList){
            if(fileList.length == 0){
                this.fileSelected = false
            }
        },

        handleExceed(files, fileList) {
            this.$vmessage.warning(`The limit is 3, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
        },

        beforeRemove(file, fileList) {
            //return this.$vconfirm(`Remove ${ file.name } from upload list?`);
        },

        beforeUploadCheckSize(file){
            const filesize = file.size / 1024 / 1024;
            const isLt20M = filesize < window.config.max_size;
            if (!isLt20M) {
                this.$vmessage.error(`File cannot exceed ${window.config.max_size}mb in size. Your file is ${filesize.toFixed(2)}mb`);
            }

            return isLt20M;
        },

        uploadProgress(){
            this.uploading = true
        },

        cancel(){
            this.$refs.upload.clearFiles()
            this.$bus.$emit('upload:cancelled', this.lesson.id)
        },

        async fetchAttachments(){
            this.uploading = await false
            this.lesson = await null
            this.fileSelected = await false

            await axios.get(`/api/courses/${this.course_id}/attachments`)
                .then(response => {
                    this.attachments = response.data
                })
        },

        deleteAttachment(id){
            this.$dialog.confirm({title: this.trans('strings.confirm_delete')}, {animation: 'fade', loader: false})
                    .then(dialog => {
                        axios.delete(`/api/attachments/${id}`)
                            .then(response => {
                                this.fetchAttachments()
                            })
                    })
            
        }
    },

    beforeMount(){
        this.window_max_size = window.config.max_size
        this.fetchAttachments()
    }

}
</script>

<style>

</style>