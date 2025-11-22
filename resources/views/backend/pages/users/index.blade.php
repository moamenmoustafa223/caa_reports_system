@extends('backend.layouts.master')

@section('page_title')
{{trans('users.users')}}
@endsection


@section('content')


    <div class="row">

        @can('users_add')
        <div class="col-md-9 mb-1">
            <a class="btn btn-primary btn-sm mb-1" href="{{ route('users.create') }}">
                <i class="mdi mdi-plus"></i>
                {{trans('users.add_new_user')}}
            </a>
        </div>
        @endcan

        <div class="col-md-3 mb-1">
            <form action="{{ route('users.index') }}" method="GET" role="search">
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" name="query" value="{{old('query', request()->input('query'))}}" placeholder="search..." id="query">
                    <button class="btn btn-primary btn-sm ml-1" type="submit" title="Search">
                        <span class="fas fa-search"></span>
                    </button>
                    <a href="{{ route('users.index') }}" class="btn btn-success btn-sm ml-1 " type="button" title="Reload">
                        <span class="fas fa-sync-alt"></span>
                    </a>
                </div>
            </form>
        </div>

    </div>



    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="table-responsive">
                    <table  class="table text-center  table-bordered table-sm ">
                        <thead>
                        <tr style="background-color: rgb(232,245,252)">
                            <th>{{trans('users.user_name')}}</th>
                            <th>{{trans('users.email')}}</th>
                            <th>{{trans('users.Roles')}}</th>
                            <th>{{trans('back.status')}} </th>
                            <th>{{trans('users.Created_at')}}</th>
                            <th>{{trans('users.Action')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $user)
                            <tr>
                                <td> {{ $user->name }}</td>
                                <td> {{ $user->email }}</td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                        @foreach($user->getRoleNames() as $v)
                                            <label class="badge bg-secondary">{{ $v }}</label> 
                                        @endforeach
                                    @endif
                                </td>
                                <td>
                                    @if($user->status == 1) {{trans("back.active")}} @else {{trans("back.inactive")}} @endif
                                </td>
                                <td>{{ $user->created_at }}</td>
                                <td class="text-center">

                                    {{-- Show --}}
                                    @can('users_show')
                                        <a href="{{ route('users.show', $user->id) }}" class="text-success mx-1" title="{{ trans('verbs.show') }}">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                    @endcan
                                
                                    {{-- Edit --}}
                                    @can('users_edit')
                                        @if($user->id == 1)
                                            <a href="#" class="text-muted mx-1 disabled" title="{{ trans('verbs.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @else
                                            <a href="{{ route('users.edit', $user->id) }}" class="text-primary mx-1" title="{{ trans('verbs.edit') }}">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                        @endif
                                    @endcan
                                
                                </td>
                                
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                {!! $data->appends(Request::all())->links() !!}

            </div>
        </div>
    </div> <!-- end row -->

@endsection


@section('js')
    <script>
        $('#datatable').dataTable( {
            "paging": false,
            "info": false,
            // "searching": false,
        } );
    </script>
@endsection
