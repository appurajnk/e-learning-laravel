<template>
    <div>
        <div class="font-weight-bold mb-2">
            <h3 class="">
                {{ trans('strings.new_lesson') }}
            </h3>
        </div>
        <form @submit.prevent="create" @keydown="form.onKeydown($event)">
            <div class="form-row mb-4">
                <div class="col-md-6">
                    <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                        :placeholder="trans('strings.title')" class="form-control font-14 fw-300">
                    <has-error :form="form" field="title"/>
                </div>
                <div class="col-md-6">
                    <select  v-model="form.section" :class="{ 'is-invalid': form.errors.has('section') }" 
                        :placeholder="trans('strings.section')" class="form-control font-14 fw-300">
                        <option :value="null" disabled>{{ trans('strings.choose_section') }}</option>
                        <option v-for="section in sections" :key="section.id" :value="section.id">{{ section.title }}</option>
                    </select>
                    <has-error :form="form" field="section"/>
                </div>
            </div>
            
            <div class="form-group">
                <textarea v-autosize="form.description" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" :placeholder="trans('strings.description')" class="form-control font-14 fw-300"></textarea>
                <has-error :form="form" field="description"/>
            </div>
            
            <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ trans('strings.create') }}
            </base-button>
            
            <a href="#" @click.prevent="cancel()">
                {{ trans('strings.cancel') }}
            </a>
            
        </form>
    </div>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'CreateLessonForm',
        props: ['sections'],
        data: () => ({
            form: new Form({
                title: '',
                description: '',
                section: null,
                lesson_type: 'lecture'
            })
        }),
    
        methods: {
            create(){
                this.form.post(`/api/lessons`)
                    .then(response => {
                        this.$bus.$emit('lesson:created', this.form.section)
                        this.$bus.$emit('lesson:createEnd', null)
                        this.form.reset()
                    })
            },
            
            cancel(){
                this.form.reset()
                this.$bus.$emit('lesson:createEnd', null)
            }
            
        }
        
    }
</script>
