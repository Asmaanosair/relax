@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('pricing') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.pricings.create') }}" class="btn btn-primary rounded-pill">
        {{ __('add_nprice') }} <i class="uil uil-plus"></i>
    </a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($pricings as $pricing)
            <tr>
                <td>
                    <h6 class="mb-1">{{ __('title') }}</h6>
                    <a href="{{ route('admin.pricings.show', $pricing->id) }}">{{ $pricing->title }}</a>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('describtion') }}</h6>
                    {{ $pricing->describtion }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('price') }}</h6>
                    {{ $pricing->price }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('type') }}</h6>
                    {{ $pricing->type }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('color') }}</h6>
                    <div>
                        <div class="badge" style="background-color:{{ $pricing->color }}">
                            <span style="text-shadow: 0 1px #000">{{ __('color') }}</span>
                        </div>
                        <span class="bg-white border shadow-sm rounded fw-bold px-1 ms-1">{{ $pricing->color }}</span>
                    </div>
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($pricing->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="pricingActionsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="pricingActionsDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.pricings.show', $pricing->id) }}">
                                    <i class="uil uil-eye me-1"></i> {{ __('view') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.pricings.edit', $pricing->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $pricing->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                      </div>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal{{ $pricing->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ __('base_msg_conf') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('del_pricing_msg_conf') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('cancel') }} <i class="uil uil-times"></i>
                                    </button>
                                    <form method="POST" class="form-inline" action="{{ route('admin.pricings.destroy', $pricing->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('del_pricing') }} <i class="uil uil-trash"></i>
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