<template>
    <div class="col-md-3 col-sm-6">
        <div class="bg-white">
            <div class="post-grid-item border border-secondary">
                <div class="post-grid-img">
                    <a :href="`/course/${course.slug}/learn/v1/overview`">
                        <img :src="course.images.thumbnail" />
                    </a>
                </div>
                <div class="post-grid-content p-2">
                    <div class="post-grid-head">
                        <h3 class="font-14 mb-1 fw-600">
                            <a :href="`/course/${course.slug}/learn/v1/overview`">
                                {{ course.title | truncate(30) }}
                            </a>
                        </h3>
                        <ul class="post-grid-meta font-12 mb-3">
                            <li>
                                {{ trans('strings.by') }} 
                                <a :href="`/user/${course.author.username}`">
                                    {{ course.author.full_name | truncate(30) }}
                                </a>
                            </li>
                        </ul>
                        <ul class="post-grid-meta mt-2">
                            <li class="mb-1">
                                <div class="progress" style="height:3px">
                                    <div class="progress-bar bg-danger" 
                                        :style="`width: ${course.percent_completed}%;`">
                                    </div>
                                </div>
                            </li>
                            <li class="text-muted font-12">
                                {{ trans('strings.percent_completed', {percent: course.percent_completed}) }}
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
</template>

<script>
    export default{
        name: 'UserCourseCard',
        props: ['course']
    }
</script>