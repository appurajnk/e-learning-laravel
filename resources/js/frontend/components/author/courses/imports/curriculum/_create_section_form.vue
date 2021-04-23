<template>
    <div>
        <div class="font-weight-bold mb-2">
            <h3 class="">
                {{ trans('strings.create_new') }}
            </h3>
        </div>
        <form @submit.prevent="create" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                    :placeholder="trans('strings.title')" class="form-control font-14 fw-300">
                <has-error :form="form" field="title"/>
            </div>
            
            <div class="form-group">
                <textarea v-autosize="form.objective" v-model="form.objective" :class="{ 'is-invalid': form.errors.has('objective') }" :placeholder="trans('strings.objective')" class="form-control font-14 fw-300"></textarea>
                <has-error :form="form" field="objective"/>
            </div>
            
            <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ trans('strings.create') }}
            </base-button>
        </form>
    </div>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'CreateSectionForm',
        props:['course_id', 'findSectionsByCourse'],
        
        data: () => ({
            form: new Form({
                title: '',
                objective: ''
            })
        }),
    
        methods: {
            create(){
                this.form.course = this.course_id
                this.form.post(`/api/sections`)
                    .then(response => {
                        this.findSectionsByCourse()
                        this.form.reset()
                    })
            },
            
            
        }
    }
</script>
