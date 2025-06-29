@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">
                <a href="{{ route('departments.index') }}" class="mr-4"
                    ><i class="icon ion-md-arrow-back"></i
                ></a>
                @lang('crud.departamentos.show_title')
            </h4>

            <div class="mt-4">
                <div class="mb-4">
                    <h5>@lang('crud.departamentos.inputs.name')</h5>
                    <span>{{ $department->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.departamentos.inputs.manager_id')</h5>
                    <span>{{ optional($department->user)->name ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.departamentos.inputs.active')</h5>
                    <span>{{ $department->active ?? '-' }}</span>
                </div>
                <div class="mb-4">
                    <h5>@lang('crud.departamentos.inputs.description')</h5>
                    <span>{{ $department->description ?? '-' }}</span>
                </div>
            </div>

            <div class="mt-4">
                <a href="{{ route('departments.index') }}" class="btn btn-light">
                    <i class="icon ion-md-return-left"></i>
                    @lang('crud.common.back')
                </a>

{{--                @can('create', App\Models\Department::class)--}}
{{--                <a--}}
{{--                    href="{{ route('departments.create') }}"--}}
{{--                    class="btn btn-light"--}}
{{--                >--}}
{{--                    <i class="icon ion-md-add"></i> @lang('crud.common.create')--}}
{{--                </a>--}}
{{--                @endcan--}}
            </div>
        </div>
    </div>
</div>
@endsection
