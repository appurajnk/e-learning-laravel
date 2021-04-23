<template>
    <form @submit.prevent="update" @keydown="form.onKeydown($event)">
        <alert-success :form="form" :message="trans('strings.info_updated')"/>
        <div class="row">
            <div class="col-md-8">

                <!-- Old Password -->
                <div class="form-group">
                    <label class="col-form-label">{{ trans('validation.attributes.frontend.old_password') }}</label>
                    <input v-model="form.old_password" autocomplete="OFF" :class="{ 'is-invalid': form.errors.has('old_password') }" class="form-control" type="password">
                    <has-error :form="form" field="old_password"/>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ trans('validation.attributes.frontend.password') }}</label>
                    <input v-model="form.password" autocomplete="OFF" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password">
                    <has-error :form="form" field="password"/>
                </div>
                <div class="form-group">
                    <label class="col-form-label">{{ trans('validation.attributes.frontend.password_confirmation') }}</label>
                    <input v-model="form.password_confirmation" autocomplete="OFF" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" class="form-control" type="password">
                    <has-error :form="form" field="password_confirmation"/>
                </div>

                <button :disabled="form.busy" :class="{ 'btn-loading': form.busy }" class="btn btn-danger btn-md rounded-0">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </button>
            </div><!--/ END RIGHT SIDE -->
        
        </div>
    </form>
</template>

<script>
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    export default {
        props:['settings'],
        data(){
            return {
                form: new Form({
                    old_password: '',
                    password: '',
                    password_confirmation: ''
                }),
            }
        },
        
        methods: {
            update(){
                this.form.put(`/api/settings/password`)
                    .then(res => location.reload())
            }
        }
    }
</script>
