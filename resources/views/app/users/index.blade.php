@extends('layouts.app')

@section('content')
<div class="container">
    <div class="searchbar mt-0 mb-4">
        <div class="row">
            <div class="col-md-6">
                <form>
                    <div class="input-group">
                        <input
                            id="indexSearch"
                            type="text"
                            name="search"
                            placeholder="{{ __('crud.common.search') }}"
                            value="{{ $search ?? '' }}"
                            class="form-control"
                            autocomplete="off"
                        />
                        <div class="input-group-append">
                            <button type="submit" class="btn btn-primary">
                                <i class="icon ion-md-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-md-6 text-right">
                @can('create', App\Models\User::class)
                <a href="{{ route('users.create') }}" class="btn btn-primary">
                    <i class="icon ion-md-add"></i> @lang('crud.common.create')
                </a>
                @endcan
            </div>
        </div>
    </div>

    <div class="card">
        <div class="card-body">
            <div style="display: flex; justify-content: space-between;">
                <h4 class="card-title">@lang('crud.usuarios.index_title')</h4>
            </div>

            <div class="table-responsive">
                <table class="table table-borderless table-hover">
                    <thead>
                        <tr>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.name')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.surname')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.email')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.cui')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.nit')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.type')
                            </th>
                            <th class="text-left">
                                @lang('crud.usuarios.inputs.active')
                            </th>
                            <th class="text-center">
                                @lang('crud.common.actions')
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td>{{ $user->name ?? '-' }}</td>
                            <td>{{ $user->surname ?? '-' }}</td>
                            <td>{{ $user->email ?? '-' }}</td>
                            <td>{{ $user->cui ?? '-' }}</td>
                            <td>{{ $user->nit ?? '-' }}</td>
                            <td>{{ $user->roles[0]?->name ?? 'Sin rol' }}</td>
                            <td>{{ $user->active == 1 ? 'Activo' : 'Inactivo' }}</td>
                            <td class="text-center" style="width: 134px;">
                                <div
                                    role="group"
                                    aria-label="Row Actions"
                                    class="btn-group"
                                >
                                    @can('update', $user)
                                    <a href="{{ route('users.edit', $user) }}">
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-create"></i>
                                        </button>
                                    </a>
                                    @endcan @can('view', $user)
                                    <a href="{{ route('users.show', $user) }}">
                                        <button
                                            type="button"
                                            class="btn btn-light"
                                        >
                                            <i class="icon ion-md-eye"></i>
                                        </button>
                                    </a>
                                    @endcan @can('delete', $user)
                                    <form
                                        action="{{ route('users.destroy', $user) }}"
                                        method="POST"
                                        onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')"
                                    >
                                        @csrf @method('DELETE')
                                        <button
                                            type="submit"
                                            class="btn btn-light text-danger"
                                        >
                                            <i class="icon ion-md-trash"></i>
                                        </button>
                                    </form>
                                    @endcan
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8">
                                @lang('crud.common.no_items_found')
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="8">{!! $users->render() !!}</td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
