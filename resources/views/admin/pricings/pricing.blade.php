@extends('layouts.app')
@section('style-nav')
<style>
    nav,
    .departments {
        display: none !important;
    }
</style>
@endsection
@section('content')

<div id="mainCoantiner" dir=ltr>

    <div class="margin-body">

        <div>
            <div class="starsec"></div>
            <div class="starthird"></div>
            <div class="starfourth"></div>
            <div class="starfifth"></div>
        </div>


        <div class="row">
            <div class="col-sm-12 col-md-12">
                <div class="wpb_text_column wpb_content_element ">
                    <div class="wpb_wrapper">
                        <div class="title-h1 text-center"><span><span class="light">pricing </span> table</span></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-center mb-3" dir="rtl">
            <button class="show-pricing btn text-light" data-type="type-1">Annual</button>
            <button class="show-pricing btn text-light mx-3 active-pricing" data-type="type-0">Monthly</button>
        </div>

        <div class="row ">


            @forelse($pricings as $pricing)

            <div class="col-md-4 pricing-column-wrapper pricing type-{{$pricing->type}}">
                <div class="pricing-column">
                    <div class="pricing-price-row">
                        <div class="pricing-price-wrapper">
                            <div class="pricing-price" style="background-color:{{$pricing->color}}">
                                <div class="pricing-cost">

                                    {{$pricing->price}}$
                                </div>
                                <div class="time">Per {{$pricing->type=='0'?'Month':'Annual'}}</div>
                            </div>
                        </div>
                    </div>
                    <div class="pricing-row-title">
                        <div class="pricing_row_title" style="color:{{$pricing->color}}">{{$pricing->title}}</div>
                    </div>
                    {{ !$exp_pricings=explode("-",$pricing->describtion)}}

                    @foreach($exp_pricings as $exp_pricing)
                    <figure class="pricing-row" style="color:{{$pricing->color}}">
                        <span style="color:white; font-size:18px">
                            {{$exp_pricing}}
                        </span>
                    </figure>
                    @endforeach
                    <div class="pricing-footer">
                        <div class="gem-button-container gem-button-position-center">
                            <a target="_blank" class="gem-button gem-green" style="color:{{$pricing->color}}!important;border:1px solid {{$pricing->color}} !important;">Select</a>
                        </div>
                    </div>
                </div>
            </div>

            @empty

            @endforelse


















            <!--
    <div class="col-md-4 pricing-column-wrapper pricing type-0">
       <div class="pricing-column">
              <div class="pricing-price-row">
                <div class="pricing-price-wrapper">
                  <div class="pricing-price">
                    <div class="pricing-cost">$45</div>
                    <div class="time">Per Month</div>
                  </div>
                </div>
              </div>
              <div class="pricing-row-title">
                <div class="pricing_row_title">Plan B</div>
              </div>
              <figure class="pricing-row">Photo sharing school</figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Drop out ramen hustle</span></figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Crush revenue traction</span></figure>
              <figure class="pricing-row strike">Crush revenue traction</figure>
              <figure class="pricing-row strike">User base minimum viable</figure>
              <figure class="pricing-row strike">Lorem ipsum dolor</figure>
              <div class="pricing-footer">
                <div class="gem-button-container gem-button-position-center">
                  <a class="gem-button gem-purpel">Select</a></div>
              </div>
            </div>
    </div>

    <div class="col-md-4 pricing-column-wrapper pricing type-0">
      <div class="pricing-column">
              <div class="pricing-price-row">
                <div class="pricing-price-wrapper">
                  <div class="pricing-price">
                    <div style=" " class="pricing-cost">$145</div>
                    <div class="time" style="display:inline-block;">Per Month</div>
                  </div>
                </div>
              </div>
              <div class="pricing-row-title">
                <div class="pricing_row_title">Plan C</div>
              </div>
              <figure class="pricing-row">Photo sharing school</figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Drop out ramen hustle</span></figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Crush revenue traction</span></figure>
              <figure class="pricing-row">Crush revenue traction</figure>
              <figure class="pricing-row">User base minimum</figure>
              <figure class="pricing-row strike">Lorem ipsum dolor</figure>
              <div class="pricing-footer">
                <div class="gem-button-container gem-button-position-center">
                  <a class="gem-button gem-orange">Select</a></div>
              </div>
            </div>
    </div> -->

            <!-- <div class="col-md-4 pricing-column-wrapper pricing type-1">
         <div class="pricing-column">
              <div class="pricing-price-row">
                <div class="pricing-price-wrapper">
                  <div class="pricing-price">
                    <div class="pricing-cost">$10</div>
                    <div class="time">Per Annual</div>
                  </div>
                </div>
              </div>
              <div class="pricing-row-title">
                <div class="pricing_row_title">Paln A</div>
              </div>
              <figure class="pricing-row">Photo sharing school</figure>
              <figure class="pricing-row"><span>Drop out ramen hustle</span></figure>
              <figure class="pricing-row strike">Crush revenue traction</figure>
              <figure class="pricing-row strike">Crush revenue traction</figure>
              <figure class="pricing-row strike">User base minimum viable</figure>
              <figure class="pricing-row strike">Lorem ipsum dolor</figure>
              <div class="pricing-footer">
                <div class="gem-button-container gem-button-position-center">
                  <a  target="_blank" class="gem-button gem-yellow">Select</a></div>
              </div>
            </div>
    </div>

    <div class="col-md-4 pricing-column-wrapper pricing type-1">
       <div class="pricing-column">
              <div class="pricing-price-row">
                <div class="pricing-price-wrapper">
                  <div class="pricing-price">
                    <div class="pricing-cost">$45</div>
                    <div class="time">Per Annual</div>
                  </div>
                </div>
              </div>
              <div class="pricing-row-title">
                <div class="pricing_row_title">Plan B</div>
              </div>
              <figure class="pricing-row">Photo sharing school</figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Drop out ramen hustle</span></figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Crush revenue traction</span></figure>
              <figure class="pricing-row strike">Crush revenue traction</figure>
              <figure class="pricing-row strike">User base minimum viable</figure>
              <figure class="pricing-row strike">Lorem ipsum dolor</figure>
              <div class="pricing-footer">
                <div class="gem-button-container gem-button-position-center">
                  <a class="gem-button gem-yellow">Select</a></div>
              </div>
            </div>
    </div>

    <div class="col-md-4 pricing-column-wrapper pricing type-1">
      <div class="pricing-column">
              <div class="pricing-price-row">
                <div class="pricing-price-wrapper">
                  <div class="pricing-price">
                    <div style=" " class="pricing-cost">$145</div>
                    <div class="time" style="display:inline-block;">Per Annual</div>
                  </div>
                </div>
              </div>
              <div class="pricing-row-title">
                <div class="pricing_row_title">Plan C</div>
              </div>
              <figure class="pricing-row">Photo sharing school</figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Drop out ramen hustle</span></figure>
              <figure class="pricing-row"><span style="color: #5f727f;">Crush revenue traction</span></figure>
              <figure class="pricing-row">Crush revenue traction</figure>
              <figure class="pricing-row">User base minimum</figure>
              <figure class="pricing-row strike">Lorem ipsum dolor</figure>
              <div class="pricing-footer">
                <div class="gem-button-container gem-button-position-center">
                  <a class="gem-button gem-yellow">Select</a></div>
              </div>
            </div>
    </div> -->


        </div>

    </div>
</div>




<script>
    let x = $(".pricing-row").css();

    $(".pricing-row").css({
        color: "{{$pricing->color}} !important"
    })
</script>
@endsection
