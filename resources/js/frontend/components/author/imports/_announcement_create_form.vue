<template>
    <form @submit.prevent="editing ? update() : create()" @keydown="form.onKeydown($event)">
        <div class="form-group">
            <el-select class="w-100" style="width: 100%;"
                v-model='form.courses' multiple 
                :placeholder="trans('strings.select_courses')">
                <el-option
                    v-for="course in courses"
                    :key="course.id"
                    :label="course.title"
                    :value="course.id">
                </el-option>
            </el-select>
            <has-error :form="form" field="courses"/>
        </div>
        
        <div class="form-group">
            <input class="form-control" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                :placeholder="trans('strings.title')"/>
            <has-error :form="form" field="title"/>
        </div>
        
        <div class="form-group">
            <quill-editor :content="form.body"
                :options="editorOption"
                @change="onEditorChange($event)">
            </quill-editor>
            <has-error :form="form" field="body"/>
        </div>
        
        <div class="text-right">
            <a href="#" @click.prevent="cancel()" class="mr-3">{{ trans('strings.cancel') }}</a>
            <base-button :loading="form.busy" class="btn btn-danger rounded-0 font-12 fw-500">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ editing ? trans('strings.update') : trans('strings.create') }}
            </base-button>
        </div>
        
    </form>
</template>

<script>
    import Form from 'vform'
    export default {
        name: 'CourseAnnouncementCreateForm',
        props: ['courses', 'editing', 'announcement'],
        
        data: () => ({
            editorOption: {
                placeholder: '',
                modules: {
                    toolbar: [
                        ['bold', 'italic', 'underline', 'code-block'],
                        [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                    ]
                }
            },
            
            form: new Form({
                title: '',
                body: '',
                courses: []
            })
        }),
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.body = html
            },
            create(){
                this.form.post(`/api/announcements`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('announcement:created', null)
                    })
            },
            update(){
                this.form.put(`/api/announcements/${this.announcement.id}/update`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('announcement:created', null)
                    })
            },
            cancel(){
                this.form.reset()
                this.$bus.$emit('create_announcement:cancelled', null)
            }
            
        },

        beforeMount(){
           if(this.editing){
                this.form.body = this.announcement.body 
                this.form.title = this.announcement.title
                this.form.courses = this.announcement.courses.map(c => c.id)
           }
        }
    }
</script>
