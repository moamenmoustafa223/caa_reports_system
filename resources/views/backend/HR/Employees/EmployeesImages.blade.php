<!-- Modal -->
<div class="modal fade" id="EmployeesImages{{$employee->id}}" data-backdrop="static" data-keyboard="false"  tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{trans('employees.Employees_Images')}}</h5>
                <button type="button" class="close " data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="col-md-12 text-left">
                    <form action="{{ route('EmployeesImages.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="employee_id" value="{{$employee->id}}">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="name"> {{trans('employees.file_name')}}</label>
                                <input type="text" class="form-control"  name="name" placeholder="{{trans('employees.file_name')}}" value="{{ old('name') }}">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="type"> {{trans('employees.Upload_Files')}}</label>
                                <input type="file" name="image" class="form-control form-control-file">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success"> {{trans('employees.Add')}}  </button>
                        </div>
                    </form>
                </div>

                <hr>

                <div class="col-md-12">
                    @php $i =0 @endphp

                    @if($employee->employees_images->count() > 0)

                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">{{trans('employees.file_name')}} </th>
                                    <th scope="col">{{trans('employees.file')}} </th>
                                    <th scope="col">{{trans('employees.Created_at')}} </th>
                                    <th scope="col">{{trans('employees.Delete')}} </th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($employee->employees_images as $key => $employeesImage)
                                    <tr>
                                        <td>{{ ++$i }}</td>
                                        <td>{{$employeesImage->name}}</td>
                                        <td>
                                            <a href="{{asset($employeesImage->image)}}" class="btn btn-primary btn-sm" target="_blank"> {{trans('employees.show_Files')}}</a>
                                        </td>
                                        <td>{{$employeesImage->created_at}}</td>
                                        <td>
                                            @can('Employees_Images_delete')
                                            <form action="{{ route('EmployeesImages.destroy',$employeesImage->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{trans('employees.Delete')}}</button>
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
                                {{trans('employees.no_items')}}
                            </h4>
                        </div>
                    @endif

                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"> {{trans('employees.Close')}} </button>
                    </div>

                </div>


            </div>

        </div>
    </div>
</div>
