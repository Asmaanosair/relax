@extends('layouts.app')

@section('content')


<div class="goals">
        <div class="row">
            <div class="col-lg-3 col-md-5 side-bar">
                <ul class="list-group">
                    <li class="list-group-item active_dept">
                        <a href="">
                            علاج المدرسة المعرفية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة السلوكية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة الإنسانية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة التحليلية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاجات خاصة
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة المعرفية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة السلوكية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة الإنسانية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاج المدرسة التحليلية
                        </a>
                    </li>
                    <li class="list-group-item">
                        <a href="">
                            علاجات خاصة
                        </a>
                    </li>

                </ul>
            </div>
            <div class="col-lg-9 col-md-7 all-treatments">
                <div class="all-treatments-content">
                    <h2>علاج المدرسة المعرفية</h2>
                    <div>
                        <div class="form-check text-right px-5">
                            <input type="checkbox" class="form-check-input" id="exampleCheck1">
                            <label class="form-check-label" for="exampleCheck1">
                                جلسات يقظة ذهنية
                            </label>
                        </div>
                        <div class="info-treatment">
                            <div class="row">
                                <div class="col-lg-3 col-md-12">
                                    <select class="form-control">
                                        <option>نوع الجلسة </option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <select class="form-control">
                                        <option>عدد الجلسات</option>
                                    </select>
                                </div>
                                <div class="col-lg-3 col-md-12">
                                    <select class="form-control">
                                        <option>الالتزام الأسبوعى</option>
                                    </select>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    موعد الجلسات
                                </label>
                                <div class="row">
                                    <div class="col-lg-3 col-md-12">
                                        <select class="form-control">
                                            <option> التاريخ </option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <select class="form-control">
                                            <option>اليوم</option>
                                        </select>
                                    </div>
                                    <div class="col-lg-3 col-md-12">
                                        <select class="form-control">
                                            <option>الساعة</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    منفذ النشاط
                                </label>
                                <div class="row">
                                    <div class="col-md-6">
                                        <select class="form-control">
                                            <option>محمد أحمد </option>
                                        </select>
                                    </div>

                                </div>
                            </div>

                            <div class="mt-4">
                                <label class="form-check-label mb-2" for="exampleCheck1">
                                    أهداف الجلسة
                                </label>
                                <div class="border">
                                    <ul>
                                        <li class="text-right mt-3">
                                            هذا النص هو مثال لنص يمكن استبداله بنفس المساحة
                                        </li>
                                        <li class="text-right mt-3">
                                            هذا النص هو مثال لنص يمكن استبداله بنفس المساحة
                                        </li>
                                        <li class="text-right mt-3">
                                            هذا النص هو مثال لنص يمكن استبداله بنفس المساحة
                                        </li>

                                    </ul>
                                </div>
                            </div>
                            <div class="check-box-group">
                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات التكيف مع الضغوط
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات يقظة ذهنية
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات التكيف مع الضغوط

                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات يقظة ذهنية
                                        </label>
                                    </div>
                                </div>

                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات يقظة ذهنية
                                        </label>
                                    </div>
                                </div>
                                <div class="mt-4">
                                    <div class="form-check text-right px-5">
                                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                        <label class="form-check-label" for="exampleCheck1">
                                            جلسات يقظة ذهنية
                                        </label>
                                    </div>
                                </div>


                            </div>
                            <div class="text-left my-5">
                                <input type="submit" class="btn btn-success add px-5 py-1" value="حفظ">
                            </div>


                        </div>


                    </div>


                </div>

            </div>

        </div>

    </div>


@endsection