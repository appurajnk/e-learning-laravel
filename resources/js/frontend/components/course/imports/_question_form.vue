<template>
    <form @submit.prevent="action=='edit' ? update() : create()" @keydown="form.onKeydown($event)">
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
                {{ trans('strings.post_question') }}
            </base-button>
        </div>
        
    </form>
</template>

<script>
    import Form from 'vform'
    export default {
        name: 'CourseQuestionCreateForm',
        props: ['course', 'action', 'question'],
        
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
                course: null
            })
        }),
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.body = html
            },
            create(){
                this.form.course = this.course.id
                this.form.post(`/api/questions/store`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('question:created', null)
                    })
            },
            
            update(){
                this.form.course = this.course.id
                this.form.put(`/api/questions/${this.question.id}`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('question:updated', null)
                    })
            },
            
            cancel(){
                this.form.reset()
                this.$bus.$emit('create_question:cancelled', null)
            }
            
        },
        
        mounted(){
            if(this.action=='edit'){
                this.form.body = this.question.body
                this.form.title = this.question.title
            }
        }
        
        
    }
</script>
