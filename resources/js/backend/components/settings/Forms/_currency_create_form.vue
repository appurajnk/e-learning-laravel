<template>
    <div class="card card-body bg-light">
        <form @submit.prevent="create">
            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.name') }}</label>
                <div class="col-md-8">
                    <input type="text" v-model="form.name" class="form-control" :class="{ 'is-invalid': form.errors.has('name') }"/>
                    <has-error :form="form" field="name"></has-error>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.code') }}</label>
                <div class="col-md-8">
                    <input type="text" v-model="form.code" class="form-control" :class="{ 'is-invalid': form.errors.has('code') }"/>
                    <has-error :form="form" field="code"></has-error>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.conversion_rate') }}</label>
                <div class="col-md-8">
                    <input type="text" v-model="form.conversion_rate" class="form-control" :class="{ 'is-invalid': form.errors.has('conversion_rate') }"/>
                    <has-error :form="form" field="conversion_rate"></has-error>
                </div>
            </div>
            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.symbol') }}</label>
                <div class="col-md-8">
                    <input type="text" v-model="form.symbol" class="form-control" :class="{ 'is-invalid': form.errors.has('symbol') }"/>
                    <has-error :form="form" field="symbol"></has-error>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.symbol_position') }}</label>
                <div class="col-md-8">
                    <select class="form-control" v-model="form.symbol_position" :class="{ 'is-invalid': form.errors.has('symbol_position') }">
                        <option value="left">{{ trans('strings.left') }}</option>
                        <option value="right">{{ trans('strings.right') }}</option>
                    </select>
                    <has-error :form="form" field="symbol_position"></has-error>
                </div>
            </div>

            <div class="form-group row mb-0">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.space_between') }}</label>
                <div class="col-md-8">
                    <el-switch
                        style="display: block"
                        v-model="form.space_between"
                        active-color="#13ce66"
                        inactive-color="#ff4949"
                        active-text=""
                        inactive-text="">
                    </el-switch>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-md-4 text-right form-control-label">{{ trans('strings.status') }}</label>
                <div class="col-md-8">
                    <el-switch
                        style="display: block"
                        v-model="form.enabled"
                        active-color="#13ce66"
                        inactive-color="#ff4949"
                        active-text="Enabled"
                        inactive-text="">
                    </el-switch>
                </div>
            </div>

            <div class="form-group text-center mt-2">
                <base-button :loading="form.busy">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
                <button class="btn btn-danger ml-2" @click.prevent="cancel()">{{ trans('strings.cancel') }}</button>
            </div>
        </form>
    </div>
</template>



<script>
import Form from 'vform'
import axios from 'axios'
export default {
    data(){
        return {
            form: new Form({
                name: '',
                is_primary: true,
                conversion_rate: 1,
                symbol: '',
                code: '',
                symbol_position: 'left',
                space_between: false,
                enabled: true
            })
        }
    },

    methods:{
        create(){
            this.form.post('/api/admin/currencies')
                .then(() => {
                    this.$bus.$emit('currency:created', null)
                })
        },

        cancel(){
            this.$bus.$emit('create:cancelled', null)
        }
        
    }
}
</script>
