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
    </section><!-- End section -->
    @endforeach
    <!-- End SubHeader ============================================ -->

    <!-- Content ================================================== -->
    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-3" id="sidebar">
                <div class="theiaStickySidebar">
                    <div id="faq_box">
                        <ul id="cat_nav">
                            @foreach($category as $cat)
                                @php
                                    $catModel = \App\Models\FaqCategory::find($cat->id);
                                @endphp
                            <li>
                                <a href="#accordion_{{$cat->id}}" class="{{ Request::is($catModel->getTranslatedAttribute('title',$locale,'fallbackLocale')) ? 'active' : '' }}">
                                    {{$catModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                </a>
                            </li>
                            @endforeach
                        </ul>
                    </div><!-- End box_style_1 -->
                </div><!-- End theiaStickySidebar -->
            </div><!-- End col-lg-3 -->
            <div class="col-lg-9">
                @php
                    // Har bir "category" uchun faqat bir marta ma'lumotni olish
                    $categories = \Illuminate\Support\Facades\DB::table('faq_category')->whereIn('id', $item->pluck('category'))->get();
                @endphp
                @foreach($categories as $category)
                    @php
                        $catModel = \App\Models\FaqCategory::find($category->id);
                    @endphp
                    <h3 class="nomargin_top">{{$catModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>

                    <div role="tablist" class="mb-5 accordion" id="accordion_{{$category->id}}">
                        @foreach($item->where('category', $category->id) as $ite)
                            @php
                                $itemModel = \App\Models\FaqItem::find($ite->id);
                            @endphp
                            <div class="card">
                                <div class="card-header" role="tab">
                                    <h5 class="mb-0">
                                        <a class="collapse" data-bs-toggle="collapse" href="#collapse{{$ite->id}}_accordion_{{$category->id}}" aria-expanded="false">
                                            <i class="indicator icon_set_1_icon-11"></i>{{$itemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                        </a>
                                    </h5>
                                </div>
                                <div id="collapse{{$ite->id}}_accordion_{{$category->id}}" class="collapse {{ Request::is($itemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')) ? 'show' : '' }}" role="tabpanel" data-bs-parent="#accordion_{{$category->id}}">
                                    <div class="card-body">
                                        {!!$itemModel->getTranslatedAttribute('content',$locale,'fallbackLocale') !!}
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

            </div><!-- End col-lg-9 -->
        </div><!-- End row -->
    </div><!-- End container -->
    <!-- End Content =============================================== -->


@endsection
