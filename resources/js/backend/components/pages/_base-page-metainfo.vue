<template>
    <div class="card card-body">
        <div class="form-group mb-0 d-flex align-items-center">
            <div class="text-primary">{{ url }}/</div>
            <div v-if="!editing">
                <span class="badge badge-secondary">{{ page.slug }}</span>
                <a href="javascript:void(0)" @click.prevent="editing=true"><i class="fas fa-pencil-alt"></i></a>
            </div>
            <div v-else class="d-flex">
                <input class="form-control form-control-sm rounded-0" 
                    v-model="form.slug" :class="{ 'is-invalid': form.errors.has('slug') }"
                    style="height: calc(1em + 0.5rem + 0px);">
                <a href="javascript:void(0)" class="text-success ml-1" @click.prevent="save">
                    <i class="fas fa-save" v-if="!form.busy"></i>
                    <i class="fas fa-spinner fa-spin" v-else></i>
                </a>
                <a href="javascript:void(0)" class="text-danger ml-2" v-if="!form.busy" @click.prevent="cancel">
                    <i class="fas fa-window-close"></i>
                </a>
            </div>
        </div>

        <hr />
        <div class="form-group">
            {{ trans('strings.status') }}: 
            <span class="badge" :class="page.published ? 'badge-success' : 'badge-warning'">
                {{ status }}
            </span>
        </div>
        <div class="form-group">
            <button :disabled="form.busy" class="btn btn-success btn-sm rounded-0" @click.prevent="togglePublish" v-if="!page.published">
                <span v-if="!form.busy">{{ trans('strings.publish') }}</span>
                <span v-else>
                    <i class="fas fa-spinner fa-spin"></i>
                    {{ trans('strings.publishing') }}
                </span>
            </button>
            <button :disabled="form.busy" class="btn btn-danger btn-sm rounded-0" @click.prevent="togglePublish" v-else>
                <span v-if="!form.busy">{{ trans('strings.unpublish') }}</span>
                <span v-else>
                    <i class="fas fa-spinner fa-spin"></i>
                    {{ trans('strings.unpublishing') }}
                </span>
            </button>
        </div>
    </div>    
</template>

<script>
import Form from 'vform'
export default {
    props: ['uuid'],
    data(){
        return {
            editing: false,
            url: window.config.url,
            page: {},
            form: new Form({
                slug: ''
            })
        }
    },

    computed: {
        status(){
            if(this.page.published) return this.trans('strings.live')
            return this.trans('strings.draft')
        }
    },

    methods:{
        getPageInfo(){
            axios.get(`/api/admin/page/${this.uuid}`)
                .then(response => {
                    this.page = response.data.data 
                    this.form.slug = response.data.data.slug
                })
        },

        cancel(){
            this.editing = false
        },

        save(){
            this.form.put(`/api/admin/page/${this.page.id}/update_slug`)
                .then(response => {
                    this.page = response.data.data 
                    this.form.slug = response.data.data.slug
                    this.editing = false
                })
        },

        togglePublish(){
            this.form.put(`/api/admin/page/${this.page.id}/toggle_publish`)
                .then(response => {
                    this.page = response.data.data 
                })
        }
    },

    beforeMount(){
        this.getPageInfo()
    }
}
</script>