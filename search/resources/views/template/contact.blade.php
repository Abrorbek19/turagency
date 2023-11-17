<?php
use Carbon\Carbon;
?>

@extends('layout.main')
@section('content')
    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp

    <!-- SubHeader =============================================== -->
    @foreach($image as $img)
        @php
            $imgModel = \App\Models\Image::find($img->id);
        @endphp
    <section class="parallax-window" id="short" data-parallax="scroll" data-image-src="storage/{{$img->image}}" data-natural-width="1400" data-natural-height="350">
        <div id="subheader">
            <h1>{{$imgModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h1>
        </div><!-- End subheader -->
    </section><!-- End section -->
    @endforeach
    <!-- End SubHeader ============================================ -->
    @php
        $welcome = \Illuminate\Support\Facades\DB::table('category_title')->where('category','welcome')->get();
    @endphp
    <div class="container margin_60_35">
        @foreach($welcome as $wel)
            @php
                $welcomeModel = \App\Models\CategoryTitle::find($wel->id);
            @endphp

        <h2 class="main_title"><em></em>{{$welcomeModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}} <span>{{$welcomeModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</span></h2>
        @endforeach
        <div class="row add_top_20">

            <div class="col-lg-4">
                <div class="box_style_1">
                    <div class="box_contact">
                        <i class="icon_set_1_icon-41"></i>
                        <h5>{{ __('msg.address') }}</h5>
                        @foreach($information as $info)
                            @php
                                $infoModel = \App\Models\Information::find($info->id);
                            @endphp
                        <p>{{$infoModel->getTranslatedAttribute('address',$locale,'fallbackLocale')}}<br><a href="tel://{{$info->phone}}">{{$info->phone}}</a></p>
                        @endforeach
                    </div>
                    <div class="box_contact">
                        <i class="icon_set_1_icon-37"></i>
                        <h5>{{ __('msg.get_direction') }}</h5>
                        <form action="https://maps.google.com/maps" method="get" target="_blank">
                            <div class="form-group">
                                <input type="text" name="saddr" placeholder="{{ __('msg.start_point') }}" class="form-control">
                                <input type="hidden" name="daddr" value="DataSite Technology веб студия"><!-- Write here your end point -->
                            </div>
                            <div class="form-group">
                                <button class="btn_1" type="submit" value="{{ __('msg.get_direction') }}">{{ __('msg.get_direction') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-7 offset-lg-1">

                <div id="message-contact"></div>
                <form method="post" action="{{'contact_message'}}" id="contactform">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.first_name') }}</label>
                                <input type="text" class="form-control" id="first_name" required name="first_name" placeholder="{{ __('msg.enter_name') }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.last_name') }}</label>
                                <input type="text" class="form-control" id="last_name" required name="last_name" placeholder="{{ __('msg.enter_last') }}">
                            </div>
                        </div>
                    </div>
                    <!-- End row -->
                    <div class="row">
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.email') }}</label>
                                <input type="email" id="email" name="email" class="form-control" required placeholder="{{ __('msg.enter_email') }}">
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.phone') }}</label>
                                <input type="text" id="phone" name="phone" class="form-control" required placeholder="{{ __('msg.enter_phone') }}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{ __('msg.message') }}</label>
                                <textarea id="message" name="message" class="form-control" required placeholder="{{ __('msg.write_message') }}" style="height:150px;"></textarea>
                            </div>
                        </div>
                    </div>
                    @php
                        $created_at = Carbon::now()->toDateTimeString()
                    @endphp

                    <input type="hidden" class="form-control" name="created_at" id="created_at" value="{{$created_at}}">

                    <div class="row add_bottom_30">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>{{ __('msg.human') }}</label>
                                <input type="number" id="verify_contact"  class="form-control  add_bottom_10" name="verification" required placeholder="{{ __('msg.are_you') }}">
                                <p id="result"></p>
                            </div>
                            <input type="hidden" id="answer_contact"  value="" />
                            <input type="submit" value="{{ __('msg.submit') }}" class="btn_1 submit-contact" id="submit-contact">

                        </div>
                    </div>


                </form>
            </div><!-- End col-md-8 -->


        </div><!-- End row -->
    </div><!-- End Container -->

    <div id="map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2998.3560429143995!2d69.23629107663487!3d41.27935500268823!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x38ae8a60121a4933%3A0x2e06e174eda6444b!2zRGF0YVNpdGUgVGVjaG5vbG9neSAtINCy0LXQsSDRgdGC0YPQtNC40Y8!5e0!3m2!1sru!2s!4v1692093784523!5m2!1sru!2s" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
    </div><!-- End map -->


@endsection
