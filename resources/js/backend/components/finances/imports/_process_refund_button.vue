<template>
    <form @submit.prevent="submit">
        <base-button :loading="form.busy" class="btn btn-danger btn-md rounded-0">
            <span v-if="form.busy">
                <i class="fas fa-spinner fa-spin"></i>
                {{ trans('strings.processing') }}
            </span>
            <span v-else>
                {{ trans('strings.process_refund') }}
            </span>
        </base-button>
    </form>
</template>

<script>
    import Form from 'vform'
    
    export default {
        
        props:[ 'uuid' ],
        
        data(){
            return {
                form: new Form({})
            }
        },
        
        methods: {
            submit(){
                this.form.post(`/api/admin/refunds/${this.uuid}/process`)
                    .then(response => {
                        this.$emit('refund-processed')
                    })
            }
            
        }
        
    }
    
    
</script>