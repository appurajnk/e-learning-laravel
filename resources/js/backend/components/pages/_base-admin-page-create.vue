<template>
    <div class="setting-body white-bg-color">
        <form @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="form-group row">
                <label class="col-md-3 text-right">{{ trans('strings.title') }}</label>
                <div class="col-md-9">
                    <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control rounded-0 font-14 fw-300 form-control-lg">
                    <has-error :form="form" field="title"/>
                </div>
            </div>
                
            <div class="form-group row">
                <label class="col-md-3 text-right">{{ trans('strings.slug') }}</label>
                <div class="col-md-9">
                    <div class="input-group rounded-0">
                        <div class="input-group-prepend rounded-0">
                            <span class="input-group-text rounded-0">{{ base_url }}/</span>
                        </div>
                        <input type="text" v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }" class="form-control rounded-0 font-14 fw-300 form-control-lg">
                        <has-error :form="form" field="slug"/>
                    </div>
                    
                </div>
            </div>
            
            <div class="form-group row">
                <label class="col-md-3 text-right">{{ trans('strings.body') }}</label>
                <div class="col-md-9 page-quill">
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
                    {{ trans('strings.create') }}
                </base-button>
            </div>
        </form>
        
    </div>
</template>

<script>
import Form from 'vform'
export default {
    props: ['locale'],
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
                title: '',
                slug: '',
                body: ''
            })
        }
    },


    watch:{
        "form.title"(value){
            this.form.slug = this.sanitizeTitle(value)
        }
    },
    
    methods: {
        onEditorChange({ editor, html, text }) {
            this.form.body = html
        },

        async save(){
            await this.form.post(`/api/admin/pages`)
                .then(response => {
                    window.location.href=`/admin/pages/${response.data.uuid}`
                })
        },

        sanitizeTitle(title) {
            let slug = "";
            let titleLower = title.toLowerCase();
            // Letter "e"
            slug = titleLower.replace(/e|é|è|ẽ|ẻ|ẹ|ê|ế|ề|ễ|ể|ệ/gi, 'e');
            // Letter "a"
            slug = slug.replace(/a|á|à|ã|ả|ạ|ă|ắ|ằ|ẵ|ẳ|ặ|â|ấ|ầ|ẫ|ẩ|ậ/gi, 'a');
            // Letter "o"
            slug = slug.replace(/o|ó|ò|õ|ỏ|ọ|ô|ố|ồ|ỗ|ổ|ộ|ơ|ớ|ờ|ỡ|ở|ợ/gi, 'o');
            // Letter "u"
            slug = slug.replace(/u|ú|ù|ũ|ủ|ụ|ư|ứ|ừ|ữ|ử|ự/gi, 'u');
            // Letter "d"
            slug = slug.replace(/đ/gi, 'd');
            // Trim the last whitespace
            slug = slug.replace(/\s*$/g, '');
            // Change whitespace to "-"
            slug = slug.replace(/\s+/g, '-');
            
            return slug;
        }
    },

    mounted(){
        this.base_url = window.config.url
        this.form.locale = this.locale
    }

}
</script>

<style>
    .page-quill .ql-editor{
        min-height: 200px !important;
    }
</style>
