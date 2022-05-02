@extends('layouts.app')

@section('content')
<!--==================================== Start Add Department =================================-->

<div class="dept-container text-right">
    <h2 class="mb-4">تعديل   </h2>
    <div class="add-content-dept p-4">
        <form method="post" action="{{route('admin.payment_method.update',$clinic->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="section-1">
                <div class="form-group">
                    <div>
                        <label>طريقه الدفع</label>
                    </div>
                    <input required name="nationality" class="form-control col-md-6" type="text" placeholder="الدفع ..." value="{{$clinic->payment_method}}">
                </div>
                <div class="form-group">
                    <div>
                        <label>الصوره  </label>
                    </div>
                    <div class="text-center col-md-6">
                        <img src="{{asset($clinic->image)}}" alt="clinic" class="image-edit">
                    </div>


                    <div class="add-file col-md-6">
                        <div class="add-file__title-box">
                            <img src="{{asset('img/adding icon.svg')}}" alt="add icon" class="add-file-icon" />
                            <input type="file" name="image" accept="image/*" onchange="showPreview(event);" />
                        </div>
                    </div>
                </div>



                <div class="text-center my-5">
                    <input type="submit" class="btn btn-success add add-data " value="تم">
                </div>


        </form>

    </div>

</div>

@endsection
