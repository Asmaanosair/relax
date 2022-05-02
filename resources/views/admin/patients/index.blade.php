@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('patients') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.patients.create') }}" class="btn btn-primary rounded-pill">
        {{ __('add_np') }} <i class="uil uil-plus"></i>
    </a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($patients as $patient)
            <tr>
                <td class="d-flex align-items-center">
                    <img class="rounded-pill" src="{{ $patient->image }}" width="45" height="45" />
                    <div class="ms-3">
                        <h6 class="mb-1">{{ __('name') }}</h6>
                        <a href="{{ route('admin.patients.show', $patient->id) }}">{{ $patient->name }}</a>
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('email') }}</h6>
                    {{ $patient->email }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('gender') }}</h6>
                    {{ $patient->gender }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('birthday') }}</h6>
                    {{ $patient->birthday }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('phone_number') }}</h6>
                    {{ $patient->phone }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($patient->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.patients.show', $patient->id) }}">
                                    <i class="uil uil-eye me-1"></i> {{ __('view') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.patients.edit', $patient->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $patient->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                      </div>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal{{ $patient->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('base_msg_conf') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('del_patient_msg_conf') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('cancel') }} <i class="uil uil-times"></i>
                                    </button>
                                    <form method="POST" class="form-inline" action="{{ route('admin.patients.destroy', $patient->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('del_patient') }} <i class="uil uil-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
            @empty
            <x-empty />
            @endforelse
        </tbody>
    </table>
</div>
@endsection
