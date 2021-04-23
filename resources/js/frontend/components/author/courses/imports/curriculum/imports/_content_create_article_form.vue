<template>
    <div>
        <div class="font-weight-bold mb-2">
            <h3 class="">
                {{ trans('strings.text_content') }}
            </h3>
        </div>
        
        <form @submit.prevent="create()" @keydown="form.onKeydown($event)">
            <div class="form-group mb-4">
                <quill-editor :content="form.content"
                    :options="editorOption"
                    @change="onEditorChange($event)">
                </quill-editor>
                <has-error :form="form" field="content"/>
            </div>
            
            <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ trans('strings.save') }}
            </base-button>
            
            <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
            
        </form>
    </div>
</template>

<script>
    import Form from 'vform'

    export default {
        name: 'ContentCreateArticleForm',
        props: ['lesson', 'content', 'action'],
        
        data: () => ({
            editorOption: {
              modules: {
                toolbar: [
                    [{ header: [1, 2, false] }],
                    ['bold', 'italic', 'underline', 'formula', 'code-block', 'clean'],
                    [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ]
              }
            },
            
            form: new Form({
                content: '',
                lesson: null
            })
        }),
      
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.content = html
            },
            create(){
                this.form.lesson = this.lesson.id
                this.form.post(`/api/contents`)
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
                this.form.content = this.lesson.article_body
            }
        }
        
        
    }
</script>
