<template>
    <div class="panel bg-light list-complete-item mb-2">
        <h4 class="acdn-title">
            <a class="" aria-expanded="true">
                {{ trans('strings.section') }} {{ section.sortOrder }}: {{ section.title }}
            </a>
        </h4>
        <div class="" aria-expanded="true">
            <div class="acdn-body py-0 px-2">
                
                <!-- START -->
                <draggable 
                    style="min-height: 10px;"
                    v-model="lessons"
                    class="tc-accordion tc-accordion-style1" 
                    :id="`MyLessonAccordion-${section.id}`"
                    :options="{draggable:'.dragme', handle: '.handle', group:'LessonsGroup', ghostClass: 'sortable-ghost'}" 
                    @change="updateLessonSort">
                    <SectionLesson 
                        v-for="(lesson, index) in lessons" 
                        :key="lesson.id" 
                        :index="index" 
                        :prop_lesson="lesson"
                        :section="section"
                        v-bind="{ findLessonsBySection }"/>
                </draggable>
                    
                <!--/ END LESSONS -->
                
            </div>
        </div>
    </div>
</template>

<script>
    import SectionLesson from './imports/_section_lesson'
    import { mapGetters, mapState } from 'vuex'
    import Form from 'vform'
    import axios from 'axios'
    
    export default{
        name: 'LessonSection',
        
        props: ['section'],
        
        components: {
            SectionLesson
        },

        
        
        data(){
            return {
                lessons: []
            }
        },
        
        methods: {
            findLessonsBySection(){
                axios.get(`/api/lessons/findBySection/${this.section.id}`)
                    .then(response => {
                        this.lessons = response.data.data
                    })
            },
            
            updateLessonSort(){
                this.lessons.map((lesson, index) => {
                    lesson.sortOrder = index + 1
                    lesson.section_id = this.section.id
                })
                if(this.lessons.length){
                    axios.put('/api/lessons/save-draggable', this.lessons)
                        .then(response => {
                            this.findLessonsBySection()
                            this.$bus.$emit('order:saved', null)
                        })  
                }
            }
            
        },
        
        mounted(){
            this.findLessonsBySection()
            
            this.$bus.$on('upload:cancelled', data => {
                this.findLessonsBySection()
            })
            .$on('lesson:created', data => {
                if(data == this.section.id){
                    this.findLessonsBySection()
                }
            })
            
            $('.acdn-title').on('mouseover', function(){
                $(this).find('.actions').removeClass('d-none');
            }).on('mouseout', function(){
                $(this).find('.actions').addClass('d-none');
            })
        }
        
        
        
    }
</script>