@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('doctors') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.doctors.create') }}" class="btn btn-primary rounded-pill">{{ __('add_nd') }}</a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($doctors as $doctor)
            <tr>
                <td class="d-flex align-items-center">
                    <img class="rounded-pill" src="{{ $doctor->image }}" width="45" />
                    <div class="ms-3">
                        <h6 class="mb-1">{{ __('name') }}</h6>
                        <a href="{{ route('admin.doctors.show', $doctor->id) }}">{{ $doctor->name }}</a>
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('email') }}</h6>
                    {{ $doctor->email }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('gender') }}</h6>
                    {{ $doctor->gender }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('birthday') }}</h6>
                    {{ $doctor->birthday }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('phone_number') }}</h6>
                    {{ $doctor->phone }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($doctor->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.doctors.show', $doctor->id) }}">
                                    <i class="uil uil-eye me-1"></i> {{ __('view') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.doctors.edit', $doctor->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $doctor->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                      </div>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal{{ $doctor->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('base_msg_conf') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">{{ __('del_doctor_msg_conf') }}</div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('cancel') }} <i class="uil uil-times"></i>
                                    </button>
                                    <form method="POST" class="form-inline" action="{{ route('admin.doctors.destroy', $doctor->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('del_doc') }} <i class="uil uil-trash"></i>
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
