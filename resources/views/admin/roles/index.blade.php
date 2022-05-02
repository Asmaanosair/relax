@extends('layouts.app')

@section('content')


<div class="main-content">
    <div>
        <a href="{{route('admin.roles.create')}}" class="btn btn-success add-department">
            <span class="plus"> +</span>
            <span class="text">اضافة صلاحية جديد </span>
        </a>
    </div>
    <h2 class="text-center">الصلاحيات</h2>
    <div class="row depts">
        @forelse($roles as $role)
        <div class="col-md-3">

            <div class="depts-content">
                <!-- <ul class="navbar-nav control-card">
                    <li class="nav-item dropdown d-flex align-items-center">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <a class="dropdown-item" href="{{route('admin.roles.edit',$role->id)}}">تعديل </a>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Modal{{$role->id}}">
                                حذف
                            </button>

                        </div>
                    </li>
                </ul> -->


                <!-- Modal -->
                <div class="modal fade" id="Modal{{$role->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">حذف الصلاحية</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                هل أنت متأكد بالفعل من أنك تريد حذف هذه الصلاحية التى تسمى {{$role->role}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                                <form method="POST" class="form-inline" action="{{route('admin.roles.destroy',$role->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> نعم</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <img class="img-dept" src="{{asset('/img/roles.png')}}" alt="roles">
                </div>

                <p>
                    <a href="{{route('admin.roles.show',$role->id)}}">
                        {{$role->role}}
                    </a>
                </p>
            </div>


        </div>
        @empty

        <div class="alert alert-danger  text-center d-flex justify-content-center">
            <p class=""> لا يوجد صلاحيات حاليا</p>

        </div>
        @endforelse


    </div>

</div>

@endsection
