<template>
    <fieldset>
        <legend class="scheduler-border">Site Languages</legend>

        <button class="btn btn-success mb-2" 
            data-backdrop="static"
            data-toggle="modal" 
            data-target="#createLang">
            <i class="fas fa-plus-circle"></i>
            {{ trans('strings.create') }}
        </button>
        <template v-if="languages.length > 0">
            <table class="table table-sm table-borderedx">
                <thead>
                    <th style="width: 150px;">{{ trans('strings.name') }}</th>
                    <th style="width: 100px;">{{ trans('strings.carbon_code') }}</th>
                    <th style="width: 100px;">{{ trans('strings.php_code') }}</th>
                    <th style="width: 150px;"></th>
                    <th style="width: 150px;"></th>
                </thead>
                <tbody>
                    <language-edit-form v-for="language in languages" :key="language.carbon_code" :language="language" />
                </tbody>
            </table>
        </template>

        <template v-else>
            {{ trans('strings.no_languages') }}
        </template>


        <!-- modal -->
        <form @submit.prevent="save">
            <div class="modal" id="createLang">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">{{ trans('strings.add_language') }}</h4>
                        </div>

                        <!-- Modal body -->
                        <div class="modal-body">
                            <div class="form-group mb-2 row">
                                <label class="col-md-3 col-form-label text-right">{{ trans('strings.name') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" 
                                        class="form-control font-14 fw-300">
                                    <has-error :form="form" field="name"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-md-3 col-form-label text-right">{{ trans('strings.code') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="form.code" :class="{ 'is-invalid': form.errors.has('code') }" 
                                        class="form-control font-14 fw-300">
                                    <has-error :form="form" field="code"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-md-3 col-form-label text-right">{{ trans('strings.php_code') }}:</label>
                                <div class="col-md-9">
                                    <input type="text" v-model="form.php_code" :class="{ 'is-invalid': form.errors.has('php_code') }" 
                                        class="form-control font-14 fw-300">
                                    <has-error :form="form" field="php_code"/>
                                </div>
                            </div>
                            <div class="form-group mb-2 row">
                                <label class="col-md-3 col-form-label text-right"></label>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mr-3 font-14 fw-300">
                                        <input id="rtl" name="is_rtl" :value="true" v-model="form.is_rtl" class="custom-control-input" type="checkbox">
                                        <label class="custom-control-label" for="rtl">
                                            {{ trans('strings.is_rtl') }}
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="custom-control custom-checkbox mr-3 font-14 fw-300">
                                        <input id="active" name="is_active" :value="true" v-model="form.is_active" class="custom-control-input" type="checkbox">
                                        <label class="custom-control-label" for="active">
                                            {{ trans('strings.is_active') }}
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-danger mr-2" @click.prevent="hideModal()">
                                {{trans('strings.close')}}
                            </button>

                            <base-button :loading="form.busy" class="btn btn-success">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                {{ trans('strings.save') }}
                            </base-button>

                        </div>

                    </div>
                </div>
            </div>
        </form>



    </fieldset>
</template>

<script>

import LanguageEditForm from './imports/LanguageEditForm'
import Form from 'vform'
export default {
    components:{
        LanguageEditForm
    },
    
    data(){
        return {
            languages: [],
            form: new Form({
                name: '',
                code: '',
                php_code: '',
                is_rtl: false,
                is_active: false
            })
        }
    },

    methods:{
        fetchLanguages(){
            axios.get('/api/admin/languages')
                .then(response => {
                    this.languages = response.data
                })
        },
        save(){
            this.form.post('/api/admin/languages')
                .then(response => {
                    this.fetchLanguages()
                    this.hideModal()
                })
        },
        hideModal(){
            $('#createLang').modal('hide')
            this.form.reset()
        }
    },

    beforeMount(){
        this.fetchLanguages()
        this.$bus.$on('language:updated', () => {
            this.fetchLanguages()
        })
    }
}
</script>

<style>
    /* @import '~bootstrap-editable/css/bootstrap-editable.css'; */
</style>