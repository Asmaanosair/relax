@extends('layouts.app')

@section('content')
<header class="d-flex align-items-center justify-content-between">
    <div>
        <h2>{{ __('questions') }}</h2>
        <p class="mb-0">Lorem ipsum, dolor sit amet consectetur adipisicing.</p>
    </div>
    <a href="{{ route('admin.question.create') }}" class="btn btn-primary rounded-pill">
        {{ __('add_nq') }} <i class="uil uil-plus"></i>
    </a>
</header>

<div class="table-responsive mt-4">
    <table class="table">
        <tbody>
            @forelse ($question as $q)
            <tr>
                <td>
                    <h6 class="mb-1">{{ __('question') }}</h6>
                    {{ $q->question }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('answer') }}</h6>
                    {{ $q->answer }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('created') }}</h6>
                    {{ optional($q->created_at)->diffForHumans() }}
                </td>
                <td>
                    <h6 class="mb-1">{{ __('actions') }}</h6>
                    <div class="dropdown">
                        <a class="dropdown-toggle text-dark fs-4" type="button" id="question-delete-modal" data-bs-toggle="dropdown" aria-expanded="false">
                          <i class="uil uil-ellipsis-h text-muted"></i>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="question-delete-modal">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.question.edit', $q->id) }}">
                                    <i class="uil uil-edit me-1"></i> {{ __('edit') }}
                                </a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#Modal{{ $q->id }}">
                                    <i class="uil uil-times me-1"></i> {{ __('delete') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="Modal{{ $q->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteQuestionModal" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteQuestionModal">{{ __('base_msg_conf') }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    {{ __('del_question_msg_conf') }}
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                                        {{ __('cancel') }} <i class="uil uil-times"></i>
                                    </button>
                                    <form method="POST" class="form-inline" action="{{ route('admin.question.destroy', $q->id) }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">
                                            {{ __('del_question') }} <i class="uil uil-trash"></i>
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





{{-- <div class="main-content">
    <div>
        <a href="{{route('admin.question.create')}}" class="btn btn-success add-department">
            <span class="plus"> +</span>
            <span class="text">اضافة سؤال </span>
        </a>
    </div>
    <h2 class="text-center">الاسأله </h2>
    <div class="row depts">
        @forelse($question as $row)
        <div class="col-md-3">

            <div class="depts-content">

                <ul class="navbar-nav control-card">
                    <li class="nav-item dropdown d-flex align-items-center">

                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">

                        </a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">

                            <a class="dropdown-item" href="{{route('admin.question.edit',$row->id)}}">تعديل </a>
                            <button type="button" class="dropdown-item" data-toggle="modal" data-target="#Modal{{$row->id}}">
                                حذف
                            </button>

                        </div>
                    </li>
                </ul>

                <!-- Modal -->
                <div class="modal fade" id="Modal{{$row->id}}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">حذف </h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                هل أنت متأكد بالفعل من أنك تريد حذف {{$row->question}}
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">لا</button>
                                <form method="POST" class="form-inline" action="{{route('admin.question.destroy',$row->id)}}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger"><i class="far fa-trash-alt"></i> نعم</button>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <img class="img-dept" src="{{asset('img/question.png')}}" alt="">
                </div>

                <p>

                    {{$row->question}}

                </p>
            </div>


        </div>
        @empty

        <div class="alert alert-danger  text-center d-flex justify-content-center">
            <p class=""> لا يوجد </p>

        </div>
        @endforelse


    </div>

</div>


<style>
    .depts p {
        border: 2px solid white;
        padding: 5px;
        border-radius: 10px
    }
</style>

 --}}
@endsection
