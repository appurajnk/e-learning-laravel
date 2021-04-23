<template>
    <div class="row mt-1">
        <div class="col">
            
            <ul class="nav nav-tabs" role="tablist">
                <li class="nav-item">
                    <a href="#approval" class="nav-link active" data-toggle="tab" role="tab" aria-controls="home">
                        <i class="fas fa-check-circle"></i> 
                        {{ trans('strings.approval') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a href="#overview" class="nav-link" data-toggle="tab" role="tab" aria-controls="profile">
                        <i class="fas fa-info-circle"></i> 
                        {{ trans('strings.course_info') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content card-min-height">
                <div class="tab-pane active" id="approval" role="tabpanel">
                    <div class="row">
                        <div class="col-md-5">
                            <div class="card">
                                <div class="card-header">
                                    {{ trans('strings.status') }}: {{ trans(`strings.${course.status_code}`) }}
                                </div>
                                <div class="card-body">
                                    <form @submit.prevent="submitApproval()" class="form-horizontal">
                                        <div class="form-group">
                                            <label for="inputEmail3 control-label">
                                                {{ trans('strings.review_comment') }}
                                            </label>
                                            <textarea class="form-control" rows="5" v-model="form.comment" :class="{ 'is-invalid': form.errors.has('comment') }"></textarea>
                                            <has-error :form="form" field="comment"/>
                                        </div>
                                        <div class="form-group">
                                            <label for="inputEmail3" class="control-label">
                                                {{ trans('strings.decision') }}
                                            </label>
                                            <select class="form-control" v-model="form.decision"
                                                :class="{ 'is-invalid': form.errors.has('decision') }">
                                                <option value="approved">{{ trans('strings.approved') }}</option>    
                                                <option value="disapproved">{{ trans('strings.disapproved') }}</option>
                                            </select>
                                            <has-error :form="form" field="decision"/>
                                        </div>
                                        
                                        <base-button :loading="form.busy" class="btn btn-info pull-right" v-if="course.published == true">
                                            <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                            {{ trans('strings.submit') }}
                                        </base-button>
                                        <div class="alert alert-danger" v-else>
                                            {{ trans('strings.author_has_not_submitted') }}
                                        </div>
                                    </form>
                                </div>
                                
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <div class="card" v-show="approvals.length">
                                <div class="card-header">
                                    {{ trans('strings.approval_history') }}
                                </div>
                                <div class="card-body">
                                    <ul class="timeline">
                                        <li class="timeline-inverted" v-for="approval in approvals" :key="approval.id">
                                            <div class="timeline-badge" :class="approval.decision == 'approved' ? 'success' : 'danger'">
                                                <i :class="`fa fa-thumbs-${ approval.decision == 'approved' ? 'up' : 'down' }`"></i>
                                            </div>
                                            <div class="timeline-panel">
                                            <div class="timeline-heading">
                                                <h6 class="timeline-title">
                                                    {{ trans(`strings.${approval.decision}`) }}
                                                </h6>
                                                <span class="time text-muted">
                                                    <i class="fa fa-clock-o"></i> {{ approval.created_at }}
                                                </span>
                                            </div>
                                            <div class="timeline-body">
                                                {{ approval.comment }}  
                                            </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane" id="overview" role="tabpanel">
                    <div class="row">
                        <div class="col">
                            <div class="card card-danger">
                                <div class="card-header">
                                    {{ trans('strings.description') }}
                                </div>
                                <div class="card-body" v-html="course.description"></div>
                            </div>
                        </div>

                        <div class="col">
                            <div class="card card-danger">
                                <div class="card-header">
                                    {{ trans('strings.statistics') }}
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col">
                                            <h5>{{ trans('strings.course_image') }}</h5>
                                            <img :src="course.images.thumbnail" class="rounded" width="100%" />
                                        </div>
                                        <div class="col">
                                            <h5>{{ trans('strings.details') }}</h5>
                                            <ul class="fa-ulx">
                                                <li><i class="sl sl-icon-camrecorder"></i> {{ trans('strings.hours_of_video_content', {number: course.total_video_hours}) }}</li>
                                                <li><i class="sl sl-icon-docs"></i> {{ course.total_articles }} {{ course.total_articles | pluralize(trans('strings.article')) }}</li>
                                                <li><i class="sl sl-icon-badge"></i> {{ trans('strings.certificate_of_completion') }}</li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>


<script>
    import Form from 'vform'
    import axios from 'axios'
    export default {
        props: ['course'],
        data(){
            return {
                approvals: [],
                form: new Form({
                    comment: '',
                    decision: ''
                })
            }
        },
        
        methods: {
            submitApproval(){
                this.form.post(`/api/admin/course/${this.course.uuid}/approve`)
                    .then(() => {
                        this.fetchCourseApprovals()
                        this.form.reset()
                    })
            },
            
            fetchCourseApprovals(){
                axios.get(`/api/admin/course/${this.course.uuid}/approvals`)
                    .then(response => {
                        this.approvals = response.data
                    })
            },
        },

        beforeMount(){
            this.fetchCourseApprovals()
        }
    }
    
    
</script>

<style scoped>
    .timeline {
      list-style: none;
      padding: 20px 0 20px;
      position: relative;
    }
    
    .timeline:before {
      top: 0;
      bottom: 0;
      position: absolute;
      content: " ";
      width: 3px;
      background-color: #eeeeee;
      left: 10%;
      margin-left: -1.5px;
    }
    
    .timeline > li {
      margin-bottom: 20px;
      position: relative;
    }
    
    .timeline > li:before,
    .timeline > li:after {
      content: " ";
      display: table;
    }
    
    .timeline > li:after {
      clear: both;
    }
    
    .timeline > li:before,
    .timeline > li:after {
      content: " ";
      display: table;
    }
    
    .timeline > li:after {
      clear: both;
    }
    
    .timeline > li > .timeline-panel {
      width: 82%;
      float: left;
      border: 1px solid #d4d4d4;
      border-radius: 2px;
      padding: 20px;
      position: relative;
      -webkit-box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
      box-shadow: 0 1px 6px rgba(0, 0, 0, 0.175);
    }
    
    .timeline > li > .timeline-panel:before {
      position: absolute;
      top: 26px;
      right: -15px;
      display: inline-block;
      border-top: 15px solid transparent;
      border-left: 15px solid #ccc;
      border-right: 0 solid #ccc;
      border-bottom: 15px solid transparent;
      content: " ";
    }
    
    .timeline > li > .timeline-panel:after {
      position: absolute;
      top: 27px;
      right: -14px;
      display: inline-block;
      border-top: 14px solid transparent;
      border-left: 14px solid #fff;
      border-right: 0 solid #fff;
      border-bottom: 14px solid transparent;
      content: " ";
    }
    
    .timeline > li > .timeline-badge {
      color: #fff;
      width: 50px;
      height: 50px;
      line-height: 50px;
      font-size: 1.4em;
      text-align: center;
      position: absolute;
      top: 16px;
      left: 10%;
      margin-left: -25px;
      background-color: #999999;
      z-index: 100;
      border-top-right-radius: 50%;
      border-top-left-radius: 50%;
      border-bottom-right-radius: 50%;
      border-bottom-left-radius: 50%;
    }
    
    .timeline > li.timeline-inverted > .timeline-panel {
      float: right;
    }
    
    .timeline > li.timeline-inverted > .timeline-panel:before {
      border-left-width: 0;
      border-right-width: 15px;
      left: -15px;
      right: auto;
    }
    
    .timeline > li.timeline-inverted > .timeline-panel:after {
      border-left-width: 0;
      border-right-width: 14px;
      left: -14px;
      right: auto;
    }
    
    .timeline-badge.primary {
      background-color: #2e6da4 !important;
    }
    
    .timeline-badge.success {
      background-color: #3f903f !important;
    }
    
    .timeline-badge.warning {
      background-color: #f0ad4e !important;
    }
    
    .timeline-badge.danger {
      background-color: #d9534f !important;
    }
    
    .timeline-badge.info {
      background-color: #5bc0de !important;
    }
    
    .timeline-title {
      margin-top: 0;
      color: inherit;
    }
    
    .timeline-body > p,
    .timeline-body > ul {
      margin-bottom: 0;
    }
    
    .timeline-body > p + p {
      margin-top: 5px;
    }
</style>
