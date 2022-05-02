@extends('layouts.app')

@section('content')
<!--==================================== Start Add Department =================================-->

<div class="dept-container text-right">
    <h2 class="mb-4">إضافة صلاحية جديدة</h2>
    <div class="add-content-dept p-4">
        <form method="post" action="{{route('admin.roles.update',$role->id) }}" enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="section-1">
                <div class="form-group">
                    <div>
                        <label>إسم الصلاحية</label>
                    </div>
                    <input required name="role"  class="form-control col-md-6" type="text" placeholder="الصلاحية..." value="{{$role->role}}">
                </div>


            <div class="text-center my-5">
                <input type="submit" class="btn btn-success add add-data " value="تم">
            </div>


        </form>

    </div>

</div>

@endsection
