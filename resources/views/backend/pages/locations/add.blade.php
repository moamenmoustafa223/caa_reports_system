<!-- Modal -->
<div class="modal fade" id="add_Location" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('back.add_location')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

                <form action=" {{ route('locations.store') }}" method="post" enctype="multipart/form-data" >
                @csrf

                    <div class="row ">

                        <div class="form-group col-md-6">
                            <label for="name_ar">{{trans('back.name_ar')}}  </label>
                            <input type="text" class="form-control" id="name_ar"  name="name_ar" placeholder="{{trans('back.name_ar')}}" value="{{ old('name_ar') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_en">{{trans('back.name_en')}}  </label>
                            <input type="text" class="form-control" id="name_en"  name="name_en" placeholder="{{trans('back.name_en')}}" value="{{ old('name_en') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="status" class="font-weight-bold">{{ trans('back.status') }}</label>
                            <b class="text-danger">*</b>
                            <select class="form-control" name="status" required>
                                <option value="1" selected>{{ trans('back.active') }}</option>
                                <option value="0">{{ trans('back.inactive') }}</option>
                            </select>
                        </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{trans('back.Close')}}</button>
                        <button type="submit" class="btn btn-primary">{{trans('back.Add')}}</button>
                    </div>

                </form>

            </div>

        </div>
    </div>
</div>
