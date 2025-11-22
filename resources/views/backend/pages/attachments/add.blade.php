<!-- Modal -->
<div class="modal fade" id="attachments{{$student->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">
                    {{trans('back.attachments')}} : {{$student->name}}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">

                <div class="col-md-12 text-left">
                    <form action="{{ route('attachments.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="student_id" value="{{$student->id}}">
                        <div class="row">
                            <div class=" col-md-6">
                                <label for="attachment_name"> {{trans('back.attachment_name')}}  </label>
                                <input type="text" class="form-control"  name="attachment_name" placeholder="{{trans('back.attachment_name')}} " value="{{ old('attachment_name') }}">
                            </div>

                            <div class=" col-md-6">
                                <label for="type"> {{trans('back.upload_files')}}  </label>
                                <input type="file" name="file" class="form-control form-control-file" required>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> {{trans('back.Add')}}  </button>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-md-12">

                    @php $i =0 @endphp
                    @if($student->Attachments->count() > 0)

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">{{trans('back.attachment_name')}} </th>
                                    <th scope="col">{{trans('back.attachment')}} </th>
                                    <th scope="col">{{trans('back.created_at')}} </th>
                                    <th scope="col">{{trans('back.Delete')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($student->Attachments as $key => $attachment)
                                    <tr>
                                        <td>{{$attachment->attachment_name}}</td>
                                        <td>
                                            @can('show_attachment')
                                                <a href="{{$attachment->file}}" class="btn btn-primary btn-sm" target="_blank"> {{trans('back.show_attachment')}} </a>
                                            @endcan
                                        </td>
                                        <td>{{$attachment->created_at}}</td>
                                        <td>
                                            @can('delete_attachment')
                                                <form action="{{ route('attachments.destroy',$attachment->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm">{{trans('back.Delete')}} </button>
                                                </form>
                                            @endcan
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center">
                            <h4>
                                {{trans('back.There_are_no_files')}}
                            </h4>
                        </div>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{trans('back.close')}}  </button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>

