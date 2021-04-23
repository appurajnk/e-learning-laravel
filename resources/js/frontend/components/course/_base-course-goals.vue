<template>
    <div class="row my-3">
        <div class="col-md-12">
            <div class="bg-light p-3 border">
                <div class="course__content d-flex mb-3 justify-content-between">
                    <h1 class="fw-500 font-24">
                        {{ trans('strings.what_you_will_learn') }}
                    </h1>
                </div>
                <div class="course__detail__what_you_will_learn mb-4 font-13">
                    <ul class="fa-ul font-14 rowx">
                        <li class="col-md-4x mb-3 mr-2 pl-0" v-for="goal in course.what_to_learn" :key="goal.id">
                            <i class="fa-li fa fa-check-circle"></i> {{ goal.text }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
    
    export default {
        props: ['course']
    }
</script>