<?php
use \Illuminate\Support\Facades\DB;
?>


@extends('layout.room_detail')
@section('content')

    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp
<div class="owl-carousel owl-theme carousel_in">
    @foreach($room_images as $image)
        @php
            $imageModel = \App\Models\RoomImages::find($image->id);
        @endphp
    <div><img src="../storage/{{$image->image}}" alt="" style="width: 1000px; height: 430px;background: center center;"><div class="caption"><h3>{{$imageModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h3></div></div>
    @endforeach
</div>

<div class="container add_bottom_60">
    @foreach($rooms as $title)
        @php
            $titleModel = \App\Models\Room::find($title->id);
        @endphp
    <h1 class="main_title_in">{{$titleModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h1>
    @endforeach
    <div class="row">
        <div class="col-lg-8">
            <div id="single_room_feat">
                @php
                    $jihozlarIds = DB::table('rooms_jihozlar')->where('room_id', $title->id)->pluck('jihozlar_id');

                    $jihozlarTitles = DB::table('jihozlar')->whereIn('id', $jihozlarIds)->get();
                @endphp
                <ul>
                    @foreach($jihozlarTitles as $jihoz)
                        @php
                            $jihozModel = \App\Models\Jihozlar::find($jihoz->id);
                        @endphp
                                <li><i class="{{$jihoz->icon}}"></i>{{$jihozModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</li>
                    @endforeach
                </ul>
            </div>
            <div class="row">
                <div class="col-md-3">
                    <h3>{{ __('msg.description') }}</h3>
                </div>
                <div class="col-md-9">
                @foreach($rooms as $description)
                        @php
                            $descriptionModel = \App\Models\Room::find($description->id);
                        @endphp
                    <p>
                        {{$descriptionModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                    </p>
                @endforeach

                @foreach($room_facility as $facility)
                        @php
                            $facilityModel = \App\Models\RoomFacility::find($facility->id);
                        @endphp
                    <h4>{{$facilityModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h4>

                    <p>
                        {{$facilityModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                    </p>
                    <div class="row">
                        @php
                            $facilityIds = DB::table('room_item_facility')->where('room_facility_id', $facility->id)->pluck('room_item_id');

                            $jihozlarTitles = DB::table('room_items')->whereIn('id', $facilityIds)->get();
                        @endphp
                                @foreach(array_chunk($jihozlarTitles->toArray(), 4) as $chunk)
                                    <div class="col-md-4 col-sm-4">
                                        <ul class="list_ok">
                                            @foreach($chunk as $id)
                                                @php
                                                    $ItemModel = \App\Models\RoomItem::find($id->id);
                                                @endphp
                                                    <li>{{$ItemModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach

                    </div>
                    @endforeach
                    <!-- End row  -->
                </div><!-- End col-md-9  -->
            </div><!-- End row  -->
            <hr>

            @php
                $positions = DB::table('room_comment')->where(['room_id'=>$title->title])->pluck('position');
                $comfort = DB::table('room_comment')->where(['room_id'=>$title->title])->pluck('comfort');
                $price = DB::table('room_comment')->where(['room_id'=>$title->title])->pluck('price');
                $quality = DB::table('room_comment')->where(['room_id'=>$title->title])->pluck('quality');
                $comment = DB::table('room_comment')->where(['room_id'=>$title->title])->get();
                $count = DB::table('room_comment')->where(['room_id'=>$title->title])->count();

                $averagePosition = $positions->sum() / $positions->count();
                $averageComfort = $comfort->sum() / $comfort->count();
                $averagePrice = $price->sum() / $price->count();
                $averageQuality = $quality->sum() / $quality->count();
                $averageOverall = ($averagePosition + $averageComfort + $averagePrice + $averageQuality) / 4;
                $starCount = round($averageOverall * 2) / 2;
            @endphp

            <div class="row">
                <div class="col-md-3">
                    <h3>{{ __('msg.review') }}</h3>
                    <a href="#" class="btn_1 add_bottom_15" data-bs-toggle="modal" data-bs-target="#myReview">{{ __('msg.leave_review') }}</a>
                </div>
                <div class="col-md-9">
                    <div id="score_detail"><span>{{$starCount}}/5</span>{{ __('msg.good') }} <small>({{ __('msg.based_on') }} {{$count}} {{ __('msg.reviews') }})</small></div><!-- End general_rating -->
                    <div class="row" id="rating_summary">
                        <div class="col-md-6">
                            <ul>
                                <li>{{ __('msg.position') }}
                                    <div class="rating">
                                        @if ($positions->count() > 0)
                                            @php
                                                $average = $positions->sum() / $positions->count();
                                                $starCount = round($average);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $starCount)
                                                    <i class="icon-star"></i>
                                                @else
                                                    <i class="icon-star-empty"></i>
                                                @endif
                                            @endfor
                                        @else
                                        @endif
                                    </div>
                                </li>
                                <li>{{ __('msg.comfort') }}
                                    <div class="rating">
                                        @if ($comfort->count() > 0)
                                            @php
                                                $average = $comfort->sum() / $comfort->count();
                                                $starCount = round($average);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $starCount)
                                                    <i class="icon-star"></i>
                                                @else
                                                    <i class="icon-star-empty"></i>
                                                @endif
                                            @endfor
                                        @else
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-6">
                            <ul>
                                <li>{{ __('msg.price') }}
                                    <div class="rating">
                                        @if ($price->count() > 0)
                                            @php
                                                $average = $price->sum() / $price->count();
                                                $starCount = round($average);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $starCount)
                                                    <i class="icon-star"></i>
                                                @else
                                                    <i class="icon-star-empty"></i>
                                                @endif
                                            @endfor
                                        @else
                                        @endif
                                    </div>
                                </li>
                                <li>{{ __('msg.quality') }}
                                    <div class="rating">
                                        @if ($quality->count() > 0)
                                            @php
                                                $average = $quality->sum() / $quality->count();
                                                $starCount = round($average);
                                            @endphp

                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $starCount)
                                                    <i class="icon-star"></i>
                                                @else
                                                    <i class="icon-star-empty"></i>
                                                @endif
                                            @endfor
                                        @else
                                        @endif
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div><!-- End row -->
                    <hr>
                    @foreach($comment as $comm)
                        @php
                            $commentModel = \App\Models\RoomComment::find($comm->id);
                        @endphp
                    <div class="review_strip_single">

                        <img src="../assets/img/avatar1.jpg" alt="" class="img-circle">
                        @php
                            $positions = DB::table('room_comment')->where(['room_id'=>$title->title,'name'=>$comm->name])->pluck('position');
                            $comfort = DB::table('room_comment')->where(['room_id'=>$title->title,'name'=>$comm->name])->pluck('comfort');
                            $price = DB::table('room_comment')->where(['room_id'=>$title->title,'name'=>$comm->name])->pluck('price');
                            $quality = DB::table('room_comment')->where(['room_id'=>$title->title,'name'=>$comm->name])->pluck('quality');
                            $newDate = date('d F Y', strtotime($comm->date));
                        @endphp
                        <small> - {{$newDate}} -</small>
                        <h4>{{$commentModel->getTranslatedAttribute('name',$locale,'fallbackLocale')}}</h4>
                        <p>
                            "{{$commentModel->getTranslatedAttribute('comment',$locale,'fallbackLocale')}}"
                        </p>
                        <div class="rating">
                            @if ($quality->count() > 0)
                                @php
                                    $averagePosition = $positions->sum() / $positions->count();
                                    $averageComfort = $comfort->sum() / $comfort->count();
                                    $averagePrice = $price->sum() / $price->count();
                                    $averageQuality = $quality->sum() / $quality->count();
                                    $averageOverall = ($averagePosition + $averageComfort + $averagePrice + $averageQuality) / 4;
                                    $starCount = round($averageOverall);
                                @endphp

                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($i <= $starCount)
                                        <i class="icon-star"></i>
                                    @else
                                        <i class="icon-star-empty"></i>
                                    @endif
                                @endfor
                            @else
                            @endif
                        </div>

                    </div>
                    @endforeach<!-- End review strip -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3">
                    <h3>{{ __('msg.policy') }}</h3>
                </div>
                <div class="col-md-9">
                    <ul id="policies">
                        @foreach($policy as $polic)
                            @php
                                $policyModel = \App\Models\Policy::find($polic->id);
                            @endphp
                        <li><i class="{{$polic->icon}}"></i>
                            <h5>{{$policyModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h5>
                            <p>{{$policyModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}</p>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div><!-- End col -->

        <div class="col-lg-4" id="sidebar">
            <div class="box_style_1">
                <div id="message-booking"></div>
                <form method="post" action="{{'room_book'}}" id="room_book_form" autocomplete="on">
                    @csrf
                    <input name="room_id" id="room_id" type="hidden" value="{{$title->title}}">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('msg.arrival') }}</label>
                                <input class="date-pick form-control" type="text" id="check_in" name="arrival_date" placeholder="{{ __('msg.arrival') }}" data-date-format="mm-dd-yyyy" readonly>
                                <span class="input-icon"><i class="icon-calendar-7"></i></span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('msg.departure') }}</label>
                                <input class="date-pick form-control" type="text" id="check_out" name="departure_date" placeholder="{{ __('msg.departure') }}" data-date-format="mm-dd-yyyy" readonly>
                                <span class="input-icon"><i class="icon-calendar-7"></i></span>
                            </div>
                        </div>
                    </div><!-- End row -->
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('msg.adults') }}</label>
                                <div class="qty-buttons">
                                    <input type="button" value="-" class="qtyminus" name="adults">
                                    <input type="text" name="adults" id="adults" value="" class="qty form-control" placeholder="0">
                                    <input type="button" value="+" class="qtyplus" name="adults">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>{{ __('msg.children') }}</label>
                                <div class="qty-buttons">
                                    <input type="button" value="-" class="qtyminus" name="children">
                                    <input type="text" name="children" id="children" value="" class="qty form-control" placeholder="0">
                                    <input type="button" value="+" class="qtyplus" name="children">
                                </div>
                            </div>
                        </div>
                    </div><!-- End row -->
                    <div class="row">
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.name') }}</label>
                                <input type="text" class="form-control" name="name" id="name" placeholder="{{ __('msg.name_desc') }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.phone') }}</label>
                                <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('msg.phone_desc') }}">
                            </div>
                        </div>
                        <div class="col-md-12 col-sm-6">
                            <div class="form-group">
                                <label>{{ __('msg.email') }}</label>
                                <input type="text" class="form-control" name="email" id="email" placeholder="{{ __('msg.email_desc') }}">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <input type="submit" value="{{ __('msg.book') }}" class="btn_full" id="room_booking">
                            </div>
                        </div>
                    </div>
                </form>
                <hr>
                <a href="#phone_2" class="btn_outline"> {{ __('msg.contact_us') }}</a>
                <a href="tel://004542344599" id="phone_2"><i class="icon_set_1_icon-91"></i>+45 423 445 99</a>
            </div><!-- End box_style -->
        </div><!-- End col -->
    </div><!-- End row -->

</div><!-- End container -->

@endsection
