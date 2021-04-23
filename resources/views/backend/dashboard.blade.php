@extends('backend.layouts.app')

@section('title', app_name() . ' | ' . __('strings.backend.dashboard.title'))

@section('content')
<base-admin-sales-chart inline-template v-cloak>
<div>
    <div class="row">
        <!-- Sales this period -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(total_sales, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.sales_last_x_days', {days: period} ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Lifetime Sales -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-primary p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(lifetime_sales, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.lifetime_sales' ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings this period -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-success p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(total_earnings, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.earnings_last_x_days', {days: period} ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Lifetime Earnings -->
        <div class="col-6 col-lg-3">
            <div class="card">
                <div class="card-body p-0 d-flex align-items-center">
                    <i class="fas fa-money-bill-alt bg-success p-4 font-2xl mr-3"></i>
                    <div>
                        <div class="text-value-sm text-primary">
                            <div class="text-value-sm text-primary">@{{ formatCurrency(lifetime_earnings, false) }}</div>
                        </div>
                        <div class="text-muted text-uppercase font-weight-bold small">
                            @{{ trans('strings.lifetime_earnings' ) }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>


    <div class="row">
        <div class="col-md-8">
            <div class="card card-accent-success">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-8">
                            <h5>@{{ trans('strings.sales_last_x_days', { days: period } ) }}</h5>
                        </div>
                        <div class="col-md-4">
                        
                            <select class="form-control form-control-sm pull-right" v-model="period" @change="fetchSalesData()">
                                <option value="7">@lang('strings.last_x_days', ['days' => 7])</option>
                                <option value="30">@lang('strings.last_x_days', ['days' => 30])</option>
                                <option value="60">@lang('strings.last_x_days', ['days' => 60])</option>
                                <option value="90">@lang('strings.last_x_days', ['days' => 90])</option>
                                <option value="180">@lang('strings.last_x_days', ['days' => 180])</option>
                            </select>
                        </div>
                    </div>
                </div><!--card-header-->

                <div class="card-block">
                    <area-chart :data="chartData" :discrete="true" :ytitle="trans('strings.sales')" 
                        :download="true" :curve="false" legend="top" label="Sales"
                            v-if="show_chart"></area-chart>

                </div><!--card-block-->
            </div><!--card-->
            
        </div><!--col-->


        <!-- Right side -->
        <div class="col-md-4">
            <div class="card card-accent-danger clearfix">
                <div class="card-header d-flex justify-content-between">
                    <span>@lang('strings.system_messages_require_attention')</span>
                    @if(!config('api.demo_credentials'))
                        <span>
                            <button :disabled="form.busy" class="btn btn-sm btn-danger" @click.prevent="emptyDatabase()">
                                <i class="fas fa-spinner fa-spin" v-if="form.busy"></i>
                                Empty database
                            </button>
                        </span>
                    @endif
                </div>
                <div class="card-body" style="height: 300px; overflow-y: auto;">
                    <div v-if="messages.length">
                        <ul class="fa-ul ml-3">
                            <li v-for="message in messages">
                                <i class="fa-li fa fa-times text-danger"></i> @{{message.message}}
                                <hr />
                            </li>
                        </ul>
                    </div>
                    <div v-else>
                        <p>@lang('strings.no_messages')</p>
                    </div>
                </div>
            </div>

        </div>

    </div><!--row-->

    <div class="row">
        <div class="col-6 col-lg-6">
            <div class="card card-accent-danger clearfix">
                <div class="card-body">
                    <p>@lang('strings.periods_need_to_be_closed')</p>
                    <hr class="my-2" />
                    <div v-if="periods_to_close.length">
                        <div style="height: 200px; overflow-y: auto;">
                            <ul class="list-group list-group-flush ml-4x">
                                <li class="list-group-item py-2 px-2 d-flex justify-content-between" v-for="period_to_close in periods_to_close">
                                    <span>
                                        @{{ $moment(period_to_close.start_time).format('YYYY-MM-DD')}} - 
                                        @{{ $moment(period_to_close.end_time).format('YYYY-MM-DD')}}
                                    </span>

                                    <span>
                                        <a :href="`/admin/payouts/period/${period_to_close.uuid}`">
                                            @lang('strings.details')
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-else style="height: 200px; overflow-y: auto;">
                        <p>@lang('strings.no_period_pending_closure')</p>
                    </div>
                </div>
            </div>
        </div>


        <!-- COURSES NEEDING REVIEW -->
        <div class="col-6 col-lg-6">
            <div class="card card-accent-danger clearfix">
                <div class="card-body">
                    <p>@lang('strings.courses_needing_approval')</p>
                    <hr class="my-2" />
                    <div v-if="courses_to_approve.length">
                        
                        <div style="height: 200px; overflow-y: auto;">
                            <ul class="list-group list-group-flush ml-4x">
                                <li class="list-group-item py-2 px-2 d-flex justify-content-between" 
                                    v-for="course in courses_to_approve">
                                    <span>
                                        @{{ course.title }}
                                    </span>

                                    <span>
                                        <a :href="`/admin/courses/${course.uuid}`">
                                            @lang('strings.details')
                                        </a>
                                    </span>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div v-else style="height: 200px; overflow-y: auto;">
                        <p>@lang('strings.no_courses_to_approve')</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</base-admin-sales-chart>
@endsection
