@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('intrnl_sections') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.inside_departments.create') }}" class="btn btn-primary rounded-pill">
        {{ __('add_is') }} <i class="uil-plus"></i>
    </a>
</header>

<div class="row mt-4">
    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-accessible-icon-alt display-2 lh-1 me-3"></i>
            <div>
                <h4 class="mb-1">
                    <a href="{{ route('admin.all.department.patients') }}">{{ __('total_patnts') }}</a>
                </h4>
                <p class="mb-0">{{ __('total_patnts_sub') }}</p>
                <span class="fs-3">{{ $all_patients }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-university display-2 lh-1 me-3"></i>
            <div>
                <h4 class="mb-1">{{ __('deps_patnts') }}</h4>
                <p class="mb-0">{{ __('deps_patnts_sub') }}</p>
                <span class="fs-3">{{ count($patients) }}</span>
            </div>
        </div>
    </div>

    <div class="col-md-6 col-lg-4 mb-4">
        <div class="d-flex">
            <i class="uil uil-calendar-alt display-2 lh-1 me-3"></i>
            <div>
                <h4 class="mb-1">
                    <a href="{{ route('admin.sessions.doctors') }}">{{ __('total_appimnts') }}</a>
                </h4>
                <p class="mb-0">{{ __('total_appimnts_sub') }}</p>
                <span class="fs-3">{{ $all_appointments }}</span>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-8">
        <div class="table-responsive mt-4">
            <table class="table">
                <tbody>
                    @forelse($patients as $patient)
                    <tr>
                        <td class="d-flex align-items-center">
                            <a href="{{ route('admin.patients.show', $patient->id) }}">
                                <img class="rounded-pill" src="{{ $patient->image }}" width="45" />
                            </a>
                            <div class="ms-3">
                                <h6 class="mb-1">{{ __('name') }}</h6>
                                <a href="{{ route('admin.patient.sessions', $patient->id) }}">{{ $patient->name }}</a>
                            </div>
                        </td>
                        <td>
                            <h6>{{ __('number') }}</h6>
                            {{ App\Session::where('user_id', $patient->id)->count() }}
                        </td>
                        <td>
                            <h6>{{ __('actions') }}</h6>
                            <div class="dropdown">
                                <a class="dropdown-toggle text-dark fs-4" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                  <i class="uil uil-ellipsis-h text-muted"></i>
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('admin.patient.sessions', $patient->id) }}">
                                            <i class="uil uil-eye me-1"></i> {{ __('view') }}
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <x-empty />
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-lg-4">
        <ul class="list-group">
            @forelse($departments as $department)
            <li class="list-group-item d-flex justify-content-between align-items-center {{ $department_id == $department->id ? 'active_dept' : '' }}">
                <a href="{{ route('admin.specific.department.patients', $department->id) }}">
                    {{ $department->name }}
                </a>
                <div>
                    <a href="{{ route('admin.inside_departments.edit', $department->id) }}" class="btn btn-light text-dark px-3 py-1">
                        <i class="uil uil-edit"></i>
                    </a>

                    <a href="{{ route('admin.inside_departments.show', $department->id) }}" class="btn btn-light text-dark px-3 py-1">
                        <i class="uil uil-eye"></i>
                    </a>

                    <button type="button" data-bs-toggle="modal" class="btn btn-light px-3 py-1" data-bs-target="#Modal{{ $department->id }}">
                        <i class="uil uil-trash-alt"></i>
                    </button>
                </div>
            </li>
        </ul>

        <!-- Modal -->
        <div class="modal fade" id="Modal{{ $department->id }}" tabindex="-1" role="dialog"
            aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">{{ __('base_msg_conf') }}</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            {{ __('del_deprtmnt_msg_conf') }}
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                {{ __('cancel') }} <i class="uil uil-times"></i>
                            </button>
                            <form method="POST" class="form-inline" action="{{ route('admin.inside_departments.destroy', $department->id) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    {{ __('del_anyway') }} <i class="uil uil-trash"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                {{-- <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">حذف القسم</h5>
                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        هل أنت متأكد بالفعل من أنك تريد حذف هذا القسم الداخلى الذى يسمى
                        {{ $department->name }}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">لا</button>
                        <form method="POST" class="form-inline"
                            action="{{ route('admin.inside_departments.destroy', $department->id) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"><i
                                    class="far fa-trash-alt"></i> نعم</button>
                        </form>

                    </div>
                </div> --}}
            </div>
        </div>
        @empty
        <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
            <p class="">لا يوجد أقسام حاليا</p>
        </div>
        @endforelse
    </div>
</div>



    {{-- <div class="main-content">
        <div>
            <a href="{{ route('admin.inside_departments.create') }}" class="btn btn-success add-department">
                <span class="plus"> +</span>
                <span class="text">اضافة قسم جديد </span>
            </a>
        </div>
        <h2 class="text-center">الأقسام الداخلية</h2>

        <div class="goals">
            <div class="row">
                <div class="col-md-3 side-bar">
                    <ul class="list-group">
                        @forelse($departments as $department)
                            <li class="list-group-item {{ $department_id == $department->id ? 'active_dept' : '' }}">
                                <a href="{{ route('admin.specific.department.patients', $department->id) }}">
                                    {{ $department->name }}
                                </a>
                                <span class="float-left">
                                    <a href="{{ route('admin.inside_departments.edit', $department->id) }}"
                                        class="btn p-0"><i class="uil uil-edit text-success"></i> </a>

                                    <a href="{{ route('admin.inside_departments.show', $department->id) }}" class="btn"><i
                                            class="uil uil-eye"></i> </a>

                                    <button type="button" data-toggle="modal" class="border-0"
                                        data-target="#Modal{{ $department->id }}">
                                        <i class="uil uil-trash-alt text-danger"></i>
                                    </button>
                                </span>
                            </li>
                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $department->id }}" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">حذف القسم</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            هل أنت متأكد بالفعل من أنك تريد حذف هذا القسم الداخلى الذى يسمى
                                            {{ $department->name }}
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                                            <form method="POST" class="form-inline"
                                                action="{{ route('admin.inside_departments.destroy', $department->id) }}">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger"><i
                                                        class="far fa-trash-alt"></i> نعم</button>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
                                <p class=""> لا يوجد أقسام حاليا</p>
                            </div>

                        @endforelse

                    </ul>
                </div>
                <div class="col-md-9 goals-container">

                    <div class="section-search">
                        <div class="form-group has-search col-md-6">
                            <span class="fa fa-search form-control-feedback"></span>
                            <input type="text" class="form-control search" placeholder="بحث عن مريض...">
                        </div>
                    </div>

                    <div class="statitics">
                        <div class="row ">
                            <div class="col-lg-4 col-md-6 text-center statitic">
                                <div class="d-flex align-items-center statitic-content">
                                    <div class="icon">
                                        <img src="{{ asset('img/person3.PNG') }}" alt="">
                                    </div>
                                    <div>
                                        <a href="{{ route('admin.all.department.patients') }}">
                                            <p class="counter">{{ isset($all_patients) ? $all_patients : '0' }}</p>
                                            <p>كل المرضى</p>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 text-center statitic">
                                <div class="d-flex align-items-center statitic-content">
                                    <div class="icon">
                                        <img src="{{ asset('img/person3.PNG') }}" alt="">
                                    </div>
                                    <div>
                                        <p class="counter">{{ isset($patients) ? count($patients) : '0' }}</p>
                                        <p>مرضى القسم</p>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-4 col-md-6 text-center statitic">
                                <a href="{{ route('admin.sessions.doctors') }}">
                                    <div class="d-flex align-items-center statitic-content">
                                        <div class="icon">
                                            <img src="{{ asset('img/calender.PNG') }}" alt="">
                                        </div>
                                        <div>
                                            <p class="counter">{{ $all_appointments }}</p>
                                            <p> كل المواعيد</p>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        </div>

                    </div>

                    <div class="results">
                        @forelse($patients as $patient)
                            <div class="result">
                                <div class="img-person-result">
                                    <a href="{{ route('admin.patients.show', $patient->id) }}">
                                        <img src="{{ $patient->image }}" alt="patient">
                                    </a>
                                </div>

                                <span class="name">
                                    <a href="{{ route('admin.patient.sessions', $patient->id) }}">
                                        {{ $patient->name }}
                                    </a>
                                </span>
                                <span class="number">
                                    {{ App\Session::where('user_id', $patient->id)->get()->count() }}
                                </span>
                            </div>

                        @empty

                            <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
                                <p class=""> لا يوجد مرضى حاليا</p>
                            </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>


    </div> --}}

@endsection
