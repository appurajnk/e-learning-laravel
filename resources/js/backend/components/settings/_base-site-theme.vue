<template>
    <form @submit.prevent="save">
        <div class="form-group">
            <p>{{ trans('strings.theme_editor_explanation')}}</p>
        </div>
        <div class="form-group">
            <prism-editor 
                v-model="form.code" 
                :lineNumbers="false"
                :autoStyleLineNumbers="false"
                language="css"></prism-editor>
        </div>
        <base-button :loading="form.busy" class="btn btn-lg rounded-0 btn-success"> 
            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
            {{ trans('strings.save') }}
        </base-button>
    </form>
</template>

<script>
import Form from 'vform'
import "prismjs";
import "prismjs/themes/prism.css";
import PrismEditor from 'vue-prism-editor'
export default {
    components: {
        PrismEditor
    },

    data(){
        return {
            form: new Form({
                code: ''
            })
        }
    },

    methods: {
        save(){
            this.form.post('/api/admin/settings/theme')
                .then(res => {
                    //
                })
        },

        getStyles(){
            axios.get('/api/admin/settings/theme')
                .then(response => {
                    this.form.code = response.data
                })
        }
    },

    beforeMount(){
        this.getStyles()
    }
}
</script>

<style>

</style>