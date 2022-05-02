@extends('layouts.app')

@section('content')
<div class="goals">
@if (count($appointments) > 0)
    <div class="row">
        <div class="col-md-1 side-bar">
            <!-- <ul class="list-group">
                <li class="list-group-item active_dept">
                    <a href="">
                        قسم1
                    </a>
                </li>
            </ul> -->
        </div>

        <div class="col-md-11 all-treatments">
            <div class="all-treatments-content h-auto">
                <table class="w-100 text-center">
                    <tr>
                        <td>أيام الأسبوع</td>
                        @foreach ($appointments as $appointment)
                        <td>
                            <span>{{ $appointment->hour }} {{ $appointment->hour == 'AM' ? 'م' : 'ص' }}</span>
                            <span></span>
                        </td>
                        @endforeach
                    </tr>

                    @foreach ($days as $day)
                    <tr>
                        <td>{{ $day }}</td>
                        @foreach ($appointments as $appointment)
                        <td>
                            @if ($appointment->day == $day)
                                <a type="button" class="dropdown-item" data-toggle="modal"
                                    data-target="#Modal{{ $appointment->id }}">
                                    <p>
                                        <img src="{{ $appointment->image == 'avatar2.png' ? '/avatar2.png' : $appointment->image }}"
                                            alt="" style="width:60px; height:60px; border-radius:50%">
                                        {{ $appointment->name }}
                                    </p>
                                    <div>
                                        <span class="name">
                                            {{ $appointment->date }}
                                        </span>
                                    </div>
                                </a>
                            @endif

                            <!-- Modal -->
                            <div class="modal fade" id="Modal{{ $appointment->id }}" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <form
                                        action="{{ route('doctor.appointment_patients.update', $appointment->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel"> حالة الجلسة
                                                </h5>
                                                <button type="button" class="close" data-dismiss="modal"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">

                                                <div class="mt-3">

                                                    <p for=""> حالة الجلسة التى ستظهر للمريض</p>
                                                    <select name="status" class="form-controll col-md-6">
                                                        @foreach ($all_status as $status)
                                                            <option
                                                                {{ $loop->index == $appointment->status ? 'selected' : '' }}
                                                                value="{{ $loop->index }}">
                                                                {{ $status }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <input type="submit" class="btn btn-success"
                                                    value="تغيير الحالة">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </td>
                        @endforeach
                    </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
@else
    <div class="alert alert-danger  text-center d-flex justify-content-center" style="margin:100px">
        <p class=""> لا يوجد مواعيد حتى الان</p>
    </div>
@endif
</div>
@endsection
