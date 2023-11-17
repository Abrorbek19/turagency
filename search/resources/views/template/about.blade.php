<?php
use Illuminate\Support\Facades\DB;
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
</section>
@endforeach
<!-- End section -->
<!-- End SubHeader ============================================ -->
@php
    $welcome = \Illuminate\Support\Facades\DB::table('category_title')->where('category','welcome')->get();
@endphp

<div class="container margin_60">
    @foreach($welcome as $wel)
        @php
            $welModel = \App\Models\CategoryTitle::find($wel->id);
        @endphp
        <h2 class="main_title"><em></em>{{$welModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}<span>{{$welModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</span></h2>
        <p class="lead styled">
            {{$welModel->getTranslatedAttribute('content',$locale,'fallbackLocale')}}
        </p>
    @endforeach
        @foreach($event as $eve)
            @php
                $eveModel = \App\Models\Event::find($eve->id);
            @endphp
            @if($eve->id % 2 ===1)
                <div class="row about d-flex align-items-center">
                    <div class="col-lg-5 offset-lg-1">
                        <h3>{{$eveModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                        <p>
                            {{$eveModel->getTranslatedAttribute('content',$locale,'fallbackLocale')}}
                        </p>

                        @php
                            $itemIds = DB::table('event_items')->where('event_id', $eve->id)->pluck('room_item_id');

                            $itemTitles = DB::table('room_items')->whereIn('id', $itemIds)->get();
                        @endphp
                            <ul class="list_ok">
                            @foreach($itemTitles as $it)
                                    @php
                                        $itemModel = \App\Models\RoomItem::find($it->id);
                                    @endphp
                                <li>{{$itemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</li>
                            @endforeach
                            </ul>
                    </div>
                    <div class="col-lg-4 offset-lg-1">
                        <img src="storage/{{$eve->image}}" alt="{{$eve->title}}" class="img-fluid styled" style="width: 416px; height: 228px;background: center center;">
                    </div>
                </div>
                    <!-- End row -->
                <div class="divider"></div>
            @else
                <div class="row about d-flex align-items-center">
                    <div class="col-lg-5 offset-lg-1 order-lg-2">
                        <h3>{{$eveModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                        <p>
                            {{$eveModel->getTranslatedAttribute('content',$locale,'fallbackLocale')}}
                        </p>
                        @php
                            $itemIds = DB::table('event_items')->where('event_id', $eve->id)->pluck('room_item_id');

                            $itemTitles = DB::table('room_items')->whereIn('id', $itemIds)->get();
                        @endphp
                        <ul class="list_ok">
                            @foreach($itemTitles as $it)
                                @php
                                    $itemModel = \App\Models\RoomItem::find($it->id);
                                @endphp
                                <li>{{$itemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</li>
                            @endforeach
                        </ul>
                    </div>
                    <div class="col-lg-4 offset-lg-1 order-lg-1">
                        <img src="storage/{{$eve->image}}" alt="{{$eve->title}}" class="img-fluid styled" style="width: 416px; height: 228px;background: center center;">
                    </div>
                </div><!-- End row -->
                <div class="divider"></div>
            @endif
        @endforeach
</div><!-- End container -->

@php
    $fac_title = \Illuminate\Support\Facades\DB::table('category_title')->where('category','facility')->get();
@endphp

<div class="container_styled_1">
    <div class="container margin_60">
        @foreach($fac_title as $title)
            @php
                $titleModel = \App\Models\CategoryTitle::find($title->id);
            @endphp
        <h3 class="main_title">{{$titleModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}<span>{{$titleModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</span></h3>
        @endforeach
        <div class="row">
            @foreach($facility as $fac)
                @php
                    $facilityModel = \App\Models\Facility::find($fac->id);
                @endphp
            <div class="col-lg-4 col-md-6">
                <div class="box_feat">
                    <i class="{{$fac->icon}}"></i>
                    <h4>{{$facilityModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h4>
                    <p>{{$facilityModel->getTranslatedAttribute('content',$locale,'fallbackLocale')}}</p>
                </div>
            </div>
            @endforeach
        </div><!-- End row -->
    </div><!-- End container -->
</div><!-- End container_styled_1 -->

@php
    $about_image = \Illuminate\Support\Facades\DB::table('image')->where('category','about_image')->get();
@endphp
<div class="grid">
    <ul class="magnific-gallery" style="margin-bottom:-6px;">
        @foreach($about_image as $image)
            @php
                $imgtitleModel = \App\Models\Image::find($image->id);
            @endphp
        <li>
            <figure>
                <img src="storage/{{$image->image}}" alt="" style="width: 352px; height: 240px; background: center center;">
                <figcaption>
                    <div class="caption-content">
                        <a href="storage/{{$image->image}}" title="{{$imgtitleModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}">
                            <i class="icon_set_1_icon-32"></i>
                            <p>{{$imgtitleModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</p>
                        </a>
                    </div>
                </figcaption>
            </figure>
        </li>
        @endforeach
    </ul>
</div>

@endsection
