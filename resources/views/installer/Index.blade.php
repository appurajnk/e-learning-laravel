@extends('frontend.layouts.install')

@section('content')
<base-installer-license inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card border border-secondary ">
            <div class="card-header bg-white py-4">
                <h2 class="h4 m-0">@lang('install.start')</h2>
            </div>
            <div class="card-body p-4 d-flex flex-column" style="min-height: 50vh;">
                <p class="text-center mb-4">
                    @lang('install.welcome')
                </p>
                
                <div class="my-3 font-weight-bold bg-light p-2 border border-secondary">
                    <h4>@lang('install.enter_license') </h4>
                </div>
                <alert-success :form="form" message="License verified successfully"></alert-success>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        @lang('install.envato_username')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.username" :class="{ 'is-invalid': form.errors.has('username') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="username">
                        <has-error :form="form" field="username"/>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                        @lang('install.purchase_code')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.purchase_code" :class="{ 'is-invalid': form.errors.has('purchase_code') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="purchase_code">
                        <has-error :form="form" field="purchase_code"/>
                    </div>
                </div>


            </div>
            <div class="card-footer bg-white text-right">
                <a href="{{ route('frontend.installer.requirements') }}" class="btn btn-info btn-sm rounded-0" v-if="!form.busy && success">
                    @lang('install.next')
                </a>
                <base-button :disabled="form.busy" class="btn btn-danger btn-sm rounded-0" v-else>
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        @lang('install.busy_wait')
                    </span>
                    <span v-else>
                    @lang('install.submit')
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-license>
@endsection
