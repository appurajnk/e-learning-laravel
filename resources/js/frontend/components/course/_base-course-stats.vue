<template>
    <span class="context_info font-12">
        <span class="mr-1">
            <i class="fas fa-play-circle"></i>
            {{ course.total_lessons }} {{ course.total_lessons | pluralize(trans('strings.lesson')) }}    
        </span>
        
        <span class="mr-1">
            <i class="fas fa-clock"></i>
            {{ course.total_hours }} {{ course.total_hours | pluralize(trans('strings.hour')) }}
        </span>
        
        <span class="mr-1">
            <i class="fas fa-thermometer-half"></i>
            {{ trans(`strings.${course.level}`) | capitalize }}
        </span>
        
        <span class="mr-1">
            <i class="fas fa-globe"></i>
            {{ course.language | capitalize }}
        </span>
        
    </span>
</template>

<script>
    
    export default {
        props: ['course']
    }
</script>