<template>
    <div>
        <span v-if="!editing" @click="startEditing"
            class="text-primary" style="cursor: pointer; text-decoration: underline; text-decoration-style: dotted;">
            <span v-if="form.value">{{ form.value }}</span>
            <span v-else class="font-italic text-danger">Empty</span>
        </span>
        <div v-if="editing">
            <div class="d-flex">
                <textarea class="form-control mb-1" v-model="form.value"></textarea>
                <div class="text-right">
                    <button class="btn btn-sm btn-success mb-1" @click="save()"><i class="fas fa-save"></i></button>
                    <button class="btn btn-sm btn-danger" @click="cancelled()"><i class="fas fa-times"></i></button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Form from 'vform'
export default {
    props: ['data'],
    data(){
        return {
            editing: false,
            old_val: '',
            form: new Form({
                value: '',
                group: '',
                locale: '',
                key: ''
            })
        }
    },

    watch: {
        data(newVal){
            this.form.value = newVal.value
            this.form.group = newVal.group
            this.form.locale = newVal.locale
            this.form.key = newVal.key
        }
    },

    methods: {
        async save(){
            if(this.data.id){
                this.form.put(`/api/admin/locales/${this.data.id}/update`)
                    .then(response => {
                        this.editing = false
                    })
            } else {
                this.form.post(`/api/admin/locales`)
                    .then(response => {
                        this.editing = false
                    })
            }
        },

        cancelled(){
            this.form.value = this.old_val
            this.editing = false 
        },

        async startEditing(){
            this.old_val = await this.form.value
            this.editing = await true
            if(!this.data.value){
                await axios.get(`/api/admin/locale/get_default/${this.data.key}`)
                    .then(response => {
                        this.form.value = response.data.value
                    })
            }
            
        }
    },

    beforeMount(){
        this.form.value = this.data.value
        this.form.group = this.data.group
        this.form.locale = this.data.locale
        this.form.key = this.data.key
    }
}
</script>