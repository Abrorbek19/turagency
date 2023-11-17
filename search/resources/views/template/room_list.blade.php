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
    </section><!-- End section -->
    @endforeach
    <!-- End SubHeader ============================================ -->

    <div class="container margin_60">
        <div class="row">
            <div class="col-lg-9">
                @foreach($rooms as $room)
                    @php
                        $roomModel = \App\Models\Room::find($room->id);
                    @endphp
                <div class="row room_desc wow fadeIn" onclick="location.href='/room_detail/{{$room->id}}'" data-wow-delay="0.1s">
                    <div class="col-md-7">
                        <figure><img src="storage/{{$room->image}}" alt="" class="img-fluid" style="width: 542px; height: 350px;background: center center;"></figure>
                    </div>
                    <div class="col-md-5 room_list_desc">

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
                        @if (isset($room->price))
                            @php
                                $pric = $price->whereIn('id', $room->price);
                            @endphp
                            @foreach($pric as $pr)
                                @php
                                    $priceModel = \App\Models\Price::find($pr->id);
                                @endphp
                                <div class="price">{{ __('msg.from') }} <strong>{{$priceModel->getTranslatedAttribute('icon',$locale,'fallbackLocale')}}{{$priceModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</strong> /{{$priceModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</div>
                            @endforeach
                        @endif
                    </div>
                </div>
                @endforeach
                    <div class="row">
                        <div class="col-12">
                            <ul class="pagination justify-content-center">
                                @if ($rooms->onFirstPage())
                                    <li class="page-item disabled"><span class="page-link">{{ __('msg.previous') }}</span></li>
                                @else
                                    <li class="page-item"><a class="page-link" href="{{ $rooms->previousPageUrl() }}">{{ __('msg.previous') }}</a></li>
                                @endif

                                @for ($i = 1; $i <= $rooms->lastPage(); $i++)
                                    @if ($i == $rooms->currentPage())
                                        <li class="page-item active"><span class="page-link">{{ $i }}</span></li>
                                    @else
                                        <li class="page-item"><a class="page-link" href="{{ $rooms->url($i) }}">{{ $i }}</a></li>
                                    @endif
                                @endfor

                                @if ($rooms->hasMorePages())
                                    <li class="page-item"><a class="page-link" href="{{ $rooms->nextPageUrl() }}">{{ __('msg.next') }}</a></li>
                                @else
                                    <li class="page-item disabled"><span class="page-link">{{ __('msg.next') }}</span></li>
                                @endif
                            </ul>
                        </div>
                    </div>
            <!-- End row room -->
            </div>
            <div class="col-lg-3 sidebar">
                <div class="theiaStickySidebar">
                    @foreach($facility as $fac)
                        @php
                            $facModel = \App\Models\GeneralFacility::find($fac->id);
                        @endphp
                    <div class="box_style_3" id="general_facilities">
                        <h3>{{$facModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3>
                        <ul>
                            @php
                                $facilityIds = DB::table('item_facility')->where('general_facility_id', $fac->id)->pluck('general_item_id');

                                $ItemTitles = DB::table('general_item')->whereIn('id', $facilityIds)->get();
                            @endphp
                                @foreach($ItemTitles as $it)
                                @php
                                    $itemModel = \App\Models\GeneralItem::find($it->id);
                                @endphp
                                    <li>
                                        <i class="{{$it->icon}}"></i>
                                        {{$itemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}
                                    </li>
                                @endforeach
                        </ul>
                    </div>
                    @endforeach
                    <div class="box_style_2">
                        <i class="icon_set_1_icon-90"></i>
                        <h4>{{ __('msg.need') }}</h4>
                        @foreach($information as $info)
                            @php
                                $infoModel = \App\Models\Information::find($info->id);
                            @endphp
                        <a href="tel://{{$info->phone}}" class="phone">{{$info->phone}}</a>
                        <small>{{$infoModel->getTranslatedAttribute('works_day',$locale,'fallbackLocale')}} / {{$infoModel->getTranslatedAttribute('works_time',$locale,'fallbackLocale')}}</small>
                        @endforeach
                    </div>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->

@endsection
