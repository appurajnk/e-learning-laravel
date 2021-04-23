@extends('backend.layouts.app')

@section('title', __('strings.translations') . ' | ' . app_name())

@push('after-styles')
<link rel="stylesheet" href="/vendor/translation/css/main.css">
@endpush

@section('content')
<form action="{{ route('admin.translations.edit', ['language' => $language]) }}" method="get">
    <div class="panel">

        <div class="panel-header">
            <div class="flex flex-grow justify-start items-center">
                @include('backend.translations.forms.search', ['name' => 'filter', 'value' => Request::get('filter')])

                @include('backend.translations.forms.select', ['name' => 'language', 'items' => $languages, 'submit' => true, 'selected' => $language])

                <div class="sm:hidden lg:flex items-center">

                    @include('backend.translations.forms.select', ['name' => 'group', 'items' => $groups, 'submit' => true, 'selected' => Request::get('group'), 'optional' => true])
                    
                </div>

            </div>
        </div>

        <div class="panel-body px-4">

            @if(count($translations))
                <div class="alert alert-info font-13 my-2">
                    <p>
                        @lang('strings.translation_explanation')
                    </p>
                </div>
                <table class="table table-sm border border-secondary">
                    <thead>
                        <tr>
                            <th class="w-1/6 uppercase">{{ __('translation::translation.group_single') }}</th>
                            <th class="w-1/6 uppercase">{{ __('translation::translation.key') }}</th>
                            <th class="uppercase">{{ config('app.locale') }}</th>
                            <th class="uppercase">{{ $language }}</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($translations as $type => $items)
                            
                            @foreach($items as $group => $translations)

                                @foreach($translations as $key => $value)

                                    @if(!is_array($value[config('app.locale')]))
                                        <tr>
                                            <td>{{ $group }}</td>
                                            <td>{{ $key }}</td>
                                            <td>{{ $value[config('app.locale')] }}</td>
                                            <td>
                                                <base-translation-input 
                                                    initial-translation="{{ $value[$language] }}" 
                                                    language="{{ $language }}" 
                                                    group="{{ $group }}" 
                                                    translation-key="{{ $key }}" 
                                                    route="{{ config('translation.ui_url') }}"
                                                    :demo_mode="{{ (int)setting('site.enable_demo_mode') }}">
                                                </base-translation-input>
                                            </td>
                                        </tr>
                                    @endif

                                @endforeach

                            @endforeach
                                    
                        @endforeach
                    </tbody>

                </table>

            @endif

        </div>

    </div>

    </form>
@endsection
