@extends('layouts.app')

@section('content')

<div class="goals">
    <div class="row">
        <!-- <div class="col-md-3 side-bar">
            <ul class="list-group">
                <li class="list-group-item active_dept">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>
                <li class="list-group-item">
                    <a href="">
                        قسم1
                    </a>
                </li>


            </ul>
        </div> -->
        <div class="col-md-7  goals-container">
            <h2 class="mb-3">كتابة خطة العلاج</h2>
            <form action="{{route('doctor.treatment_goals.update',$id)}}" method="post">
                @csrf
                @method('PUT')
                <div>

                    <!------------------------------------------- Start editor --------------------------->
                    <div class="form-group">

                        <div id="tools"></div>
                        <div id="editor"></div>
                        <textarea required hidden class="target-styling" name="goals">{{isset($goals)?$goals->goals:''}}</textarea>
                    </div>
                    <!------------------------------------------- End editor --------------------------->

                    <div class="text-left my-1">
                        <input type="submit" value="حفظ" class="btn save-goals btn-success add add-data text-light" />

                    </div>
                </div>

            </form>


        </div>

    </div>

</div>
@endsection
