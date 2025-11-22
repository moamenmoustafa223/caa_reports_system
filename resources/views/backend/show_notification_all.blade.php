@extends('backend.layouts.master')

@section('page_title')
{{trans('dashboard.Notifications')}}
@endsection


@section('content')

    {{--    الإشعارات  --}}
    @can('notification')
        <div class="row">
            <div class="container">
                <div class="col-md-12">

                    @foreach(auth()->user()->unreadNotifications as $notification)

                        @if($loop->first)
                            <a href="{{route('markAsRead_all')}}" id="mark-all">
                                {{trans('dashboard.Clear_all')}}
                            </a>
                        @endif

                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <strong>
                                {{ $notification->data['title'] }} :
                            </strong>
                            {{ $notification->data['body'] }}
                            <br>
                            <small>{{ $notification->created_at->diffForHumans() }}</small>
                            <a href="{{route('markAsRead', $notification->id)}}" class="float-right mark-as-read" >
                                {{trans('dashboard.make_read')}}
                            </a>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endforeach


                </div>
            </div>
        </div>
    @endcan



@endsection




@section('js')

    @if(auth()->user())
        <script>
            function sendMarkRequest(id = null) {
                return $.ajax("{{ route('dashboard.index') }}", {
                    method: 'POST',
                    data: {
                        _token,
                        id
                    }
                });
            }
            $(function() {
                $('.mark-as-read').click(function() {
                    let request = sendMarkRequest($(this).data('id'));
                    request.done(() => {
                        $(this).parents('div.alert').remove();
                    });
                });
                $('#mark-all').click(function() {
                    let request = sendMarkRequest();
                    request.done(() => {
                        $('div.alert').remove();
                    })
                });
            });
        </script>
    @endif

@endsection
