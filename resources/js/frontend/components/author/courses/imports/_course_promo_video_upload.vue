<template>
    <div class="d-flex">
        <div class="custom-control custom-radio">
            <input type="radio" id="video_type_upload" value="upload" name="video_type" class="custom-control-input">
            <label class="custom-control-label" for="video_type_upload">Upload</label>
        </div>
        <div class="custom-control custom-radio">
            <input type="radio" id="video_type_youtube" value="youtube" name="video_type" class="custom-control-input">
            <label class="custom-control-label" for="video_type_youtube">YouTube</label>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    data(){
        return {
            form: new Form({
                video_type: 'upload'
            })
        }
    },

    methods:{

    }

}
</script>

<style>

</style>