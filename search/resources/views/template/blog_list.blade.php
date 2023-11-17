<?php
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
?>


@extends('layout.room_detail')
@section('content')
    @php
        \Illuminate\Support\Facades\App::setLocale($locale)
    @endphp
    <!-- SubHeader =============================================== -->
    @foreach($image as $img)
        @php
            $imgModel = \App\Models\Image::find($img->id);
        @endphp
<section class="parallax-window" id="short" data-parallax="scroll" data-image-src="../storage/{{$img->image}}" data-natural-width="1400" data-natural-height="350">
    <div id="subheader">
        <h1>{{$imgModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h1>
    </div><!-- End subheader -->
</section>
    @endforeach<!-- End section -->
<!-- End SubHeader ============================================ -->

<div class="container margin_60_35">
    <div class="row">
        <div class="col-lg-9">
            @foreach($posts as $news)
            <div class="post">
                <a href="{{url('blog_list',$news->id)}}"><img src="../storage/{{$news->image}}" alt="{{$news->title}}" class="img-fluid" style="width: 922px; height: 450px;background: center center;"></a>
                <div class="post_info clearfix">
                    <div class="post-left">
                        @php
                            $newDate = date('d/m/Y', strtotime($news->date));

                             $newsModel = \App\Models\News::find($news->id);

                            $TagIds = DB::table('news_tags')->where('news_id', $news->id)->pluck('tag_id');
                            $TagTitles = DB::table('tags')->whereIn('id', $TagIds)->get();
                        @endphp
                        <ul>
                            <li><i class="icon-calendar-empty"></i>{{$newDate}} <em>{{ __('msg.by') }} {{$news->person}}</em></li>
                            <li><i class="icon-inbox-alt"></i><a href="#">{{$news->category}}</a></li>
                            <li><i class="icon-tags"></i>{{ __('msg.tags') }}
                                @foreach($TagTitles as $tag)
                                    @php
                                        $tagModel = \App\Models\Tag::find($tag->id);
                                    @endphp
                                    <a href="#">{{$tagModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a>,
                                @endforeach</li>
                        </ul>
                    </div>
                    <div class="post-right"><i class="icon-comment"></i><a href="#">{{$comment}}</a></div>
                </div>
                <h2>{{$newsModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h2>
                <p>
                    {{$newsModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                </p>
                {!!$newsModel->getTranslatedAttribute('content',$locale,'fallbackLocale')!!}
            </div>
            @endforeach<!-- end post -->
            <h4>{{$comment}} {{ __('msg.comments') }}</h4>
            <div id="comments">
                <ol>
                    @foreach($comments as $com)
                        @php
                            $newDate = date('d/m/Y', strtotime($com->date));
                        @endphp
                    <li>
                        <div class="avatar"><a href="#"><img src="../assets/img/avatar3.jpg" alt=""></a></div>
                        <div class="comment_right clearfix">
                            <div class="comment_info">
                                {{ __('msg.by') }} <a href="#">{{$com->name}}</a><span>|</span>{{$newDate}}
                            </div>
                            <p>
                                {{$com->comment}}
                            </p>
                        </div>
                    </li>
                    @endforeach
                </ol>
            </div><!-- End Comments -->

            <h4>{{ __('msg.leave_comment') }}</h4>
            <form action="{{'comment_message'}}" method="POST" id="comment_blog">
                @csrf
                <div class="form-group">
                    <input class="form-control styled" id="name" type="text" name="name" placeholder="{{ __('msg.enter_name') }}" required>
                </div>
                <div class="form-group">
                    <input class="form-control styled" type="text" id="email" name="email" placeholder="{{ __('msg.enter_email') }}" required>
                </div>
                <div class="form-group">
                    <textarea name="comment" id="comment" class="form-control styled" style="height:150px;" placeholder="{{ __('msg.message') }}" required></textarea>
                </div>


                <input type="hidden" class="form-control" name="blog_id" id="blog_id" value="{{$news->id}}">

                @php
                    $date = Carbon::now()->toDateTimeString()
                @endphp

                <input type="hidden" class="form-control" name="date" id="date" value="{{$date}}">

                <div class="form-group">
                    <input type="submit" class="btn_1" id="comment_btn" value="{{ __('msg.post_comment') }}">
                </div>

            </form>
        </div><!-- End col-md-9-->
        <aside class="col-lg-3" id="sidebar">
            <div class="widget">
                <div id="custom-search-input-blog">
                    <div class="input-group col-md-12">
                        <input type="text" class="form-control input-lg" placeholder="{{ __('msg.search') }}">
                        <span class="input-group-btn">
                                <button class="btn btn-info btn-lg" type="button">
                                    <i class="icon-search-1"></i>
                                </button>
                            </span>
                    </div>
                </div>
            </div><!-- End Search -->
            <hr>
            <div class="widget">
                <h4>{{ __('msg.category') }}</h4>
                <ul id="cat_nav_blog">
                    @foreach($category_news as $category)
                        @php
                            $categoryModel = \App\Models\CategoryNews::find($category->id);
                        @endphp
                        <li><a href="#">{{$categoryModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a></li>
                    @endforeach
                </ul>
            </div><!-- End widget -->
            <hr>
            <div class="widget">
                <h4>{{ __('msg.recent_post') }}</h4>
                <ul class="recent_post">
                    @foreach($recent as $post)
                        @php
                            $postModel = \App\Models\News::find($post->id);
                            $newDate = date('jS F, Y', strtotime($post->date));
                        @endphp
                    <li>
                        <i class="icon-calendar-empty"></i> {{$newDate}}
                        <div><a href="{{url('blog_list',$post->id)}}">{{$postModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a></div>
                    </li>
                    @endforeach
                </ul>
            </div><!-- End widget -->
            <hr>
            <div class="widget tags">
                <h4>{{ __('msg.tags') }}</h4>
                @foreach($TagTitles as $tag)
                    @php
                        $tagModel = \App\Models\Tag::find($tag->id);
                    @endphp
                    <a href="#">{{$tagModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a>
                @endforeach
            </div><!-- End widget -->
        </aside><!-- End aside -->
    </div>
</div><!-- End container -->
@endsection
