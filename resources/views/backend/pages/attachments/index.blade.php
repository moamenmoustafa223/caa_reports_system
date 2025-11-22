@extends('backend.layouts.master')

@section('page_title')
{{trans('back.attachments')}}
@endsection

@section('title')
{{trans('back.attachments')}}
@endsection

@section('content')

    <div class="row">
        <div class="col-12">
            <div class="card-box">

                <div class="table-responsive">
                    <table  class="table text-center  table-bordered table-sm ">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th scope="col">{{trans('back.attachment_name')}} </th>
                            <th scope="col">{{trans('back.attachment')}} </th>
                            <th scope="col">{{trans('back.created_at')}} </th>
                        </tr>
                        </thead>

                        <tbody>
                        @foreach($attachments as $key => $attachment)
                            <tr>
                                <td>{{$key +1}}</td>
                                <td>{{$attachment->attachment_name}}</td>
                                <td>
                                    @can('show_attachment')
                                        <a href="{{$attachment->file}}" class="btn btn-primary btn-sm" target="_blank"> {{trans('back.show_attachment')}} </a>
                                    @endcan
                                </td>
                                <td>{{$attachment->created_at}}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                    {!! $attachments->appends(Request::all())->links() !!}
                </div>
            </div>
        </div>
    </div>
@endsection

