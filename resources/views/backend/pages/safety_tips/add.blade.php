<!-- Modal -->
<div class="modal fade" id="add_SafetyTip" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('back.add_safety_tip')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

                <form action=" {{ route('safety_tips.store') }}" method="post" enctype="multipart/form-data" >
                @csrf

                    <div class="row ">

                        <div class="form-group col-md-6">
                            <label for="title_ar" class="font-weight-bold">{{trans('back.title_ar')}}</label>
                            <b class="text-danger">*</b>
                            <input type="text" class="form-control" id="title_ar"  name="title_ar" placeholder="{{trans('back.title_ar')}}" value="{{ old('title_ar') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="title_en" class="font-weight-bold">{{trans('back.title_en')}}</label>
                            <b class="text-danger">*</b>
                            <input type="text" class="form-control" id="title_en"  name="title_en" placeholder="{{trans('back.title_en')}}" value="{{ old('title_en') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description_ar" class="font-weight-bold">{{trans('back.description_ar')}}</label>
                            <b class="text-danger">*</b>
                            <textarea class="form-control" id="description_ar" name="description_ar" rows="3" required>{{ old('description_ar') }}</textarea>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="description_en" class="font-weight-bold">{{trans('back.description_en')}}</label>
                            <b class="text-danger">*</b>
                            <textarea class="form-control" id="description_en" name="description_en" rows="3" required>{{ old('description_en') }}</textarea>
                        </div>

                        <div class="form-group col-md-4">
                            <label for="icon" class="font-weight-bold">{{trans('back.icon')}}</label>
                            <input type="text" class="form-control" id="icon"  name="icon" placeholder="🦺" value="{{ old('icon') }}">
                        </div>

                        <div class="form-group col-md-4">
                            <label for="order" class="font-weight-bold">{{trans('back.order')}}</label>
                            <input type="number" class="form-control" id="order"  name="order" value="{{ old('order', 0) }}">
                        </div>

                        <div class="form-group col-md-4">
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
