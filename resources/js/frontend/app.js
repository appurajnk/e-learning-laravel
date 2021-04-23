import '../bootstrap';
import '../plugins';
import Vue from 'vue';
import store from '../store'
// dynamically load components
import './components/index';
import '../components';
import '../mixins';

window.Vue = Vue;
window.webuiPopover =  require('webui-popover')
window.moment = require('moment')
Vue.prototype.$moment = require('moment')

import { 
    DatePicker, 
    Button, 
    Switch, 
    Checkbox, 
    Select, 
    Option, 
    MessageBox, 
    Message, 
    OptionGroup, 
    Upload, 
    Progress,
    Dropdown,
    DropdownMenu,
    DropdownItem,

} from 'element-ui'
import lang from 'element-ui/lib/locale/lang/en'
import locale from 'element-ui/lib/locale'
locale.use(lang)
import 'element-ui/lib/theme-chalk/index.css'
Vue.use(DatePicker)
Vue.use(Switch)
Vue.use(Checkbox)
Vue.use(Select)
Vue.use(Option)
Vue.use(OptionGroup)
Vue.use(Upload)
Vue.use(Progress)
Vue.use(Button)
Vue.use(Dropdown)
Vue.use(DropdownMenu)
Vue.use(DropdownItem)


/* ENABLE STRICT MODE */
Vue.config.strict = true;

Vue.prototype.$vmessage = Message;
Vue.prototype.$vconfirm = MessageBox.confirm;

// credit: https://medium.com/@serhii.matrunchyk/using-laravel-localization-with-javascript-and-vuejs-23064d0c210e
//window.$trans = (string) => _.get(window.i18n, string);
// Vue.prototype.trans = string => _.get(window.i18n, string);
Vue.prototype.trans = (string, args) => {
    let value = _.get(window.i18n, string);
    _.eachRight(args, (paramVal, paramKey) => {
        value = _.replace(value, `:${paramKey}`, paramVal);
    });
    return value;
};

const app = new Vue({
    el: '#app',
    store
});

