<template>
    <div class="card-footer bg-white p-0 border border-0">
        <div class="comment__list mb-4">
            <div class="list-group">
                <base-comment
                    v-for="comment in comments.data" 
                    :obj_comment="comment" 
                    :key="comment.id" 
                    :user="user"
                    :show_mark_as_answer="show_mark_as_answer"
                    v-bind="{ fetchComments }"></base-comment>
                
                <div class="comments__pagination">
                    <pagination 
                        class="pagination-sm justify-content-end text-info"
                        :data="comments" 
                        @pagination-change-page="fetchComments" 
                        :show-disabled="true"
                        :limit="2"></pagination>
                </div>
                
            </div>
        </div>
        
        
        <form @submit.prevent="create" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <quill-editor :content="form.body"
                    :options="editorOption"
                    @change="onEditorChange($event)">
                </quill-editor>
                <has-error :form="form" field="body"/>
            </div>
            
            <div class="text-right">
                <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.post') }}
                </base-button>
            </div>
            
        </form>
    </div>
</template>
<script>
    import Form from 'vform'
    import axios from 'axios'
    export default {
        
        name: 'Comments',
        data(){
            return {
                showEditComment: false,
                editorOption: {
                    placeholder: this.trans('strings.write_your_response'),
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'formula', 'code-block', 'clean'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ]
                    }
                },
                comments: {},
                form: new Form({
                    body: '',
                    model: '',
                    model_id: ''
                })
            }
        },

        props: ['model', 'model_id', 'user', 'model_obj', 'show_mark_as_answer'],
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.body = html
            },
            fetchComments(page=1){
                axios.post(`/api/comments/${this.model_id}/fetchComments`, {
                    model: this.model,
                    page: page
                }).then(response => {
                    this.comments = response.data
                })
            },

            fetchComment(id){
                axios.get(`/api/comment/${id}/fetchComment`)
                    .then(response => {
                        const comment = response.data
                        this.$set(this.comments.data, this.comments.data.findIndex(f => f.id === id), comment)
                    })
            },
            
            create(){
                this.form.model = this.model
                this.form.modelId = this.model_id
                this.form.post(`/api/comment/storeComment`)
                    .then(response => {
                        this.form.reset()
                        this.fetchComments()
                    })
            },
        },
        
        created(){
            this.form.model = this.model
            this.fetchComments()
        },

        mounted(){
            this.$bus.$on('toggleCommentEdit', (v) => {
                this.showEditComment = v
            })
            .$on('fetchComment', (id) => {
                this.fetchComment(id)
            })
        }
        
    }
    
</script>