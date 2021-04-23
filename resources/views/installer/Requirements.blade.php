@extends('frontend.layouts.install')

@section('content')
    <base-installer-requirements inline-template>
        <div class="card border border-secondary mb-4" v-cloak>
            <div class="card-header bg-white py-4">
                <h2 class="h4 m-0">@lang('strings.server_requirements')</h2>
            </div>

            <div class="card-body p-1 d-flex flex-column align-items-center justify-content-center" 
                style="min-height: 50vh;">
                <vue-element-loading :active="form.busy" :is-full-screen="false" spinner="bar-fade-scale" color="#ea5352"></vue-element-loading>
                <template v-if="Object.keys(requirements).length > 0 && errors == 0">
                    <div class="alert alert-success text-center font-13">
                        <p>
                        @lang('install.requirements_description')
                            
                        </p>
                    </div>
                </template>
                <template v-if="Object.keys(requirements).length > 0 && errors > 0">
                    <div class="alert alert-danger text-center font-13">
                        <p>@lang('install.requirements_title')</p>
                    </div>
                </template>

                <ul class="list-group w-100" style="font-size: 13px;">
                    <li class="list-group-item pt-1 pb-1 d-flex justify-content-between" v-for="(req,k) in requirements">
                        @{{ k }}
                        <span v-if="req.message && req.status == 'FAILED'" class="text-danger pull-right">
                            @{{ req.message }}
                            <span class="fa fa-times-circle"></span>
                        </span>
                        <span v-if="req.message && req.status == 'WARNING'" class="text-warning pull-right">
                            @{{ req.message }}
                            <span class="fa fa-warning"></span>
                        </span>
                        <span v-if="!req.message" class="text-success pull-right">
                            <span class="fa fa-check-circle"></span>
                        </span>
                    </li>
                </ul>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <a href="{{ route('frontend.installer.database') }}" class="btn btn-sm rounded-0 btn-info" 
                    v-if="Object.keys(requirements).length > 0 && errors == 0">
                    @lang('install.next')
                </a>
                <button @click.prevent="checkRequirements()" class="btn btn-sm rounded-0 btn-danger" v-else>
                @lang('install.rerun_check')
                </button>
            </div>
        </div>
    </base-installer-requirements>
@endsection
