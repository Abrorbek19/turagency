<?php
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
    @endforeach<!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div class="container margin_60">
        <div class="isotope-wrapper position-relative">
            <div class="row justify-content-center magnific-gallery">
                @foreach($gallery as $gal)
                    @php
                        $imgModel = \App\Models\Gallery::find($gal->id);
                    @endphp
                <div class="item col-xl-4 col-lg-6 mb-4">
                    <div class="item-img">
                        <img src="storage/{{$gal->image}}" alt="{{$imgModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}">
                        <div class="content">
                            <a title="{{$imgModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}" href="storage/{{$gal->image}}"><i class="icon-camera-6"></i></a>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <!--/row -->
        </div>
        <!--/isotope-wrapper -->
    </div><!-- End container -->


@endsection
