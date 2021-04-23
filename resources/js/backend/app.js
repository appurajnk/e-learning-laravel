
import '../bootstrap'
import '@coreui/coreui'
import Vue from 'vue';
window.Vue = Vue;
window.webuiPopover =  require('webui-popover')
window.moment = require('moment')
Vue.prototype.$moment = require('moment')

window.nestable = require('./plugins/nestable2')
import store from '../store'

import './components/index';
import '../components';
import '../mixins';

import { DatePicker, Switch, Checkbox } from 'element-ui'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
import 'element-ui/lib/theme-chalk/index.css'
locale.use(lang)
Vue.use(DatePicker)
Vue.use(Switch)
Vue.use(Checkbox)




Vue.prototype.trans = (string, args) => {
    let value = _.get(window.i18n, string);
    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};


const app = new Vue({
    el: '#app',
    store,


    data: function () {
        return {
            showAdvancedOptions: false,
        }
    },

    methods: {
        submitTrans: function(event) {
            event.target.form.submit();
        },

        toggleAdvancedOptions(event) {
            event.preventDefault();
            this.showAdvancedOptions = !this.showAdvancedOptions;
        }
    }
});