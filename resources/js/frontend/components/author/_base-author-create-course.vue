<template>
    <form class="auth-form" @submit.prevent="create" @keydown="form.onKeydown($event)">
        <div class="form-label-group mb-3 floating-label">
            <input id="lname" autocomplete="no-data" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
            <label for="lname">{{ trans('strings.course_title') }}</label>
            <has-error :form="form" field="title"/>
        </div>

        <div class="form-label-group mb-1 floating-label">
            <input id="lname" autocomplete="nada" v-model="form.subtitle" :class="{ 'is-invalid': form.errors.has('subtitle') }" 
                class="form-control font-16 py-4 form-control-lg" type="text" placeholder=" ">
            <label for="lname">{{ trans('strings.course_subtitle') }}</label>
            <has-error :form="form" field="subtitle"/>
        </div>

        <div class="form-group">
            <label>{{ trans('strings.category') }}</label>
            <select class="form-control form-control-lg" style="border: 2px solid rgba(120,141,180,0.3)" 
                :class="{ 'is-invalid': form.errors.has('category') }"  v-model="form.category">
                <optgroup v-for="category in categories" :key="category.uuid" :label="category.name">
                    <option v-for="child in category.children" :key="child.uuid" :value="child.id">{{ child.name }}</option>
                </optgroup>
            </select>
            <has-error :form="form" field="category"/>
        </div>
    
        <base-button :loading="form.busy" class="btn btn-danger font-16 fw-500">
            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
            {{ trans('strings.create') }}
        </base-button>
</form>
</template>

<script>
import Form from 'vform'
export default {
    props: ['categories'],
    data: () => ({
        form: new Form({
            title: '',
            subtitle: '',
            category: ''
        })
    }),
    
    methods: {
        create(){
            this.form.post(`/api/courses`)
                .then(response => {
                    window.location.href= `/course/${response.data.uuid}/manage/basics`
                })
            
        }
    }
}
</script>

<style>

</style>