<template>
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="course__content py-2 d-flex justify-content-between">
                <base-heading :text="trans('strings.requirements')"></base-heading>
            </div>
            
            <div class="pop__course_what_you_learn mb-4">
                <ul class="ml-3 styled-square font-14">
                    <li class="mb-2" v-for="requirement in course.requirements" :key="requirement.uuid">
                        {{ requirement.text }}
                    </li>
                </ul>
            </div>
        </div>
    </div>
    
</template>

<script>
    
    export default {
        props: ['course']
    }
</script>