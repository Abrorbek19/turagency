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
    @endforeach<!-- End section -->
    <!-- End SubHeader ============================================ -->

    <div class="container margin_60_35">
        <div class="row">
            <div class="col-lg-9">
                @foreach($news as $new)
                    @php
                        $newModel = \App\Models\News::find($new->id);
                    @endphp
                <div class="post">
                    <a href="{{url('blog_list',$new->id)}}"><img src="storage/{{$new->image}}" alt="{{$newModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}" class="img-fluid" style="width: 922px; height: 450px;background: center center;"></a>
                    <div class="post_info clearfix">
                        <div class="post-left">
                            @php
                                $newDate = date('d/m/Y', strtotime($new->date));
                                $comment  = DB::table('comment_blog')->where(['blog_id'=>$new->id,'status'=>'true'])->count();

                                $TagIds = DB::table('news_tags')->where('news_id', $new->id)->pluck('tag_id');

                                $TagTitles = DB::table('tags')->whereIn('id', $TagIds)->get();
                            @endphp
                            <ul>
                                <li><i class="icon-calendar-empty"></i>{{$newDate}} <em>{{ __('msg.by') }} {{$new->person}}</em></li>
                                <li><i class="icon-inbox-alt"></i><a href="#">{{$new->category}}</a></li>
                                <li>
                                    <i class="icon-tags"></i>
                                    {{ __('msg.tags') }} /
                                    @foreach($TagTitles as $tag)
                                        @php
                                            $tagModel = \App\Models\Tag::find($tag->id);
                                        @endphp
                                    <a href="#">{{$tagModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a>,
                                    @endforeach
                                </li>
                            </ul>
                        </div>
                        <div class="post-right"><i class="icon-comment"></i><a href="#">{{$comment}} </a></div>
                    </div>
                    <h2>{{$newModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</h2>
                    <p>
                        {{$newModel->getTranslatedAttribute('description',$locale,'fallbackLocale')}}
                    </p>
                    <a href="{{url('blog_list',$new->id)}}" class="btn_1">{{ __('msg.more') }}</a>
                </div>
                @endforeach<!-- end post -->
                <div class="text-center clearfix mb-4">
{{--                    <ul class="pager">--}}
{{--                        <li class="previous"><a href="#"><span aria-hidden="true">&larr;</span> Older</a></li>--}}
{{--                        <li class="next"><a href="#">Newer <span aria-hidden="true">&rarr;</span></a></li>--}}
{{--                    </ul>--}}
                    <ul class="pager">
                        @if ($news->previousPageUrl())
                            <li class="previous"><a href="{{ $news->previousPageUrl() }}"><span aria-hidden="true">&larr;</span> {{ __('msg.older') }}</a></li>
                        @endif
                        @if ($news->nextPageUrl())
                            <li class="next"><a href="{{ $news->nextPageUrl() }}">{{ __('msg.newer') }} <span aria-hidden="true">&rarr;</span></a></li>
                        @endif
                    </ul>

                </div>
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
                        @foreach($posts as $post)
                            @php
                                $newDate = date('jS F, Y', strtotime($post->date));
                                $postModel = \App\Models\News::find($post->id);
                            @endphp
                        <li>
                            <i class="icon-calendar-empty"></i> {{$newDate}}
                            <div><a href="#">{{$postModel->getTranslatedAttribute('title',$locale,'fallbackLocale')}}</a></div>
                        </li>
                        @endforeach
                    </ul>
                </div><!-- End widget -->
                <hr>
                <div class="widget tags">
                    <h4>{{ __('msg.tags') }}</h4>
                    @foreach($tags as $tag)
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
