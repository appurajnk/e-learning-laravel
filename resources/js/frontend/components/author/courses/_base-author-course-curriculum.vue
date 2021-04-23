<template>
    <div class="setting-body white-bg-color">
        <vue-element-loading :active="loading" background-color="#ffffff" :is-full-screen="false"></vue-element-loading>
        <div class="tc-tabs-style6">
            <ul class="nav nav-tabs mb-2" role="tablist">
                <li class="nav-item mr-2">
                    <a class="nav-link border border-secondary active" data-toggle="tab" href="#course-lessons">
                        {{ trans('strings.lessons') }}
                    </a>
                </li>
                <li class="nav-item mr-2">
                    <a class="nav-link border border-secondary" data-toggle="tab" href="#course-sections">
                        {{ trans('strings.sections') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link border border-secondary" data-toggle="tab" href="#course-attachments">
                        {{ trans('strings.course_attachments') }}
                    </a>
                </li>
            </ul>
            

            <div class="tab-content tc-post-grid-style1 mt-0 p-0 sec-spacer">
                <!-- SECTIONS -->
                <div id="course-sections" class="tab-pane">
                    <div class="card card-body border">
                        <div class="row">
                            
                            <div class="col-md-12">
                                <div class="tc-accordion" id="sectionAccordion">
                                    <draggable style="min-height: 10px;"
                                        v-model="sections" 
                                        :options="{draggable:'.dragme', pull: 'true', ghostClass: 'sortable-ghost'}"
                                        @change="updateSectionSort">
                                            <inc-course-section v-for="(section, index) in sections" 
                                                :key="section.id" 
                                                :index="index" 
                                                :section="section"
                                                v-bind="{ findSectionsByCourse }">
                                            </inc-course-section>
                                    </draggable>
                                </div>
                            </div>
                            <div class="col-md-12 mt-4">
                                <inc-edit-section-form v-if="editing" v-bind="{ findSectionsByCourse }" :section = "selectedSection"></inc-edit-section-form>
                                <inc-create-section-form v-else v-bind="{ findSectionsByCourse }" :course_id="course.id"></inc-create-section-form>
                            </div>
                        </div>
                    </div>
                </div><!--/ END SECTIONS -->

                <!-- LESSONS -->
                <div id="course-lessons" class="tab-pane in active">
                    <div class="row">
                        <div class="col-md-12">
                            <inc-lesson-section v-for="section in sections" :section="section" :key="section.id"></inc-lesson-section>
                        </div>
                    </div>
                    
                    <!-- CREATE LESSON FORM -->
                    <div class="row mt-4" v-if="creatingLesson" >
                        <div class="col-md-12">
                            <inc-create-lesson-form :sections="sections"></inc-create-lesson-form>
                        </div>
                    </div>
                    
                    <!-- CREATE BUTTONS -->
                    <div class="row mt-4" v-else>
                        <div class="col-md-8 offset-md-2 text-center">
                            <div class="btn-group d-flex" role="group" aria-label="Action Buttons">
                                <button type="button" class="btn btn-light flex-fill mr-2" @click="creatingLesson=true">
                                    <i class="fa fa-plus-square"></i>
                                    {{ trans('strings.lecture') }}
                                </button>
                                <!-- <button type="button" class="btn btn-light flex-fill">
                                    <i class="fa fa-plus-square"></i>
                                    {{ trans('strings.quiz') }}
                                </button> -->
                            </div>
                        </div>
                    </div>
                </div>
                
                

                <!-- ATTACHMENTS -->
                <div id="course-attachments" class="tab-pane">
                    <inc-attachments :lessons="lessons" :course_id="course.id"></inc-attachments>
                </div>

            </div>
        </div>
    </div>
</template>

<script>
    import IncCourseSection from './imports/curriculum/_course_section'
    import IncCreateLessonForm from './imports/curriculum/_create_lesson_form'
    import IncCreateSectionForm from './imports/curriculum/_create_section_form'
    import IncEditSectionForm from './imports/curriculum/_edit_section_form'
    import IncLessonSection from './imports/curriculum/_lesson_section'
    import IncAttachments from './imports/curriculum/_attachments'

    import { mapGetters, mapState } from 'vuex'
    import axios from 'axios'
    import Form from 'vform'
    export default {
        props: ['course'],
        components: {
            IncCourseSection,
            IncCreateLessonForm,
            IncCreateSectionForm,
            IncEditSectionForm,
            IncLessonSection,
            IncAttachments
        },
        data: () => ({
            creatingLesson: false,
            editing: false,
            selectedSection: [],
            loading: true,
            uuid: '',
            sections: [],

            form: new Form({
                title: '',
                objective: ''
            })
        }),
        
        computed:{
            lessons(){
                return this.sections.map(s => s.lessons).flat();
            }
        },
        methods: {
            findSectionsByCourse(){
                axios.get(`/api/sections/findByCourse/${this.course.id}`)
                    .then(response => {
                        this.sections = response.data.data
                        setTimeout(() => {
                            this.loading = false
                        }, 3000)
                        
                    })
            },
            
            updateSectionSort(e){
                this.sections.map((section, index) => {
                    section.sortOrder = index + 1
                })
                axios.put(`/api/sections/save-draggable`, this.sections)
                    .then(() => {}) 
            }
        },
        
        created(){
            this.$bus.$on('section:editStart', data => {
                this.selectedSection = data
                this.editing = true
            })
            .$on('section.editEnd', () => {
                this.selectedSection = []
                this.editing = false
                this.findSectionsByCourse()
            })
            .$on('lesson:createEnd', () => {
                this.creatingLesson = false
            })
        },

        beforeMount(){
            this.findSectionsByCourse()
        },
        
        mounted(){
            this.$bus.$on('order:saved', () => {
                //this.findSectionsByCourse()
            })
        }
    }
</script>