<template>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-success btn-sm" v-if="!creating" @click.prevent="showCreate()">
                {{ trans('strings.create') }}
            </button>
        </div>
        <div class="col-md-6">
            <div class="dd" id="nestable3">
                <ol class="dd-list">
                    <li class="dd-item dd3-item" v-for="category in categories" :key="category.id" 
                        :data-id="category.id">
                        <div class="dd-handle dd3-handle">{{ trans('strings.drag') }}</div>
                        <div class="dd3-content">
                            <div class="d-flex justify-content-between">
                                <div>
                                    {{ category.name }}
                                </div>
                                <div>
                                    <a href="#" class="mr-2" @click.prevent="selectCategory(category.id)">
                                        {{ trans('strings.edit') }}
                                    </a>
                                    <a href="#" class="text-danger" v-if="category.children.length == 0"
                                        @click.prevent="destroy(category.id)">
                                        {{ trans('strings.delete') }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <ol class="dd-list" v-if="category.children.length">
                            <li class="dd-item dd3-item" 
                                v-for="child in category.children" :key="child.id"
                                :data-id="child.id" data-type="child" :data-total="child.total_courses">
                                <div class="dd-handle dd3-handle">{{ trans('strings.drag') }}</div>
                                <div class="dd3-content">
                                    <div class="d-flex justify-content-between">
                                        <div>
                                            {{ child.name }}
                                            <span class="badge badge-pill badge-secondary">{{ child.total_courses }}</span>
                                        </div>
                                        <div> 
                                            <a href="#" class="mr-2" @click.prevent="selectCategory(child.id)">
                                                {{ trans('strings.edit') }}
                                            </a>
                                            <a href="#" class="text-danger" v-if="child.courses.length == 0"
                                                @click.prevent="destroy(child.id)">
                                                {{ trans('strings.delete') }}
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        </ol>
                    </li>
                </ol>
            </div>

        </div>

        <!-- EDIT FORM -->
        <div class="col-md-6">
            <template v-if="editing">
                <form @submit.prevent="update()" class="form-horizontal p-3 bg-light border">
                    <div class="form-group mb-1">
                        <label for="inputEmail3 control-label mb-0">
                            {{ trans('strings.name') }}
                        </label>
                        <input class="form-control" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }">
                        <has-error :form="form" field="name"/>
                    </div>
                    <base-button :loading="form.busy" class="btn btn-info pull-right">
                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                        {{ trans('strings.update') }}
                    </base-button>

                    <button class="btn btn-danger" @click.prevent="cancel()">
                        {{ trans('strings.cancel') }}
                    </button>
                </form>
            </template>

            <template v-if="creating">
                <form @submit.prevent="store()" class="form-horizontal p-3 bg-light border">
                    <div class="form-group mb-0">
                        <label for="inputEmail3" class="control-label mb-0">
                            {{ trans('strings.parent') }}
                        </label>
                        <select class="form-control" v-model="createForm.parent"
                            :class="{ 'is-invalid': createForm.errors.has('decision') }">
                            <option v-for="cat in categories" :key="cat.id" 
                                :value="cat.id">{{ cat.name }}</option>    
                        </select>
                        <has-error :form="createForm" field="parent"/>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail3" class="control-label mb-0">
                            {{ trans('strings.name') }}
                        </label>
                        <input class="form-control" v-model="createForm.name" :class="{ 'is-invalid': createForm.errors.has('name') }">
                        <has-error :form="createForm" field="name"/>
                    </div>
                    <base-button :loading="createForm.busy" class="btn btn-info pull-right">
                        <i class="fas fa-spinner fa-spin" v-if="createForm.busy"></i>
                        {{ trans('strings.save') }}
                    </base-button>

                    <button class="btn btn-danger" @click.prevent="cancel()">
                        {{ trans('strings.cancel') }}
                    </button>
                </form>
            </template>

        </div>

    </div>
               
</template>

<script>
import Form from 'vform'
export default {
    head() {
        return {
            script: [{
                // src: "https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.slim.min.js"
            }]
        };
    },
    data(){
        return {
            categories: [],
            editing: false,
            creating: false,
            form: new Form({
                id: '',
                name: '',
                icon: ''
            }),
            icon: { name: 'newspaper', type: 'fontawesome',color:"#AD2727"},
            createForm: new Form({
                parent: '',
                name: '',
                icon: ''
            })
        }
    },

    methods:{
        fetchCategories(){
            axios.get('/api/admin/categories')
                .then(response => {
                    this.categories = response.data.data
                    this.editing = false 
                    this.form.reset()
                })
                
        },
        saveOrder(data){
            axios.post('/api/admin/update_categories_order', data)
                .then( response => {
                   this.categories = response.data.data
                   $('.dd').nestable('destroy')
                })
                .then(() => {
                    this.renderNests()
                })
        },

        store(){
            this.createForm.post('/api/admin/categories')
                .then(res => {
                    this.cancel()
                    this.fetchCategories()
                })
        },

        destroy(id){
            this.$dialog.confirm({title: this.trans('strings.confirm_delete') }, {animation: 'fade'})
                    .then(dialog => {
                        axios.delete(`/api/admin/category/${id}`)
                            .then(() => {
                                this.fetchCategories()
                            })
                    })
        },

        selectCategory(id){
            axios.get(`/api/admin/category/${id}`)
                .then(response => {
                    const cat = response.data.data
                    this.form.name = cat.name
                    this.form.icon = cat.image
                    this.form.id = cat.id
                })
                .then(() => {
                    this.editing = true
                })
        },

        cancel(){
            this.form.reset()
            this.createForm.reset()
            this.editing = false 
            this.creating = false
        },

        update(){
            this.form.put(`/api/admin/category/${this.form.id}`)
                .then(() => {
                    this.fetchCategories()
                })
        },

        async showCreate(){
            this.editing = await false
            this.creating = await true 
        },

        renderNests(){
            $('.dd')
                .nestable({ 
                    maxDepth: 2,
                    callback: (l,e) => {
                        const data = $('.dd').nestable('serialize')
                        this.saveOrder(data)
                    },
                    onDragStart: (l,e) => {}
                })
        }

    },


    async mounted(){
        await this.fetchCategories()
        setTimeout(async () => {
            await this.renderNests()
        }, 200)
        
    }

}
</script>


<style type="text/css">
@import 'https://cdnjs.cloudflare.com/ajax/libs/nestable2/1.6.0/jquery.nestable.min.css';

.nestable-lists {
    display: block;
    clear: both;
    padding: 30px 0;
    width: 100%;
    border: 0;
    border-top: 2px solid #ddd;
    border-bottom: 2px solid #ddd;
}


@media only screen and (min-width: 700px) {

    .dd {
        float: left;
        width: 100%;
    }

    .dd + .dd {
        margin-left: 2%;
    }

}

.dd-hover > .dd-handle {
    background: #2ea8e5 !important;
}

/**
 * Nestable Draggable Handles
 */

.dd3-content {
    display: block;
    height: 40px;
    margin: 5px 0;
    padding: 10px 10px 10px 40px;
    color: #333;
    text-decoration: none;
    font-weight: bold;
    border: 1px solid #ccc;
    background: #fafafa;
    box-shadow: 0 0 1px 1px rgba(20,23,28,.01), 
                0 2px 1px 0 rgba(20,23,28,.01);
    -webkit-border-radius: 3px;
    border-radius: 3px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    background: -webkit-linear-gradient(to top, #fafafa 0%, #eee 100%);
    background: -moz-linear-gradient(to top, #fafafa 0%, #eee 100%);
    background: linear-gradient(to top, #fafafa 0%, #eee 100%);
}

.dd3-content:hover {
    color: #2ea8e5;
    background: #fff;
}

.dd-dragel > .dd3-item > .dd3-content {
    margin: 0;
}

.dd3-item > button {
    margin-left: 30px;
    margin-top: 10px;
    font-weight: bold;
}

.dd{
    max-width: 800px;
}
.dd3-handle {
    position: absolute;
    margin: 0;
    left: 0;
    top: 0;
    cursor: pointer;
    width: 30px;
    text-indent: 30px;
    white-space: nowrap;
    overflow: hidden;
    border: 1px solid #2c3e4d;
    background: #2c3e4d;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
}
.dd-handle {
    height: 40px;
    padding: 5px 10px;
    cursor: move;
}
.dd3-handle:after {
    display: block;
    content: '≡';
    /* font-family: "Font Awesome 5 Free"; */
    position: absolute;
    left: 0;
    top: 10px;
    width: 100%;
    text-align: center;
    text-indent: 0;
    color: #fff;
    font-size: 20px;
    font-weight: 200;
}

.dd3-handle:hover {
    background: #5e7486;
}

</style>