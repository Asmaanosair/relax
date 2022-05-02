@extends('layouts.app')

@section('content')

<div class="goals">
    <div class="row">
        <div class="col-lg-3 col-md-5 side-bar">
            <ul class="list-group">
                @forelse($patients as $patient)
                <li class="list-group-item {{ $patient_id->user_id == $patient->user_id ? 'active_dept' : '' }}">
                    <a href="{{ route('admin.assessments.show', $patient->user_id) }}">
                        {{ $patient->user->name }}
                    </a>
                    <div hidden>
                        {{ !($appointment_check = App\InternalAppointment::where('user_id', $patient->user_id)->get()->first()) }}
                    </div>
                    @if ($appointment_check != null)
                        <span class="float-left">
                            <a href="{{ route('admin.assessments.edit', $patient->user_id) }}" class="btn p-0">
                                <i class="far fa-edit text-success"></i>
                            </a>
                            <a href="{{ route('admin.show.assessment', $patient->user_id) }}" class="btn">
                                <i class="far fa-eye"></i>
                            </a>
                            <button type="button" data-toggle="modal" class="border-0" data-target="#Modal{{ $patient->user_id }}">
                                <i class="far fa-trash-alt text-danger"></i>
                            </button>
                        </span>
                    @endif
                </li>

                <!-- Modal -->
                <div class="modal fade" id="Modal{{ $patient->user_id }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">حذف المريض</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                هل أنت متأكد بالفعل من أنك تريد حذف هذا الموعد الخاص بالمريض
                                {{ $patient->user->name }}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                                <form method="POST" class="form-inline"
                                    action="{{ route('admin.assessments.destroy', $patient->user_id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i>
                                        نعم</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                @empty
                @endforelse
            </ul>
        </div>

        <div class="col-lg-9 col-md-7 all-treatments">
            @if ($patient_id != null)
            <form method="POST" action="{{ route('admin.assessments.store') }}">
                @csrf
                <div class="all-treatments-content" style="height: 55vh;">
                    <h2>{{ $patient_id->user->name }}</h2>

                    <div>

                        <div class="info-treatment">

                            <div>
                                <label class="form-check-label text-right mb-2" for="exampleCheck1">
                                    الدكتور المسئول عن المقابلة
                                </label>
                                <select required name="doctor_id" class="col-md-6 form-control">
                                    <option selected disabled> اختر الدكتور </option>
                                    @foreach ($doctors as $doctor)
                                        <option value="{{ $doctor->user->id }}">{{ $doctor->user->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    موعد المقابلة
                                </label>
                                <div class="row">
                                    <div class="col-lg-4 col-md-12">
                                        <input value="التاريخ" required class="form-control" type="date"
                                            name="date">
                                    </div>
                                    <div class="col-lg-4 col-md-12">
                                        <select required name="day" class="form-control">
                                            <option selected disabled>الأيام</option>
                                            @foreach ($days as $day)
                                                <option value="{{ $day }}">{{ $day }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-lg-4 col-md-12">
                                        <select required id="m-select" name="hour_id" class="form-control "
                                            data-placeholder="اختر الساعات...">
                                            @foreach ($hours as $hour)
                                                <option value="{{ $hour->id }}">
                                                    {{ $hour->hour }}
                                                    <span>
                                                        {{ $hour->type == 'AM' ? 'ص' : 'م' }}
                                                    </span>
                                                </option>

                                            @endforeach
                                        </select>
                                    </div>

                                </div>
                            </div>
                            <div class="mt-4" style="margin-bottom: 70px;">

                            </div>
                            <input type="hidden" name="user_id" value="{{ $patient_id->user_id }}">

                        </div>
                        <div class="text-left my-5">
                            <input type="submit" class="btn btn-success add px-5 py-1"
                                style="position: absolute;text-align: left !important;bottom: 62px;left: 171px;"
                                value="حفظ">
                        </div>
                    </div>
                </div>
            </form>
            @else
            <div class="alert alert-danger  text-center d-flex justify-content-center ">
                <p class="">لا يوجد طلبات لتقييم المرضى</p>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection
