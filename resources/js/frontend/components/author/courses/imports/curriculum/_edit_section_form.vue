<template>
    <div>
        <div class="font-weight-bold mb-2">
            <h3 class="">
                {{ trans('strings.edit_section') }}
            </h3>
        </div>
        <form @submit.prevent="save" @keydown="form.onKeydown($event)">
            <div class="form-group">
                <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                    :placeholder="trans('strings.title')" class="form-control font-14 fw-300">
                <has-error :form="form" field="title"/>
            </div>
            
            <div class="form-group">
                <textarea v-autosize="form.objective" v-model="form.objective" :class="{ 'is-invalid': form.errors.has('objective') }" :placeholder="trans('strings.objective')" class="form-control font-14 fw-300"></textarea>
                <has-error :form="form" field="objective"/>
            </div>
            
            <a href="#" @click.prevent="cancel()">{{ trans('strings.cancel') }}</a>
            
            <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                {{ trans('strings.save') }}
            </base-button>
        </form>
    </div>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'EditSectionForm',
        
        props:['section'],
        
        data: () => ({
            form: new Form({
                title: '',
                objective: ''
            })
        }),
    
        methods: {
            save(){
                let id = this.section.id
                this.form.put(`/api/sections/${id}`)
                    .then(response => {
                        this.cancel()
                    })
            },
            
            cancel(){
                this.form.reset()
                this.$bus.$emit('section.editEnd', null)
            },
            
            loadFormFields(){
                this.form.keys().forEach(key => {
                    this.form[key] = this.section[key]
                })
            }
            
            
        },
        
        mounted(){
            this.$watch('section', section => {
                this.loadFormFields()
              }, {immediate:true})
        }
        
        
    }
</script>
