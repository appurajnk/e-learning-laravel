<template>
    <select class="form-control" :multiple="multiple">
        <slot></slot>
    </select>
</template>

<script>
const select2 = require('select2')
export default {
    props:{
        options: { 
            type: Array, 
            default: () => []
        },
        value: { required: true },
        multiple: { type: Boolean, default: false },
        searchable: { type: Boolean, default: true },
        valuefield: { type: String, default: 'id' },
        textfield: { type: String, default: 'text' }
    },

    computed:{
        opts(){
            const data = this.options.map(d => {
                d.id = d[this.valuefield]
                d.text = d[this.textfield]

                return d
            })
            return data
        }
    },

    watch: {
        value: function (value) {
            $(this.$el)
                .val(value)
                .trigger('change')
        },

        options: function (options) {
            $(this.$el).empty().select2({ data: this.opts })
        }
    },

    destroyed: function () {
        $(this.$el).off().select2('destroy')
    },

    mounted(){
        
        var vm = this
        $(this.$el)
            .select2({ 
                theme: 'bootstrap4',
                data: this.opts,
                placeholder: 'vm.select',
                minimumResultsForSearch: vm.searchable ? 1 : -1
            })
            .val(this.value)
            .trigger('change')
            .on('change', function () {
                vm.$emit('input', this.value)
            })

    }
}
</script>
