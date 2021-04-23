<template>
    <div class="row">
        <div class="col-md-12 mb-2">
            <button
                class="btn btn-success btn-sm"
                v-if="!creating"
                @click.prevent="showCreate()"
            >{{ trans('strings.create') }}</button>
        </div>
        <div class="col-md-6">
            <vue-nestable
                v-model="categories"
                key-prop="id"
                :max-depth="2"
                children-prop="children"
                class="list-group"
                @change="handleChange"
                :hooks="{
                    'beforeMove': beforeMove
                }"
            >
                <template slot-scope="{ item }">
                    <div class="list-group-item bg-light d-flex justify-content-between">
                        <vue-nestable-handle :item="item">
                            <i class="fas fa-bars" />
                            {{ item.name }}
                            <span
                                class="badge badge-pill badge-secondary"
                                v-if="item.courses"
                            >{{ item.courses.length }}</span>
                        </vue-nestable-handle>
                        <div>
                            <a
                                href="#"
                                class="mr-2"
                                @click.prevent="selectCategory(item.id)"
                            >{{ trans('strings.edit') }}</a>
                            <a
                                href="#"
                                class="text-danger"
                                v-if="(item.children && item.children.length == 0) || (!item.children && item.courses.length == 0)"
                                @click.prevent="destroy(item.id)"
                            >{{ trans('strings.delete') }}</a>
                        </div>
                    </div>
                </template>
            </vue-nestable>
        </div>

        <!-- EDIT FORM -->
        <div class="col-md-6">
            <template v-if="editing">
                <form @submit.prevent="update()" class="form-horizontal p-3 bg-light border">
                    <div class="form-group mb-1">
                        <label for="inputEmail3 control-label mb-0">{{ trans('strings.name') }}</label>
                        <input
                            class="form-control"
                            v-model="form.name"
                            :class="{ 'is-invalid': form.errors.has('name') }"
                        />
                        <has-error :form="form" field="name" />
                    </div>
                    <base-button :loading="form.busy" class="btn btn-info pull-right">
                        <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                        {{ trans('strings.update') }}
                    </base-button>

                    <button
                        class="btn btn-danger"
                        @click.prevent="cancel()"
                    >{{ trans('strings.cancel') }}</button>
                </form>
            </template>

            <template v-if="creating">
                <form @submit.prevent="store()" class="form-horizontal p-3 bg-light border">
                    <div class="form-group mb-0">
                        <label
                            for="inputEmail3"
                            class="control-label mb-0"
                        >{{ trans('strings.parent') }}</label>
                        <select
                            class="form-control"
                            v-model="createForm.parent"
                            :class="{ 'is-invalid': createForm.errors.has('decision') }"
                        >
                            <option
                                v-for="cat in categories"
                                :key="cat.id"
                                :value="cat.id"
                            >{{ cat.name }}</option>
                        </select>
                        <has-error :form="createForm" field="parent" />
                    </div>
                    <div class="form-group">
                        <label
                            for="inputEmail3"
                            class="control-label mb-0"
                        >{{ trans('strings.name') }}</label>
                        <input
                            class="form-control"
                            v-model="createForm.name"
                            :class="{ 'is-invalid': createForm.errors.has('name') }"
                        />
                        <has-error :form="createForm" field="name" />
                    </div>
                    <base-button :loading="createForm.busy" class="btn btn-info pull-right">
                        <i class="fas fa-spinner fa-spin" v-if="createForm.busy"></i>
                        {{ trans('strings.save') }}
                    </base-button>

                    <button
                        class="btn btn-danger"
                        @click.prevent="cancel()"
                    >{{ trans('strings.cancel') }}</button>
                </form>
            </template>
        </div>
    </div>
</template>

<script>
import Form from "vform";
import { VueNestable, VueNestableHandle } from "vue-nestable";
export default {
    components: {
        VueNestable,
        VueNestableHandle
    },
    data() {
        return {
            categories: [],
            editing: false,
            creating: false,
            form: new Form({
                id: "",
                name: "",
                icon: ""
            }),
            icon: { name: "newspaper", type: "fontawesome", color: "#AD2727" },
            createForm: new Form({
                parent: "",
                name: "",
                icon: ""
            })
        };
    },

    methods: {
        beforeMove({ dragItem, pathFrom, pathTo }) {
            // parents cannot be nested at all
            if (!dragItem.parent_id && dragItem.children.length > 0) {
                return pathTo.length === 0;
            }

            // child cannot become parent if they have courses
            if (dragItem.parent_id && dragItem.courses.length > 0) {
                return pathTo.length !== 1;
            }

            // all others can be nested
            return true;
        },
        async handleChange(value, options) {
            let categories = await options.items;
            let payload = [];
            for (let [index, category] of categories.entries()) {
                category.sortOrder = (await index) + 1;
                category.parent_id = await null;
                if (category.children && category.children.length > 0) {
                    for (let [i, child] of category.children.entries()) {
                        child.sortOrder = (await i) + 1;
                        child.parent_id = await category.id;
                    }
                }
                await payload.push(category);
            }

            await this.saveOrder(payload);
        },
        fetchCategories() {
            axios.get("/api/admin/categories").then(response => {
                this.categories = response.data.data;
                this.editing = false;
                this.form.reset();
            });
        },
        saveOrder(data) {
            axios
                .put("/api/admin/update_categories_order", data)
                .then(response => {
                    this.categories = response.data.data;
                });
        },

        store() {
            this.createForm.post("/api/admin/categories").then(res => {
                this.cancel();
                this.fetchCategories();
            });
        },

        destroy(id) {
            this.$dialog
                .confirm(
                    { title: this.trans("strings.confirm_delete") },
                    { animation: "fade" }
                )
                .then(dialog => {
                    axios.delete(`/api/admin/category/${id}`).then(() => {
                        this.fetchCategories();
                    });
                });
        },

        selectCategory(id) {
            axios
                .get(`/api/admin/category/${id}`)
                .then(response => {
                    const cat = response.data.data;
                    this.form.name = cat.name;
                    this.form.icon = cat.image;
                    this.form.id = cat.id;
                })
                .then(() => {
                    this.editing = true;
                });
        },

        cancel() {
            this.form.reset();
            this.createForm.reset();
            this.editing = false;
            this.creating = false;
        },

        update() {
            this.form.put(`/api/admin/category/${this.form.id}`).then(() => {
                this.fetchCategories();
            });
        },

        async showCreate() {
            this.editing = await false;
            this.creating = await true;
        }
    },

    async mounted() {
        await this.fetchCategories();
    }
};
</script>


<style type="text/css">
/*
* Style for nestable
*/
.nestable {
    position: relative;
}
.nestable .nestable-list {
    margin: 0;
    padding: 0 0 0 40px;
    list-style-type: none;
}
.nestable > .nestable-list {
    padding: 0;
}
.nestable-item,
.nestable-item-copy {
    margin: 10px 0 0;
}
.nestable-item:first-child,
.nestable-item-copy:first-child {
    margin-top: 0;
}
.nestable-item .nestable-list,
.nestable-item-copy .nestable-list {
    margin-top: 10px;
}
.nestable-item {
    position: relative;
}
.nestable-item.is-dragging .nestable-list {
    pointer-events: none;
}
.nestable-item.is-dragging * {
    opacity: 0;
    filter: alpha(opacity=0);
}
.nestable-item.is-dragging:before {
    content: " ";
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-color: rgba(106, 127, 233, 0.274);
    border: 1px dashed rgb(73, 100, 241);
    -webkit-border-radius: 2px;
    border-radius: 2px;
}
.nestable-drag-layer {
    position: fixed;
    top: 0;
    left: 0;
    z-index: 100;
    pointer-events: none;
}
.nestable-drag-layer > .nestable-list {
    position: absolute;
    top: 0;
    left: 0;
    padding: 0;
    background-color: rgba(106, 127, 233, 0.274);
}
.nestable [draggable="true"] {
    cursor: move;
}
.nestable-handle {
    display: inline;
}
</style>