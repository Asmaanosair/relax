@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('pymnt_methods') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.payment_method.create') }}" class="btn btn-primary rounded-pill">{{ __('add_npm') }}</a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($clinics as $clinic)
            <tr>
                <td class="d-flex align-items-center">
                    <img class="rounded-pill" src="{{ $clinic->image }}" width="45" height="45" />
                    <div class="ms-3">
                        <h6 class="mb-1">{{ __('pymnt_mthd_name') }}</h6>
                        {{ $clinic->payment_method }}
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($clinic->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="actionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="actionsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.payment_method.edit', $clinic->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $clinic->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                        <!-- Modal -->
                        <div class="modal fade" id="Modal{{ $clinic->id }}" tabindex="-1" role="dialog" aria-labelledby="deletePaymentMethod" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="deletePaymentMethod">{{ __('base_msg_conf') }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">{{ __('del_pymnt_mthd_msg_conf') }}</div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                            {{ __('cancel') }} <i class="uil uil-times"></i>
                                        </button>
                                        <form method="POST" class="form-inline" action="{{ route('admin.payment_method.destroy', $clinic->id) }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">
                                                {{ __('del_pymnt_mthd') }} <i class="uil uil-trash"></i>
                                            </button>
                                        </form>
                                    </div>
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
