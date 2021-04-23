<template>
    <div class="setting-body white-bg-color">
        <form @submit.prevent="update" @keydown="form.onKeydown($event)">
            <div class="form-group row">
                <label class="col-md-2 text-right">{{ trans('strings.title') }}</label>
                <div class="col-md-10">
                    <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control rounded-0 font-14 fw-300 form-control-lg">
                    <has-error :form="form" field="title"/>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-2 text-right">{{ trans('strings.body') }}</label>
                <div class="col-md-10 page-quill">
                    <quill-editor 
                        :content="form.body"
                        :options="editorOption"
                        @change="onEditorChange($event)">
                    </quill-editor>
                    <has-error :form="form" field="body"/>
                </div>
            </div>
            
            <div class="form-group text-right">
                <base-button :loading="form.busy" class="btn rounded-0 btn-lg btn-danger font-16 fw-500">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </form>
        
    </div>
</template>

<script>
import Form from 'vform'
export default {
    props: ['locale', 'uuid'],
    data(){
        return {
            base_url: '',
            editorOption: {
              modules: {
                toolbar: [
                  ['bold', 'italic', 'underline'],
                  [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ]
              }
            },
            form: new Form({
                locale: '',
                title: '',
                body: ''
            })
        }
    },

    methods: {
        onEditorChange({ editor, html, text }) {
            this.form.body = html
        },

        async fetchArticleForLocale(){
            await axios.get(`/api/admin/page/${this.uuid}/locale/${this.locale}`)
                .then(response => {
                    this.form.title = response.data.data.title[this.locale] || ''
                    this.form.body = response.data.data.body[this.locale] || ''
                })
        },

        async update(){
            await this.form.put(`/api/admin/page/${this.uuid}`)
                .then(response => {})
        }
    },

    beforeMount(){
        this.form.locale = this.locale
        this.fetchArticleForLocale()
    }

}
</script>
