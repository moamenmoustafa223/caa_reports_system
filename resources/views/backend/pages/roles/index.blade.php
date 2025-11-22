@extends('backend.layouts.master')

@section('page_title')
{{trans('roles.roles')}}
@endsection


@section('content')


    @can('roles_add')
    <div class="col-sm-4">
        <a class="btn btn-primary btn-sm  mb-1" href="{{ route('roles.create') }}">
            <i class="mdi mdi-plus"></i>
            {{trans('roles.add_new_role')}}
        </a>
    </div>
    @endcan

    <div class="row">
        <div class="col-md-12">
            <div class="card-box">

                <div class="table-responsive">
                    <table  class="table table-bordered  text-center table-sm">
                        <thead>
                        <tr style="background-color: rgb(232,245,252)">
                            <th>#</th>
                            <th> {{trans('roles.role_name')}}</th>
                            <th> {{trans('roles.Action')}}</th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach ($roles as $key => $role)
                            <tr>
                                <td>{{$key+ $roles->firstItem()}}</td>
                                <td>{{ $role->name }}</td>
                                <td class="text-center">

                                    {{-- Show --}}
                                    @can('roles_show')
                                        <a href="{{ route('roles.show', $role->id) }}" class="text-success mx-1" title="{{ trans('verbs.show') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                
                                    {{-- Edit --}}
                                    @can('roles_edit')
                                        @if($role->id == 1)
                                            <a href="#" class="text-muted mx-1 disabled" title="{{ trans('verbs.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('roles.edit', $role->id) }}" class="text-primary mx-1" title="{{ trans('verbs.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endcan
                                
                                    {{-- Delete --}}
                                    @can('roles_delete')
                                        @if($role->id == 1)
                                            <a href="#" class="text-muted mx-1 disabled" title="{{ trans('back.delete') }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                        @else
                                            <a href="#" class="text-danger mx-1" title="{{ trans('back.delete') }}" data-bs-toggle="modal" data-bs-target="#delete_role{{ $role->id }}">
                                                <i class="fas fa-trash-alt"></i>
                                            </a>
                                            @include('backend.pages.roles.delete')
                                        @endif
                                    @endcan
                                
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div> <!-- end row -->

@endsection
