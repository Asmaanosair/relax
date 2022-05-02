@extends('layouts.app')

@section('content')
<h2>{{ __('Edit assesment') }}</h2>
{{-- <h2> تعديل موعد {{ $patient_id->user->name }}</h2> --}}
<p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>

<div class="mt-4">
    @if ($appointment != null)
    <div class="row">
        <div class="col">
            <form method="POST" action="{{ route('admin.assessments.update', $appointment->id) }}">
                @csrf
                @method('PUT')

                <label class="label text-muted mb-1">{{ __('t_d_r_f_t_i') }}</label>
                <select required name="doctor_id" class="form-control">
                    <option selected disabled>{{ __('chos_doc') }}</option>
                    @foreach ($doctors as $doctor)
                    <option {{ $doctor->user->id == $appointment->doctor_id ? 'selected' : '' }} value="{{ $doctor->user->id }}">
                        {{ $doctor->user->name }}
                    </option>
                    @endforeach
                </select>

                <div class="my-4">
                    <label class="label text-muted mb-1" for="exampleCheck1">{{ __('intview_date') }}</label>
                    <div class="row">
                        <div class="col-lg-4 col-md-12">
                            <input required value="{{ $appointment->doctor_appointment->date }}" class="form-control" type="date" name="date">
                        </div>
                        <div class="col-lg-4 col-md-12">
                            <select required name="day" class="form-control">
                                <option selected disabled>الأيام</option>
                                @foreach ($days as $day)
                                    <option
                                        {{ $appointment->doctor_appointment->day == $day ? 'selected' : '' }}
                                        value="{{ $day }}">{{ $day }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-lg-4 col-md-12">
                            <select required id="m-select" name="hour_id" class="form-control" data-placeholder="{{ __('chos_hours') }}">
                                @foreach ($hours as $hour)
                                <option
                                    {{ $appointment->hour_id == $hour->id ? 'selected' : '' }}
                                    value="{{ $hour->id }}">
                                    {{ $hour->hour }}
                                    <span>
                                        {{ $hour->type == 'AM' ? __('am') : __('pm') }}
                                    </span>
                                </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="user_id" value="{{ $patient_id->user_id }}" />

                <button type="submit" class="btn btn-primary rounded-pill">
                    {{ __('save_changes') }} <i class="uil-edit ms-1"></i>
                </button>
            </form>
        </div>

        
        {{-- <div class="col-lg-3 col-md-5 side-bar">
            <ul class="list-group">
                @forelse($patients as $patient)
                <li
                    class="list-group-item {{ $patient_id->user_id == $patient->user_id ? 'active_dept' : '' }}">
                    <a href="{{ route('admin.assessments.show', $patient->user_id) }}">
                        {{ $patient->user->name }}
                    </a>
                    <div hidden>
                        {{ !($appointment_check = App\InternalAppointment::where('user_id', $patient->user_id)->get()->first()) }}
                    </div>
                    @if ($appointment_check != null)
                        <span class="float-left">
                            <a href="{{ route('admin.assessments.edit', $patient->user_id) }}" class="btn p-0"><i
                                    class="far fa-edit text-success"></i> </a>

                            <a href="{{ route('admin.show.assessment', $patient->user_id) }}" class="btn"><i
                                    class="far fa-eye"></i> </a>

                            <button type="button" data-toggle="modal" class="border-0"
                                data-target="#Modal{{ $patient->user_id }}">
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
        </div> --}}
    </div>
    @else
    <div class="alert alert-danger  text-center d-flex justify-content-center " style="margin:270px">
        <p class="mt-2"> لا يوجد موعد محدد الان</p>
        <a class="btn  btn-success mx-3" href="{{ route('admin.assessments.index') }}"> رجوع للقائمة الرئيسية للتقييمات</a>
    </div>
    @endif
</div>
@endsection
