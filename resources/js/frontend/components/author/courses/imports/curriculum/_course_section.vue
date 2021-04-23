<template>
    <div class="panel bg-light list-complete-item dragme">
        <h4 class="acdn-title clearfix">
            <a data-toggle="collapse" data-parent="#sectionAccordion" 
                :href="'#collapse'+section.id" class="draggable-panel collapsed" aria-expanded="false">
                {{ trans('strings.section') }} {{ section.sortOrder }}: 
                <span class="fa fa-file-text-o"></span> {{ section.title | truncate(50) }}
            </a>
            <span class="actions d-none pull-right mr-4 font-13">
                <i class="fas fa-arrows-alt reorder-icon mr-3"></i>
                <a href="#" @click.prevent="startEdit()">
                    <i class="fas fa-pencil-alt mr-3"></i>
                </a>
                
                <a href="#" @click.prevent="destroySection()">
                    <i class="fas fa-trash"></i>
                </a>
            </span>
        </h4>
        <div :id="'collapse'+section.id" class="panel-collapse collapse" aria-expanded="false">
            <div class="acdn-body">
                <span class="font-weight-bold">{{ trans('strings.objective') }}:</span> {{ section.objective }}
            </div>
        </div>
    </div>
</template>

<script>
    import { mapGetters, mapState } from 'vuex'
    import Form from 'vform'
    
    export default{
        name: 'CourseSection',
        
        props: ['index', 'section', 'findSectionsByCourse'],
        
        methods: {
            destroySection(){
                this.$dialog.confirm({title: this.trans('strings.confirm_delete'), body: this.trans('strings.section_delete_body')}, {animation: 'fade', loader: true})
                    .then(dialog => {
                        axios.delete(`/api/sections/${this.section.id}`)
                            .then(() => {
                                dialog.close()
                                this.findSectionsByCourse()
                            })
                            
                    })
            },
            
            startEdit(){
               this.$bus.$emit('section:editStart', this.section)
            }
        },
        
        mounted(){
            $('.acdn-title').on('mouseover', function(){
                $(this).find('.actions').removeClass('d-none');
            }).on('mouseout', function(){
                $(this).find('.actions').addClass('d-none');
            })
        }
        
        
        
    }
</script>