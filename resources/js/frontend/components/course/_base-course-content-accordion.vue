<template>
    <div class="tc-accordion tc-accordion-style1x" id="course__sections__accordion">
        <div class="panel border mb-1" v-for="section in course.sections" :key="section.uuid">
            <h4 class="acdn-title course__detail">
                <a data-toggle="collapse" data-parent="#course__sections__accordion" 
                    :href="`#section-${section.id}`" class="d-flex justify-content-between collapsed" aria-expanded="false">
                    <span class="ml-4">{{ section.title }}</span>
                    <span class="font-13">{{ section.durationHMS }}</span>
                </a>
            </h4>
            <div :id="`section-${section.id}`" class="panel-collapse collapse bg-white" aria-expanded="false">
                <div class="acdn-body p-0">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item" v-for="lesson in section.lessons" :key="lesson.uuid">
                            <template v-if="user_can_access">
                                <a :href="`/course/${course.slug}/learn/v1/lecture/${lesson.uuid}`" 
                                    class="font-14 d-flex justify-content-between">
                                    <div>
                                        <i class="fa fa-play-circle" v-if="lesson.content_type=='video'"></i>
                                        <i class="fa fa-file-alt" v-else-if="lesson.content_type=='article'"></i>
                                        <i class="fa fa-file-alt" v-else></i>
                                        {{ lesson.title }}
                                    </div>
                                    
                                    <div>
                                        <span class="mr-2" v-if="lesson.preview">
                                        {{ trans('strings.preview') }}
                                        </span>
                                        <span>{{ lesson.durationHMS }}</span>
                                    </div>
                                </a>
                            </template>
                            <template v-else>
                                <!-- <a href="#" class="font-14 d-flex justify-content-between"
                                    v-if="lesson.preview">
                                    <div>
                                        <i class="fa fa-play-circle" v-if="lesson.content_type=='video'"></i>
                                        <i class="fa fa-file-alt" v-else-if="lesson.content_type=='article'"></i>
                                        <i class="fa fa-file-alt" v-else></i>
                                        {{ lesson.title }}
                                    </div>
                                    
                                    <div>
                                        <span class="mr-2" v-if="lesson.preview">
                                            {{ trans('strings.preview') }}
                                        </span>
                                        <span>{{ lesson.durationHMS }}</span>
                                    </div>
                                </a> -->
                                <div class="font-14 d-flex justify-content-between">
                                    <div>
                                        <i class="fa fa-play-circle" v-if="lesson.content_type=='video'"></i>
                                        <i class="fab fa-youtube" v-else-if="lesson.content_type=='youtube'"></i>
                                        <i class="fa fa-file-text-o" v-else-if="lesson.content_type=='article'"></i>
                                        <i class="fa fa-file-text-o" v-else></i>
                                        {{ lesson.title }}
                                    </div>
                                    
                                    <div>
                                        <span>{{ lesson.durationHMS }}</span>
                                    </div>
                                </div>
                            </template>
                            
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>    
</template>

<script>
    
    export default {
        props: ['course', 'user_can_access']
    }
    
</script>

<style scoped lang="scss">
    .tc-accordion .acdn-title a:after {
        right: auto !important;
        font-weight: normal !important;
    }
</style>
