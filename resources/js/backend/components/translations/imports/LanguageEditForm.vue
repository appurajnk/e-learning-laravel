<template>
    <tr>
        <td>
            <input disabled class="form-control form-control-sm" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" />
            <has-error :form="form" field="name"/>
        </td>
        <td>
            <input disabled class="form-control form-control-sm" v-model="form.carbon_code" :class="{ 'is-invalid': form.errors.has('carbon_code') }" />
            <has-error :form="form" field="carbon_code"/>
        </td>
        <td>
            <input disabled class="form-control form-control-sm" v-model="form.php_code" :class="{ 'is-invalid': form.errors.has('php_code') }"/>
            <has-error :form="form" field="php_code"/>
        </td>
        <td class="d-flex">
            <div class="custom-control custom-checkbox mr-3 font-14 fw-300">
                <input :id="`is_default${language.id}`" name="is_default" :value="true" @change="update()" v-model="form.is_default" class="custom-control-input" type="checkbox">
                <label class="custom-control-label" :for="`is_default${language.id}`">
                    {{ trans('strings.is_default') }}
                </label>
            </div>

            <div class="custom-control custom-checkbox mr-3 font-14 fw-300">
                <input :id="`is_active${language.id}`" name="is_active" :disabled="form.is_default==true"
                    :value="true" @change="update()" v-model="form.is_active" class="custom-control-input" type="checkbox">
                <label class="custom-control-label" :for="`is_active${language.id}`">
                    {{ trans('strings.is_active') }}
                </label>
            </div>
            <div class="custom-control custom-checkbox mr-3 font-14 fw-300">
                <input :id="`is_rtl${language.id}`" name="is_rtl" :value="true" @change="update()" v-model="form.is_rtl" class="custom-control-input" type="checkbox">
                <label class="custom-control-label" :for="`is_rtl${language.id}`">
                    {{ trans('strings.is_rtl') }}
                </label>
            </div>
        </td>
        <td>
            <!-- <button :disabled="form.busy" class="btn btn-sm btn-success" @click.prevent="update()">
                <i class="fas fa-save" v-if="!form.busy"></i>
                <i class="fas fa-spinner fa-spin" v-else></i>
            </button> -->
            <a :href="`/admin/translations/${language.carbon_code}/edit`" class="btn btn-sm btn-info ml-2" :disabled="form.busy">
                <i class="fa fa-globe"></i> {{ trans('strings.translations') }}
            </a>
            <button class="btn btn-sm btn-danger ml-2" :disabled="form.busy" v-if="!language.is_default" @click.prevent="destroy()">
                <i class="fa fa-trash"></i> {{ trans('strings.delete') }}
            </button>
        </td>
    </tr>
    
</template>

<script>
import Form from 'vform'
import axios from 'axios'
export default {
    props: {
        language: { type: Object, required: true },
    },

    watch:{
        language:{
            deep: true,
            handler(val){
                this.form.keys().forEach(key => {
                    this.form[key] = val[key]
                })
            }
        }
    },
    data(){
        return {
            form: new Form({
                id: '',
                name: '',
                carbon_code: '',
                php_code: '',
                name: '',
                is_rtl: false,
                is_default: false,
                is_active: false,
            })
        }
    },


    methods:{
        update(){
            this.form.put(`/api/admin/languages/${this.form.id}`)
                .then(() => this.$bus.$emit('language:updated', null))
        },

        destroy(){
            this.$dialog.confirm({
                title: this.trans('strings.confirm_delete')}, {animation: 'fade'})
                .then(dialog => {
                    axios.delete(`/api/admin/languages/${this.form.id}`) 
                        .then(() => {
                            this.$bus.$emit('language:updated', null)
                        })
                })
        },
    },

    mounted(){
        this.form.keys().forEach(key => {
            this.form[key] = this.language[key]
        })
    }
}
</script>

