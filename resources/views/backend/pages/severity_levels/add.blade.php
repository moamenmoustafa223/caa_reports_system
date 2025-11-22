<!-- Modal -->
<div class="modal fade" id="add_SeverityLevel" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('back.add_severity_level')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body ">

                <form action=" {{ route('severity_levels.store') }}" method="post" enctype="multipart/form-data" >
                @csrf

                    <div class="row ">

                        <div class="form-group col-md-6">
                            <label for="level_key">{{trans('back.level_key')}}  </label>
                            <input type="text" class="form-control" id="level_key"  name="level_key" placeholder="{{trans('back.level_key')}}" value="{{ old('level_key') }}" required>
                            <small class="text-muted">{{ trans('back.example') }}: low, medium, high, critical</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="order">{{trans('back.order')}}  </label>
                            <input type="number" class="form-control" id="order"  name="order" placeholder="{{trans('back.order')}}" value="{{ old('order', 1) }}" required min="1">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_ar">{{trans('back.name_ar')}}  </label>
                            <input type="text" class="form-control" id="name_ar"  name="name_ar" placeholder="{{trans('back.name_ar')}}" value="{{ old('name_ar') }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_en">{{trans('back.name_en')}}  </label>
                            <input type="text" class="form-control" id="name_en"  name="name_en" placeholder="{{trans('back.name_en')}}" value="{{ old('name_en') }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="color">{{trans('back.color')}}</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="{{ old('color', '#6c757d') }}" required>
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
