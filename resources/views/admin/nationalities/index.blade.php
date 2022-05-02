@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('nationalities') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.nationalities.create') }}" class="btn btn-primary rounded-pill">
        {{ __('add_nlty') }} <i class="uil-plus"></i>
    </a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($nationalities as $nationality)
            <tr>
                <td class="d-flex align-items-center">
                    <img class="rounded-pill" src="{{ $nationality->flag }}" width="45" height="45" />
                    <div class="ms-3">
                        <h6 class="mb-1">{{ __('name') }}</h6>
                        {{ $nationality->nationality }}
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($nationality->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.nationalities.edit', $nationality->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $nationality->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal{{ $nationality->id }}" tabindex="-1" role="dialog" aria-labelledby="delNtltyModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="delNtltyModal">{{ __('base_msg_conf') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('del_ntly_msg_conf') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('cancel') }} <i class="uil uil-times"></i>
                                    </button>
                                    <form method="POST" class="form-inline" action="{{ route('admin.nationalities.destroy', $nationality->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('del_ntly') }} <i class="uil uil-trash"></i>
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
