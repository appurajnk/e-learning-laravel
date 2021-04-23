<template>
    <div class="list-group-item border border-0 d-flex mb-2" 
        :class="{ 'bg-warning-light' : comment.marked_as_answer }">
        <div class="mr-3">
            <img :src="comment.user.picture" width="45" class="rounded-circle" />
        </div>
        <div class="flex-grow-1" v-if="!showEdit">
            <div class="font-13 mb-2">
                <a href="#">
                    {{ comment.user.full_name }}
                </a>
                <span class="text-muted font-12">{{ comment.timeago }}</span>
                <span class="font-12" v-if="comment.marked_as_answer">
                     <i class="fas fa-star text-warning"></i>
                     {{ trans('strings.answer')}}
                 </span>
            </div>
            
            <div v-html="comment.body" class="font-13"></div>
            
            <div class="mt-3 font-12">
                <span v-if="show_mark_as_answer">
                    <a href="#" class="text-success mr-3" 
                        v-if="! comment.marked_as_answer" 
                        @click.prevent="markAsAnswer()">
                        {{ trans('strings.mark_as_answer') }}
                    </a>
                </span>

                <span v-if="user.id == comment.user_id">
                    <a href="#" @click.prevent="showEdit=true">edit</a> | 
                    <a href="#" @click.prevent="destroy()" class="text-danger">
                        {{ trans('strings.delete') }}</a>
                </span>
            </div>
            
        </div>
        <div class="flex-grow-1" v-else>
            <form @submit.prevent="update" @keydown="form.onKeydown($event)">
                <div class="form-group">
                    <quill-editor :content="form.body"
                        :options="editorOption"
                        @change="onEditorChange($event)">
                    </quill-editor>
                    <has-error :form="form" field="body"/>
                </div>
                
                <div class="text-right">
                    <a href="#" @click.prevent="showEdit=false" class="mr-3">
                        {{ trans('strings.cancel') }}
                    </a>
                    <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500">
                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                        {{ trans('strings.update') }}
                    </base-button>
                </div>
                
            </form>
        </div>
    </div>  
</template>
<script>
    import Form from 'vform'
    import axios from 'axios'
    
    export default {
        name: 'Comment',
        data(){
            return {
                showEdit: false,
                comment: [],
                form: new Form({
                    body: '',
                    model: ''
                }),
                editorOption: {
                    placeholder: this.trans('strings.enter_response'),
                    modules: {
                        toolbar: [
                            ['bold', 'italic', 'underline', 'formula', 'code-block', 'clean'],
                            [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                        ]
                    }
                },
            }
        },
        watch:{
            showEdit(v){
                this.$bus.$emit("toggleCommentEdit", v)
            },

            obj_comment:{
                deep: true,
                handler(c){
                    
                }
            }
        },
        props: {
            model: { required: true}, 
            obj_comment: { required: true}, 
            user: { required: true}, 
            fetchComments: { required: true}, 
            model_obj: { required: true},
            show_mark_as_answer: { type: Boolean, default: true }
        },
        props: ['model', 'obj_comment', 'user', 'fetchComments', 'model_obj', 'show_mark_as_answer'],
    
        
        methods: {
            onEditorChange({ editor, html, text }) {
                this.form.body = html
            },
            fetchComment(){
                axios.get(`/api/comment/${this.obj_comment.id}/fetchComment`)
                    .then(response => {
                        this.comment = response.data
                    })
            },
                
            update(){
                this.form.put(`/api/comment/${this.comment.id}/updateComment`)
                    .then(() => {
                        //this.fetchComment()
                        this.$bus.$emit("fetchComment", this.comment.id)
                        this.showEdit = false
                    })
            },
            
            destroy(){
                this.$dialog.confirm({title: this.trans('strings.confirm_delete') }, {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/comment/${this.obj_comment.id}/destroyComment`)
                            .then(() => {
                                this.fetchComments()
                            })        
                    })
                    
                
            },
            
            markAsAnswer(){
                this.$dialog.confirm(this.trans('strings.confirm_delete'), {animation: 'fade'})
                    .then(dialog => {
                        axios.get(`/api/comment/${this.obj_comment.id}/markAsAnswer`)
                            .then(() => {
                                this.fetchComments()
                                //location.reload()
                            })        
                    })
            }
        },
        
        created(){
            this.form.model = this.model
            this.form.body = this.obj_comment.body
            this.comment = this.obj_comment
            
            this.$watch('obj_comment', comment => {
                this.comment = comment
            })
        }
        
    }
    
</script>