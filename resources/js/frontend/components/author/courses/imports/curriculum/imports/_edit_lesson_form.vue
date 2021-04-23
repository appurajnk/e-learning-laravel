<template>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <div class="form-group">
            <input type="text" v-model="form.title" :class="{ 'is-invalid': form.errors.has('title') }" 
                :placeholder="trans('strings.title')" class="form-control font-14 fw-300">
            <has-error :form="form" field="title"/>
        </div>
        
        <div class="form-group">
            <textarea v-autosize="form.description" v-model="form.description" :class="{ 'is-invalid': form.errors.has('description') }" :placeholder="trans('strings.description')" class="form-control font-14 fw-300"></textarea>
            <has-error :form="form" field="description"/>
        </div>
        
        <base-button :loading="form.busy" class="btn btn-danger font-12 fw-500 pull-right">
            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
            {{ trans('strings.save') }}
        </base-button>
        
        <a href="#" @click.prevent="cancel()">
            {{ trans('strings.cancel') }}
        </a>
        
    </form>
</template>

<script>
    import Form from 'vform'
    
    export default {
        name: 'EditLessonForm',
        props: ['lesson'],
        data: () => ({
            form: new Form({
                title: '',
                description: ''
            })
        }),
    
        methods: {
            update(){
                this.form.put(`/api/lessons/${this.lesson.id}`)
                    .then(response => {
                        this.form.reset()
                        this.$bus.$emit('lesson.editEnd', this.lesson.id)
                    })
            },
            
            cancel(){
                this.form.reset()
                this.$bus.$emit('lesson.editEnd', this.lesson.id)
            }
            
        },
        
        mounted(){
            this.form.title = this.lesson.title
            this.form.description = this.lesson.description
        }
        
        
    }
</script>
