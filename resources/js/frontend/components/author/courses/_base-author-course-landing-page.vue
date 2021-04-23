<template>
    <div class="setting-body white-bg-color">
        <form @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <label>{{ trans('strings.course_title') }}</label>
                <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" class="form-control rounded-0 font-14 fw-300 form-control-lg">
                <has-error :form="form" field="title"/>
            </div>
                
            <div class="form-group">
                <label>{{ trans('strings.course_subtitle') }}</label>
                <input type="text" v-model="form.subtitle" :class="{ 'is-invalid': form.errors.has('subtitle') }" class="form-control rounded-0 font-14 fw-300 form-control-lg">
                <has-error :form="form" field="subtitle"/>
            </div>
            
            <div class="form-group">
                <label>{{ trans('strings.course_description') }}</label>
                <wysiwyg v-model="form.description" />
                <has-error :form="form" field="description"/>
            </div>
            
                    
            <div class="form-row mb-1">
                <div class="col-md-6">
                    <label>{{ trans('strings.category') }}</label>
                    <select class="form-control" v-model="form.category">
                        <optgroup v-for="category in categories_with_children" :key="category.uuid" :label="category.name">
                            <option v-for="child in category.children" :key="child.uuid" :value="child.id">{{ child.name }}</option>
                        </optgroup>
                    </select>
                    <has-error :form="form" field="category"/>
                </div>
                
                <div class="col-md-6">
                    <label>{{ trans('strings.level') }}</label>
                    <select class="form-control"
                        v-model="form.level">
                        <option value="all">{{ trans('strings.all') }}</option>
                        <option value="beginner">{{ trans('strings.beginner') }}</option>
                        <option value="intermediate">{{ trans('strings.intermediate') }}</option>
                        <option value="advanced">{{ trans('strings.advanced') }}</option>
                    </select>

                    <has-error :form="form" field="level"/>
                </div>
                
            </div>
            
            <div class="form-row mb-4">
                <div class="col-md-6">
                    <label>{{ trans('strings.language') }}</label>
                    <select class="form-control" v-model="form.language">
                        <option v-for="(item,key) in languages" :value="item" :key="key">{{ item }}</option>
                    </select>
                    <has-error :form="form" field="language"/>
                </div>
                
                <!-- <div class="col-md-6">
                    <label>{{ trans('strings.topics') }}</label>
                    <vue-tags-input 
                        v-model="topic"
                        :tags="topics"
                        :max-tags="4"
                        placeholder="choose topic"
                        @tags-changed="topicChanged" />
                </div> -->
            </div>
            
            <div class="form-group text-right">
                <base-button :loading="form.busy" class="btn btn-lg btn-danger font-16 fw-500">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </form>
        
        
        <hr />

        <div class="row" v-if="course">
            <div class="col-md-12">
                <div class="font-16 fw-600 mb-4">
                    <h3>{{ trans('strings.course_image') }}</h3>
                </div>
            </div>
            
            <div class="col-md-5">
                <inc-course-image-upload :course="course"></inc-course-image-upload>
            </div>
            <div class="col-md-7">
                <p>
                    {{ trans('strings.image_description') }}
                </p>
            </div>
        </div>

        <!-- <hr />

        <div class="row" v-if="course">
            <div class="col-md-12">
                <div class="font-16 fw-600 mb-4">
                    <h3>{{ trans('strings.promo_video') }}</h3>
                </div>
            </div>
            <div class="col-md-6">
                <inc-course-promo-video-upload :course="course"></inc-course-promo-video-upload>
            </div>
            <div class="col-md-6">
                <p>
                    {{ trans('strings.promo_video_description') }}
                </p>
            </div>
        </div> -->


    </div>
</template>

<script>
import Form from 'vform'
//import VueTagsInput from '@johmun/vue-tags-input';
import IncCourseImageUpload from './imports/_course_image_upload'
import IncCoursePromoVideoUpload from './imports/_course_promo_video_upload'
export default {
    props: ['course', 'categories'],
    components:{
        IncCourseImageUpload,
        IncCoursePromoVideoUpload
       // VueTagsInput
    },
    data(){
        return {
            uuid: '',
            loading: true,
            languages: [],
            editorOption: {
              modules: {
                toolbar: [
                  ['bold', 'italic', 'underline'],
                  [{ 'list': 'ordered' }, { 'list': 'bullet' }],
                ],
                syntax: {
                  highlight: text => hljs.highlightAuto(text).value
                }
              }
            },
            topic: '',
            topics: [],
            form: new Form({
                id: '',
                title: '',
                subtitle: '',
                description: '',
                category: '',
                level: '',
                language: '',
                topics: []
            })
        }
    },
    computed:{
        categories_with_children(){
            return this.categories.filter(c => c.children.length > 0)
        }
    },
    methods: {
        onEditorChange({ editor, html, text }) {
            this.form.description = html
        },

        topicChanged(topics){
            this.topics = topics
            this.form.topics = topics.map(t => t.text)
        },

        getLanguages(){
            axios.get('/api/languages')
                .then(response => {
                    this.languages = response.data
                })
        },

        async save(){
            this.form.topics = await []
            await this.form.put(`/api/courses/${this.course.id}`)
                .then(() => {
                    //console.log("Updated")
                })
        }
    },

    beforeMount(){
        this.getLanguages()

        this.form.keys().forEach(key => {
            this.form[key] = this.course[key]
        })
        this.form.category = this.course.category_id
        // this.topics = this.course.tags.map(t => {
        //     return {
        //         text: t.name.en,
        //         tiClasses:["ti-valid"]
        //     }
        // })
    }

}
</script>

<style>
    .editr pre {
        background: #ededed;
        font-family: monospace;
        padding: 2px;
        color: red;
    }

</style>
