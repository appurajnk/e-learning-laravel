@extends('frontend.layouts.install')

@section('content')
<base-installer-admin-user inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card border border-secondary ">
            <div class="card-header bg-white py-4">
                <h2 class="h2 m-0">@lang('install.basic_information')</h2>
            </div>
            <div class="card-body" style="min-height: 50vh;">
                <p>
                    @lang('install.basic_information_exp')
                    
                </p>
                <hr />
                <alert-error :form="form" :message="form.errors.get('message')"></alert-error>
                <alert-success :form="form" message="User created"></alert-success>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.site_name')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.site_name" :class="{ 'is-invalid': form.errors.has('site_name') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="site_name">
                        <has-error :form="form" field="site_name"/>
                    </div>
                </div>
                <div class="my-3 font-weight-bold bg-light p-2 border border-secondary">
                    <h4>@lang('install.super_admin')</h4>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.username')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.username" :class="{ 'is-invalid': form.errors.has('username') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="username">
                        <has-error :form="form" field="username"/>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.first_name')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.first_name" :class="{ 'is-invalid': form.errors.has('first_name') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="first_name">
                        <has-error :form="form" field="first_name"/>
                    </div>
                </div>
                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.last_name')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.last_name" :class="{ 'is-invalid': form.errors.has('last_name') }" 
                            class="form-control form-control-sm border-secondary" type="text" name="last_name">
                        <has-error :form="form" field="last_name"/>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.admin_email')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" 
                            class="form-control form-control-sm border-secondary" type="email" name="email">
                        <has-error :form="form" field="email"/>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.admin_password')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" 
                            class="form-control form-control-sm border-secondary" type="password" name="password">
                        <has-error :form="form" field="password"/>
                    </div>
                </div>

                <div class="form-group form-row">
                    <label class="col-form-label col-md-4 text-right">
                    @lang('install.confirm_password')
                    </label>
                    <div class="col-md-8">
                        <input v-model="form.password_confirmation" :class="{ 'is-invalid': form.errors.has('password_confirmation') }" 
                            class="form-control form-control-sm border-secondary" type="password" name="password">
                        <has-error :form="form" field="password_confirmation"/>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-transparent d-flex justify-content-end">
                <a href="{{ route('frontend.installer.finish') }}" class="btn btn-info btn-sm rounded-0" v-if="!form.busy && success">
                @lang('install.next')
                </a>
                <base-button :disabled="form.busy" class="btn btn-danger btn-sm rounded-0" v-else>
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        @lang('install.busy_wait')
                    </span>
                    <span v-else>
                    @lang('install.save')
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-admin-user>
@endsection
