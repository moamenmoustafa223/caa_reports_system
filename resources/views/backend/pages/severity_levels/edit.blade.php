<!-- Modal -->
<div class="modal fade" id="edit_SeverityLevel{{$level->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg ">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('back.edit_severity_level')}}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-left">

                <form action=" {{ route('severity_levels.update', $level->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">

                        <div class="form-group col-md-6">
                            <label for="level_key">{{trans('back.level_key')}}  </label>
                            <input type="text" class="form-control" id="level_key"  name="level_key" value="{{ $level->level_key }}" required>
                            <small class="text-muted">{{ trans('back.example') }}: low, medium, high, critical</small>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="order">{{trans('back.order')}}  </label>
                            <input type="number" class="form-control" id="order"  name="order" value="{{ $level->order }}" required min="1">
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_ar">{{trans('back.name_ar')}}  </label>
                            <input type="text" class="form-control" id="name_ar"  name="name_ar" value="{{ $level->name_ar }}" required>
                        </div>

                        <div class="form-group col-md-6">
                            <label for="name_en">{{trans('back.name_en')}}  </label>
                            <input type="text" class="form-control" id="name_en"  name="name_en" value="{{ $level->name_en }}" required>
                        </div>

                        <div class="form-group col-md-12">
                            <label for="color">{{trans('back.color')}}</label>
                            <input type="color" class="form-control form-control-color" id="color" name="color" value="{{ $level->color }}" required>
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
