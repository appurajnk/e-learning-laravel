<template>
    <div class="row">
        <div class="col-md-12 mb-2">
            <button class="btn btn-success" @click.prevent="toggleCreate(true)" v-if="!creating">
                {{ trans('strings.add_new_currency') }}
            </button>
        </div>
        <div class="col-md-12" v-if="!creating">
            <fieldset>
                <legend class="scheduler-border">{{ trans('strings.site_currencies') }}</legend>
                <template v-if="site_currencies.length > 0">
                    <table class="table table-sm table-borderedx" v-if="site_currencies.length > 0">
                        <thead>
                            <th style="width: 100px;">{{ trans('strings.iso_code') }}</th>
                            <th style="width: 150px;">{{ trans('strings.name') }}</th>
                            <th style="width: 100px;">{{ trans('strings.symbol') }}</th>
                            <th style="width: 120px;">{{ trans('strings.conversion_rate') }}</th>
                            <th style="width: 100px;">{{ trans('strings.symbol_position') }}</th>
                            <th style="width: 60px;"></th>
                            <th class="bg-light" style="width: 100px;">{{ trans('strings.formatted') }}</th>
                            <th>{{ trans('strings.enabled') }}</th>
                            <th style="width: 150px;"></th>
                        </thead>
                        <tbody>
                            <currency-edit-form v-for="currency in site_currencies" :key="currency.code" :prop_currency = "currency" />
                        </tbody>
                    </table>
                </template>

                <template v-else>
                    {{ trans('strings.no_currencies') }}
                </template>

            </fieldset>

        </div>

        <div class="col-md-6 mx-auto" v-else>
            <currency-create-form />
        </div>

    </div>
</template>

<script>
import axios from 'axios'
import CurrencyEditForm from './Forms/_currency_edit_form'
import CurrencyCreateForm from './Forms/_currency_create_form'
import Form from 'vform'
export default {
    components:{
        CurrencyEditForm,
        CurrencyCreateForm
    },

    data(){
        return {
            creating: false,
            form: new Form({
                site_name: '',
                site_description: '',
                site_keywords: '',
                site_address: '',
                live: false
            }),

            site_currencies: []
        }
    },

    methods: {
        fetchCurrencies(){
            axios.get('/api/admin/currencies')
                .then(response => {
                    const currencies = response.data.data 
                    this.site_currencies = currencies.map(c => {
                        c.enabled = c.enabled==1 ? true : false
                        c.is_primary = c.is_primary==1 ? true : false
                        return c
                    })
                })
                .then(() => this.$bus.$emit('currencies:fetched', this.site_currencies))
        },


        toggleCreate(val){
            this.creating = val
        }
    },

    mounted(){
        this.fetchCurrencies()

        this.$bus.$on('currency:created', () => {
            this.creating = false 
            this.fetchCurrencies()
        })
        .$on('create:cancelled', () => {
            this.creating = false
            this.fetchCurrencies()
        })
        .$on('currency:updated', () => {
            this.creating = false
            this.fetchCurrencies()
        })  
    }
}
</script>
