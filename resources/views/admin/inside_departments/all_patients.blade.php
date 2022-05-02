@extends('layouts.app')

@section('content')
<div class="main-content">
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
                        <li class="list-group-item ">
                            <a href="{{ route('admin.specific.department.patients', $department->id) }}">
                                {{ $department->name }}
                            </a>
                            <span class="float-left">
                                <a href="{{ route('admin.inside_departments.edit', $department->id) }}"
                                    class="btn p-0"><i class="far fa-edit text-success"></i> </a>

                                <a href="{{ route('admin.inside_departments.show', $department->id) }}" class="btn"><i
                                        class="far fa-eye"></i> </a>

                                <button type="button" data-toggle="modal" class="border-0"
                                    data-target="#Modal{{ $department->id }}">
                                    <i class="far fa-trash-alt text-danger"></i>
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
                                        <p class="counter">{{ $all_patients }}</p>
                                        <p>كل المرضى</p>
                                    </a>
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
                        @if (isset($patient->patient) and $patient->patient->status == 'check')
                        <span hidden>
                            {{ !($check = App\Department_patient::where('patient_id', $patient->id)->get()->first()) }}
                        </span>
                        <div class="result">
                            <div class="img-person-result">
                                <a href="{{ route('admin.patients.show', $patient->id) }}">
                                    <img src="{{ $patient->image }}" alt="patient">
                                </a>
                            </div>

                            <span class="name">
                                <a href="{{ route('admin.patient.sessions', $patient->id) }}"
                                    style="color: {{ $check ? 'green' : 'red' }}  ">
                                    {{ $patient->name }}

                                    @if ($check)
                                        <span class="badge badge-success mx-2"> محجوز بالفعل </span>
                                    @else
                                        <span class="badge badge-danger mx-2"> لم يتم جحزه بعد </span>
                                    @endif

                                </a>
                            </span>
                            <span class="number">
                                {{ App\Session::where('user_id', $patient->id)->get()->count() }}
                            </span>
                        </div>
                        @endif
                    @empty

                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
