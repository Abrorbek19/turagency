
<?php
use Illuminate\Support\Facades\DB;
?>
@extends('layout.main')
@section('content')
    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp

    <!-- SubHeader =============================================== -->
    <div class="parallax-window" id="booking" data-parallax="scroll"  data-natural-width="1400" data-natural-height="550">

        <section class="header-video">
            <div id="hero_video">
                <div id="sub_content">
                    <div id="book_container" style="margin-top: 50px;">
                        <form method="POST" action="{{'room_book'}}" id="room_book_form" autocomplete="on">
                            @csrf
                            <div id="group_1">
                                <div id="container_1">
                                    <label>{{ __('msg.arrival') }}</label>
                                    <input class="date-pick form-control" type="text" id="check_in" name="arrival_date" data-date-format="mm-dd-yyyy" placeholder="{{ __('msg.arrival') }}" readonly>
                                    <span class="input-icon"><i class="icon-calendar-7"></i></span>
                                </div>
                                <div id="container_2">
                                    <label>{{ __('msg.departure') }}</label>
                                    <input class="date-pick form-control" type="text" id="check_out" name="departure_date" data-date-format="mm-dd-yyyy" placeholder="{{ __('msg.departure') }}" readonly>
                                    <span class="input-icon"><i class="icon-calendar-7"></i></span>
                                </div>
                            </div><!-- End group_1 -->
                            <div id="group_2">
                                <div id="container_3">
                                    <label>{{ __('msg.adults') }}</label>
                                    <div class="qty-buttons">
                                        <input type="button" value="-" class="qtyminus" name="adults">
                                        <input type="text" name="adults" id="adults" value="" class="qty form-control" placeholder="0">
                                        <input type="button" value="+" class="qtyplus" name="adults">
                                    </div>
                                </div>
                                <div id="container_4">
                                    <label>{{ __('msg.children') }}</label>
                                    <div class="qty-buttons">
                                        <input type="button" value="-" class="qtyminus" name="children">
                                        <input type="text" name="children" id="children" value="" class="qty form-control" placeholder="0">
                                        <input type="button" value="+" class="qtyplus" name="children">
                                    </div>
                                </div>
                            </div><!-- End group_2 -->
                            <div id="group_3">
                                <div id="container_5">
                                    <label>{{ __('msg.name') }}</label>
                                    <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('msg.name_desc') }}">
                                </div>
                                <div id="container_6">
                                    <label>{{ __('msg.phone') }}</label>
                                    <input type="text" class="form-control" name="phone" id="phone"  placeholder="{{ __('msg.phone_desc') }}">
                                </div>
                                <div id="container_6">
                                    <label>{{ __('msg.email') }}</label>
                                    <input type="text" class="form-control" name="email" id="email" placeholder="{{ __('msg.email_desc') }}">
                                </div>

                                <input type="hidden" class="form-control" name="room_id" id="room_id" value="mijoz">
                            </div><!-- End group_3 -->
                            <div id="container_7">
                                <input type="submit" value="{{ __('msg.check') }}" class="btn_1" id="room_booking">
                            </div>
                        </form>
                        <div id="message-booking"></div>
                    </div>
                </div><!-- End sub_content -->
            </div>
            <video class="header-video--media " autoplay loop muted data-video-src="video/intro" data-teaser-source="video/intro" data-provider="Vimeo" data-video-width="1920" data-video-height="960">
                <source src="assets/video/main_video.mp4" type="video/mp4">
            </video>

        </section><!-- End Header video -->

    </div><!-- End parallax-window -->
    <!-- End SubHeader ============================================ -->

    @php
        $welcome = \Illuminate\Support\Facades\DB::table('category_title')->where('category','welcome')->get();
    @endphp

    <div class="container margin_60_35">
        @foreach($welcome as $wel)
            @php
                $welModel = \App\Models\CategoryTitle::find($wel->id);
            @endphp
        <h1 class="main_title">
            <em></em>
            {{$welModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
            <span>
                {{$welModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
            </span>
        </h1>
        <p class="lead styled">
            {{$welModel->getTranslatedAttribute('content',$locale,'fallbackLocale')}}
        </p>
        @endforeach
        @php
        $nice  = \Illuminate\Support\Facades\DB::table('image')->where(['category'=>'Nice Outdoor'])->get();
        $large  = \Illuminate\Support\Facades\DB::table('image')->where(['category'=>'Large Bedroom'])->get();
        $bathroom  = \Illuminate\Support\Facades\DB::table('image')->where(['category'=>'Modern Bathroom'])->get();
        $wellness  = \Illuminate\Support\Facades\DB::table('image')->where(['category'=>'Wellness'])->get();
        @endphp
        <div class="row">
            @foreach($nice as $nic)
                @php
                $imageModel = \App\Models\Image::find($nic->id);
              @endphp
            <div class="col-lg-6">
                <div class="mosaic_container">
                    <img src="storage/{{$nic->image}}" alt="" class="img-fluid" style="width: 800px; height: 550px;background: center center;">
                    <span class="caption_2">{{$imageModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</span>
                </div>
            </div>
            @endforeach
            <div class="col-lg-6">
                @foreach($large as $lar)
                    @php
                        $imageModel = \App\Models\Image::find($lar->id);
                    @endphp
                    <div class="col-12">
                        <div class="mosaic_container">
                            <img src="storage/{{$lar->image}}" alt="" class="img-fluid" style="width: 800px; height: 265px;background: center center;">
                            <span class="caption_2">{{$imageModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</span>
                        </div>
                    </div>
                @endforeach
                <div class="row">
                    @foreach($bathroom as $bath)
                        @php
                            $imageModel = \App\Models\Image::find($bath->id);
                        @endphp
                    <div class="col-6">
                        <div class="mosaic_container">
                            <img src="storage/{{$bath->image}}" alt="" class="img-fluid" style="width: 400px; height: 265px;background: center center;">
                            <span class="caption_2">{{$imageModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</span>
                        </div>
                    </div>
                    @endforeach
                    @foreach($wellness as $well)
                            @php
                                $imageModel = \App\Models\Image::find($well->id);
                            @endphp
                    <div class="col-6">
                        <div class="mosaic_container">
                            <img src="storage/{{$well->image}}" alt="" class="img-fluid" style="width: 400px; height: 265px;background: center center;">
                            <span class="caption_2">{{$imageModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</span>
                        </div>
                    </div>
                    @endforeach
                </div><!-- End row -->
            </div>
        </div><!-- End row -->
    </div><!-- End container -->

    @foreach($rooms as $room)
        @if($room->id % 2 === 1)
        <div class="container_styled_1">
            <div class="container margin_60">
                <div class="row">
                    <div class="col-lg-5 offset-lg-1">
                        <figure class="room_pic">
                            <a href="{{url('room_detail',$room->id)}}">
                                <img src="storage/{{$room->image}}" alt="" class="img-fluid"  style="width: 536px; height: 316px;background: center center;">
                            </a>
                            @if (isset($room->price))
                                @php
                                    $priceIDs = json_decode($room->price);
                                    $pric = $price->whereIn('id', $priceIDs);
                                @endphp
                                @foreach($pric as $pr)
                                    @php
                                        $priceModel = \App\Models\Price::find($pr->id);
                                   @endphp
                                <span class="wow zoomIn">
                                    <sup>{{$priceModel->getTranslatedAttribute('icon',$locale,'fallbackLocale')}}</sup>{{$priceModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                    <small>
                                        {{$priceModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                    </small>
                                </span>
                                @endforeach
                            @endif
                        </figure>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <div class="room_desc_home">
                            @php
                              $roomModel = \App\Models\Room::find($room->id);
                            @endphp
                            <h3>{{$roomModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                            <p>
                                {{$roomModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                            </p>
                                @php
                                $jihozlarIds = DB::table('rooms_jihozlar')
                                ->where('room_id', $room->id)
                                ->pluck('jihozlar_id');

                                    $jihozlarTitles = DB::table('jihozlar')
                                ->whereIn('id', $jihozlarIds)->get();
                                @endphp
                            <ul>
                                @foreach($jihozlarTitles as $jihoz)
                                    @php
                                        $jihozModel = \App\Models\Jihozlar::find($jihoz->id);
                                    @endphp
                                <li>
                                    <div class="tooltip_styled tooltip-effect-4">
                                        <span class="tooltip-item">
                                            <i class="{{$jihoz->icon}}"></i>
                                        </span>
                                        <div class="tooltip-content">
                                            {{$jihozModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
{{--                                            {{$jihoz->title}}--}}
                                        </div>
                                    </div>
                                </li>
                                @endforeach
                            </ul>
                            <a href="{{url('room_detail',$room->id)}}" class="btn_1_outline">{{ __('msg.more') }}</a>
                        </div><!-- End room_desc_home -->
                    </div>
                </div>
                    <!-- End row -->
            </div>
            <!-- End container -->
        </div>
        <!-- End container_styled_1 -->
        @else
            <div class="container margin_60">
                <div class="row">
                        <div class="col-lg-4 offset-lg-1">
                            <div class="room_desc_home">
                                @php
                                  $roomModel = \App\Models\Room::find($room->id);
                                @endphp
                                <h3>{{$roomModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                                <p>
                                    {{$roomModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                </p>
                                    @php
                                        $jihozlarIds = DB::table('rooms_jihozlar')->where('room_id', $room->id)->pluck('jihozlar_id');

                                        $jihozlarTitles = DB::table('jihozlar')->whereIn('id', $jihozlarIds)->get();
                                    @endphp
                                    <ul>
                                        @foreach($jihozlarTitles as $jihoz)
                                            @php
                                                $jihozModel = \App\Models\Jihozlar::find($jihoz->id);
                                            @endphp
                                            <li>
                                                <div class="tooltip_styled tooltip-effect-4">
                                                    <span class="tooltip-item">
                                                        <i class="{{$jihoz->icon}}"></i>
                                                    </span>
                                                    <div class="tooltip-content">
                                                        {{$jihozModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                <a href="{{url('room_detail',$room->id)}}" class="btn_1_outline">{{ __('msg.more') }}</a>
                            </div><!-- End room_desc_home -->
                        </div>
                        <div class="col-lg-5 offset-lg-1">
                            <figure class="room_pic left">
                                <a href="{{url('room_detail',$room->id)}}">
                                    <img src="storage/{{$room->image}}" alt="" class="img-fluid"  style="width: 536px; height: 316px;background: center center;">
                                </a>
                                @if (isset($room->price))
                                    @php
                                        $priceIDs = json_decode($room->price);
                                        $pric = $price->whereIn('id', $priceIDs);
                                    @endphp
                                    @foreach($pric as $pr)
                                        @php
                                            $priceModel = \App\Models\Price::find($pr->id);
                                        @endphp
                                        <span class="wow zoomIn" >
                                    <sup>{{$priceModel->getTranslatedAttribute('icon',$locale,'fallbackLocale')}}</sup>{{$priceModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                    <small>
                                        {{$priceModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                    </small>
                                </span>
                                    @endforeach
                                @endif
                            </figure>
                        </div>
                </div>
                <!-- End row -->
            </div>
            <!-- End container -->
        @endif
    @endforeach

    @php
        $client = \Illuminate\Support\Facades\DB::table('category_title')->where('category','client')->get();
       $client_image = \Illuminate\Support\Facades\DB::table('image')->where(['category'=>'client'])->get();
  @endphp

{{-- Background image --}}
    @foreach($client_image as $image)
    <section style="
    height: auto;
    background: url(../storage/{{$image->image}}) no-repeat center center;
    background-attachment: fixed;
    background-size: cover;
    -webkit-background-size: cover;
    -moz-background-size: cover;
    -o-background-size: cover;
    position: relative;"
    >
    @endforeach
{{--       End background image --}}

        <div class="promo_full_wp">
            <div>
                @foreach($client as $title)
                    @php
                        $clientModel = \App\Models\CategoryTitle::find($title->id);
                    @endphp
                <h3>{{$clientModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}<span>{{$clientModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</span></h3>
                @endforeach
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-7">
                            <div class="owl-carousel owl-theme carousel_testimonials">
                                @foreach($client_say as $say)
                                    @php
                                        $sayModel = \App\Models\ClientSay::find($say->id);
                                    @endphp
                                    @php
                                     $formattedDate = date('d F Y', strtotime($say->date));
                                   @endphp
                                <div>
                                    <div class="box_overlay">
                                        <div class="pic">
                                            <figure><img src="storage/{{$say->image}}" alt="" class="img-circle"></figure>
                                            <h4>{{$sayModel->getTranslatedAttribute('name',$locale,'fallbackLocale')}}<small>{{$formattedDate}}</small></h4>
                                        </div>
                                        <div class="comment">
                                            {{$sayModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                                        </div>
                                    </div><!-- End box_overlay -->
                                </div>
                                @endforeach
                            </div><!-- End carousel_testimonials -->
                        </div><!-- End col-lg-8 -->
                    </div><!-- End row -->
                </div><!-- End container -->
            </div><!-- End promo_full_wp -->
        </div><!-- End promo_full -->
    </section><!-- End section -->

@endsection
