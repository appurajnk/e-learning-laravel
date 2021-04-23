<template>
    <div class="setting-body white-bg-color">
        
        <form @submit.prevent="save" @keyup="handleKeyUp($event)">
            <!--- WHAT TO LEARN -->
            <div class="py-3 font-18">
                <h1>
                    {{ trans('strings.what_will_students_learn') }}
                </h1>
            </div>
            <draggable 
                style="min-height: 10px;"
                v-model="form.what_to_learn.items"
                :options="{draggable:'.dragme', handle: '.draghandle', group:'GoalsGroup', ghostClass: 'sortable-ghost'}"  
                @change="updateDraggable('what_to_learn')">
                <div class="input-group mb-2 dragme" v-for="(what_to_learn,index) in form.what_to_learn.items" :key="`wtl-${index}`" :id="`wtl-${index}`">
                    <input type="text" v-model="form.what_to_learn.items[index].text" 
                        class="form-control rounded-0 font-14 fw-300" :class="{ 'is-invalid': form.errors.has(`what_to_learn.items.${index}.text`) }">
                    <div class="input-group-append rounded-0">
                        <span class="input-group-text rounded-0 btn btn-danger" @click.prevent="handleRemove('what_to_learn',index)"><i class="fa fa-trash"></i></span>
                        <span class="input-group-text rounded-0 draghandle"><i class="fa fa-bars"></i></span>
                    </div>
                    <has-error :form="form" :field="`what_to_learn.items.${index}.text`"></has-error>
                </div>
            </draggable>
            <div class="form-group mt-3">
                <a href="" @click.prevent="handleAddEvent('what_to_learn')">
                    <i class="fa fa-plus"></i>
                    {{ trans('strings.add_an_answer') }}
                </a>
            </div>
            
            <hr class="mb-4 mt-4" /> 
            
            
            <!--- PREREQUISITES -->
            <div class="py-3 font-18">
                <h1>
                    {{ trans('strings.course_requirements') }}
                </h1>
            </div>
            <draggable 
                style="min-height: 10px;"
                v-model="form.requirement.items"
                :options="{draggable:'.dragme', handle: '.draghandle', group:'RequirementsGroup', ghostClass: 'sortable-ghost'}" 
                @change="updateDraggable('requirement')">
                <div class="input-group mb-2 dragme" v-for="(requirement,index) in form.requirement.items" :key="`req-${index}`" :id="`req-${index}`">
                    <input type="text" v-model="form.requirement.items[index].text" 
                        class="form-control rounded-0 font-14 fw-300" :class="{ 'is-invalid': form.errors.has(`requirement.items.${index}.text`) }">
                    <div class="input-group-append rounded-0">
                        <span class="input-group-text rounded-0 btn btn-danger" @click.prevent="handleRemove('requirement',index)"><i class="fa fa-trash"></i></span>
                        <span class="input-group-text rounded-0 draghandle"><i class="fa fa-bars"></i></span>
                    </div>
                    <has-error :form="form" :field="`requirement.items.${index}.text`"></has-error>
                </div>
            </draggable>
            
            <div class="form-group mt-3">
                <a href="" @click.prevent="handleAddEvent('requirement')">
                    <i class="fa fa-plus"></i>
                    {{ trans('strings.add_a_requirement') }}
                </a>
            </div>
            
            <!--- TARGET STUDENTS -->
            <hr class="mb-4 mt-4" />
            
            <div class="py-3 font-18">
                <h1>
                    {{ trans('strings.who_are_target_students') }}
                </h1>
            </div>
            
            <draggable 
                style="min-height: 10px;"
                v-model="form.target_student.items"
                :options="{draggable:'.dragme', handle: '.draghandle', group:'TargetStudentsGroup', ghostClass: 'sortable-ghost'}" 
                @change="updateDraggable('target_student')">
                <div class="input-group mb-2 dragme" v-for="(target_student,index) in form.target_student.items" :key="`ts-${index}`" :id="`ts-${index}`">
                    <input type="text" v-model="form.target_student.items[index].text" 
                        class="form-control font-14 rounded-0 fw-300" :class="{ 'is-invalid': form.errors.has(`target_student.items.${index}.text`) }">
                    <div class="input-group-append rounded-0">
                        <span class="input-group-text rounded-0 btn btn-danger" @click.prevent="handleRemove('target_student',index)">
                            <i class="fa fa-trash"></i>
                        </span>
                        <span class="input-group-text rounded-0 draghandle"><i class="fa fa-bars"></i></span>
                    </div>
                    <has-error :form="form" :field="`target_student.items.${index}.text`"></has-error>
                </div>
            </draggable>
            
            <div class="form-group mt-3">
                <a href="" @click.prevent="handleAddEvent('target_student')">
                    <i class="fa fa-plus"></i>
                    {{ trans('strings.add_new_target_student') }}
                </a>
            </div>
            
            <hr class="mb-4 mt-4" />       
            
            <div class="form-group text-right">
                <base-button :loading="form.busy" class="btn btn-lg btn-danger font-16 fw-500">
                    <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                    {{ trans('strings.save') }}
                </base-button>
            </div>
        </form> 
    </div>
</template>

<script>
    import axios from 'axios'
    import Form from 'vform'
    import { mapGetters } from 'vuex'
    export default {
        props: ['course'],
        data: () => ({
            loading: true,
            changed: false,
            form: new Form({
                requirement: {
                    items: []
                },
                what_to_learn: {
                    items: []
                },
                target_student: {
                    items: []
                }
            })
        }),
        watch:{
            course: {
                deep: true,
                immediate: true,
                handler(v){
                    if(Object.keys(v).length > 0) this.fetchCourseRequirements()
                }
            }
        },
        methods: {
            handleKeyUp(e){
                this.changed = true
            },
            
            handleAddEvent(action){
                if(action == 'requirement'){
                    let _item = this.form.requirement.items
                    
                    if(_item.length != 0 && _item[_item.length-1].text.trim() == ''){
                        return;
                    }
                    _item.push({
                        id: '', text: '', sortOrder: 0
                    })
                }
                
                if(action == 'what_to_learn'){
                    let _item = this.form.what_to_learn.items
                    if(_item.length != 0 && _item[_item.length-1].text.trim() == ''){
                        return;
                    }
                    _item.push({
                        id: '', text: '', sortOrder: 0
                    })
                }
                
                if(action == 'target_student'){
                    let _item = this.form.target_student.items
                    if(_item.length != 0 && _item[_item.length-1].text.trim() == ''){
                        return;
                    }
                    _item.push({
                        id: '', text: '', sortOrder: 0
                    })
                }
            },
            
            handleRemove(action,index){
                if(action == 'requirement'){
                    this.form.requirement.items.splice(index,1)
                }
                if(action == 'what_to_learn'){
                    this.form.what_to_learn.items.splice(index,1)
                }
                if(action == 'target_student'){
                    this.form.target_student.items.splice(index,1)
                }
            },
            
            save(){
                this.form.post(`/api/course/${this.course.id}/target`)
                    .then(() => {
                        this.fetchCourseRequirements()
                        this.changed = false
                    })
            },
            
            updateDraggable(action){
                this.form[action].items.map((item, index) => {
                    item.sortOrder = index+1
                })
                axios.put(`/api/course/targets/save-draggable`, this.form[action].items)
            },
            
            fetchCourseRequirements(){
                axios.get(`/api/course/${this.course.id}/target`)
                    .then(response => {
                        let res = response.data.data
                        this.form.reset()
                        res.forEach(item => {
                            this.form[item.type].items.push({
                                id: item.id,
                                text: item.text,
                                sortOrder: item.sortOrder
                            })
                        })
                        
                    })
            }
            
        },
        
        created(){
            this.loading=false
        }
    }
</script>
