@extends('frontend.layouts.install')

@section('content')
<base-installer-finish inline-template>
    <form @submit.prevent="submit" v-cloak>
        <div class="card border border-secondary ">
            <div class="card-header bg-white py-4">
                <h2 class="h3 m-0">Finish</h2>
            </div>
            <div class="card-body d-flex flex-column justify-content-center text-center align-items-center" style="min-height: 50vh;">
                <p>
                    @lang('install.almost_done')
                    
                </p>
                <hr />
                <div class="custom-control custom-checkbox mr-sm-2 font-14 fw-300 mb-3 text-info">
                    <input id="import" v-model="form.import" value="true" class="custom-control-input form-control-lg" type="checkbox">
                    <label class="custom-control-label" for="import">
                        <p>@lang('install.want_to_import')</p>
                    </label>
                </div>
                <hr />
                <base-button :disabled="form.busy" class="btn btn-danger btn-md rounded-0">
                    <span v-if="form.busy">
                        <i class="fa fa-cog fa-spin"></i>
                        @lang('install.busy_wait')
                    </span>
                    <span v-else>
                    @lang('install.finish')
                    </span>
                </base-button>
            </div>
        </div>
    </form>
</base-installer-finish>
@endsection
