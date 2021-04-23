<template>
    <form @submit.prevent="create()" @keydown="form.onKeydown($event)">
        <div class="form-row mb-2">
            <div class="col-md-8">
                <label>{{ trans('strings.youtube_video_url') }}</label>
                <input type="text" v-model="form.url" :class="{ 'is-invalid': form.errors.has('url') }" 
                   class="form-control font-14 fw-300">
                <has-error :form="form" field="url"/>
            </div>
            <div class="col-md-4">
                <label>{{ trans('strings.duration_in_minutes') }}</label>
                <input type="number" min="1" v-model="form.duration" :class="{ 'is-invalid': form.errors.has('duration') }" 
                    class="form-control font-14 fw-300">
                <has-error :form="form" field="duration"/>
            </div>
        </div>
        
        <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
            {{ trans('strings.save') }}
        </base-button>
        
        <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
        
    </form>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'ContentCreateYoutubeForm',
        props: ['lesson', 'content', 'action'],
        
        data: () => ({
            form: new Form({
                url: '',
                duration: 2,
                lesson: null
            })
        }),
        
        methods: {
            create(){
                this.form.lesson = this.lesson.id
                this.form.post(`/api/contents?type=youtube`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('upload:complete', this.lesson.id)
                    })
            },
            
            
            cancel(){
                this.form.reset()
                this.$bus.$emit('upload:cancelled', this.lesson.id)
            }
            
        },
        
        mounted(){
            if(this.action=='edit'){
                this.form.url = this.lesson.video.youtube_link
                this.form.duration = this.lesson.duration
            }
        }
        
        
    }
</script>
