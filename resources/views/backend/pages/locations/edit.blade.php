<!-- Modal -->
<div class="modal fade" id="edit_Location{{$location->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('back.edit_location')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left">

                <form action=" {{ route('locations.update', $location->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="name_ar">{{trans('back.name_ar')}}  </label>
                            <input type="text" class="form-control" id="name_ar"  name="name_ar" value="{{ $location->name_ar }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_en">{{trans('back.name_en')}}  </label>
                            <input type="text" class="form-control" id="name_en"  name="name_en" value="{{ $location->name_en }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="font-weight-bold">{{ trans('back.status') }}</label>
                            <b class="text-danger">*</b>
                            <select class="form-control" name="status" required>
                                <option value="1" {{ $location->status == 1 ? 'selected' : '' }}>{{ trans('back.active') }}</option>
                                <option value="0" {{ $location->status == 0 ? 'selected' : '' }}>{{ trans('back.inactive') }}</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('back.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('back.Save')}}</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
