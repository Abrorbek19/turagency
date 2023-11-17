<!DOCTYPE html>
<html lang="{{$locale}}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="hotel, bed and breakfast, accommodations, travel, motel">
    <meta name="description" content="Albert - Hotel and Bed&amp;Breakfast">
    <meta name="author" content="Ansonika">
    <title>Albert - Hotel and Bed&amp;Breakfast</title>

    <!-- Favicons-->
    <link rel="shortcut icon" href="../assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="../assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="../assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="../assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="../assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="../assets/css/animate.min.css" rel="stylesheet">
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="../assets/css/menu.css" rel="stylesheet">
    <link href="../assets/css/style.css" rel="stylesheet">
    <link href="../assets/css/responsive.css" rel="stylesheet">
    <link href="../assets/css/fontello/css/icon_set_1.css" rel="stylesheet">
    <link href="../assets/css/fontello/css/icon_set_2.css" rel="stylesheet">
    <link href="../assets/css/fontello/css/fontello.css" rel="stylesheet">
    <link href="../assets/css/magnific-popup.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="../assets/css/date_time_picker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="../assets/css/owl.theme.default.css">

    <!-- CUSTOM CSS -->
    <!-- SPECIFIC CSS -->
    <link href="../assets/css/blog.css" rel="stylesheet">
    <link href="../assets/css/custom.css" rel="stylesheet">
</head>

<body>
<?php
use Carbon\Carbon;
?>
@php
    \Illuminate\Support\Facades\App::setLocale($locale)
@endphp

<div class="layer"></div>
<!-- Mobile menu overlay mask -->

<div id="preloader">
    <div data-loader="circle-side"></div>
</div><!-- End Preload -->

<!-- Header ================================================== -->
<header>
    <div class="container">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-2 col-md-5  col-3">
                <a href="index.html" id="logo">
                    <img src="../assets/img/logo.png" width="190" height="23" alt="" data-retina="true" class="logo_normal">
                    <img src="../assets/img/logo_sticky.png" width="190" height="23" alt="" data-retina="true" class="logo_sticky">
                </a>
            </div>
            <nav class="col-xxl-9 col-xl-9 col-lg-10 col-md-7 col-9 position-relative">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                {{--                    Header menu language --}}
                {{menu('language','menu/language')}}
                {{--                    End header menu language--}}
                <div class="main-menu">
                    <div id="header_menu">
                        <img src="../assets/img/logo_m.png" width="141" height="40" alt="" data-retina="true">
                    </div>
                    <a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
                    {{--                    Header menu admin --}}
                    {{menu('header','menu/header')}}
                    {{--                    End header menu admin--}}
                </div><!-- End main-menu -->
            </nav>
        </div><!-- End row -->
    </div><!-- End container -->
</header>
<!-- End Header =============================================== -->


@yield('content')




{{--footer--}}

@php
    $information = \Illuminate\Support\Facades\DB::table('information')->get();
@endphp

<footer>
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-12">
                <img src="../assets/img/logo_footer.png" width="141" height="40" alt="" id="logo_footer" data-retina="true">
                <ul id="contact_details_footer">
                    @foreach($information as $info)
                        @php
                            $infoModel = \App\Models\Information::find($info->id);
                        @endphp
                        <li>{{$infoModel->getTranslatedAttribute('address',$locale,'fallbackLocale')}}</li>
                        <li><a href="tel://{{$info->phone}}">{{$info->phone}}</a> / <a href="mailto:{{$info->email}}">{{$info->email}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg-2 col-md-3">
                <h3>{{ __('msg.about') }}</h3>
                {{--                    Header menu admin --}}
                {{menu('header','menu/footer_header')}}
                {{--                    End header menu admin--}}
            </div>
            <div class="col-lg-3 col-md-4">
                <h3>{{ __('msg.language') }}</h3>
                {{--                    Header menu admin --}}
                {{menu('language_footer','menu/footer_language')}}
                {{--                    End header menu admin--}}
            </div>
            <div class="col-lg-3 col-md-5" id="newsletter">
                <h3>{{ __('msg.newsletter') }}</h3>
                <p>{{ __('msg.news_desc') }}</p>
                <div id="message-newsletter_2"></div>
                <form method="post" action="{{'news_email'}}" id="newsletter_2">
                    @csrf
                    <div class="form-group">
                        <input name="email" id="email_newsletter_2"   type="email" value=""  placeholder="{{ __('msg.enter_email') }}" class="form-control">
                    </div>
                    @php

                        $date = Carbon::now()->toDateTimeString()
                    @endphp
                    <input type="hidden" name="created_at" id="news_created_at" value="{{$date}}">
                    <input type="submit" value="{{ __('msg.subscribe') }}" class="btn_1 white" id="submit-newsletter_2">
                </form>
            </div>
        </div><!-- End row -->
        <div class="row">
            <div class="col-md-12">
                <div id="social_footer">
                    <ul>
                        @foreach($information as $link)
                            <li><a href="{{$link->facebook_link}}"><i class="icon-facebook"></i></a></li>
                            <li><a href="{{$link->twitter_link}}"><i class="icon-twitter"></i></a></li>
                            <li><a href="{{$link->instagram_link}}"><i class="icon-instagram"></i></a></li>
                            <li><a href="{{$link->youtube_link}}"><i class="icon-youtube-play"></i></a></li>
                        @endforeach
                    </ul>
                    <p>© Albert 2023</p>
                </div>
            </div>
        </div><!-- End row -->
    </div><!-- End container -->
</footer>

{{--end footer--}}

<div id="toTop"></div><!-- Back to top button -->

<!-- COMMON SCRIPTS -->
<script src="../assets/js/jquery-3.7.0.min.js"></script>
<script src="../assets/js/common_scripts_min.js"></script>
<script src="../assets/phpmailer/validate.js"></script>
<script src="../assets/js/functions.js"></script>

<script>
    $('.carousel_in').owlCarousel({
        center: true,
        items:1,
        loop:true,
        autoplay:true,
        navText: [ '', '' ],
        addClassActive: true,
        margin:-1,
        responsive:{
            600:{
                items:1
            },
            1000:{
                items:2,
                nav:true,
            }
        }
    });
</script>

<script src="../assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('#sidebar').theiaStickySidebar({
        additionalMarginTop: 80
    });
</script>

{{--<script src="../assets/js/comment_blog.js"></script>--}}
<script src="../assets/js/room_book.js"></script>
<script src="../assets/js/news_email.js"></script>


<!-- SPECIFIC SCRIPTS -->
<script src="../assets/js/bootstrap-datepicker.js"></script>
<script src="../assets/js/bootsrap_datepicker_func.js"></script>
<script src="../assets/js/jquery.cookiebar.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        let token = "6106791463:AAHaT_-O8NSBLb6EB0GGa_bl647fhrfySPY";
        let userId = 1168146742
        nameInput = $('#name');
        emailInput = $('#email');
        commentInput = $('#comment');
        dateInput = $('#date');
        blogInput = $('#blog_id');
        // phone.inputmask({"mask": "+998-()-999-99-99"});

        $('#comment_blog').submit(function (e){
            e.preventDefault();
            // $.ajax({
            //     url:'https://api.telegram.org/bot'+token+'/sendMessage',
            //     method:'POST',
            //     data: {
            //         //   _token: '{{ csrf_token() }}',
            //         chat_id : userId ,
            //         text:
            //             "Name: " + nameInput.val() +
            //             "\n Phone: " + phoneInput.val() +
            //             "\n Etaj: " + etajInput.val()
            //     },
            //     success: function (data){
            //         // $('#form').remove()
            //         console.log('Your message has been sent to bot!');
            //         $('#submit').slideDown();
            //         location.reload()
            //     },
            //     error: function() {
            //         console.log("Message botga bormadi")
            //         // Botga xabar yuborishda xatolik yuz berdi
            //     }
            // });
            $.ajax({
                url: '/comment_message', // Saytga yuborishning URL yo'li
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': $('input[name="_token"]').val()
                },
                data: {
                    //   _token: name,
                    name: nameInput.val(),
                    email: emailInput.val(),
                    date: dateInput.val(),
                    blog_id: blogInput.val(),
                    comment:commentInput.val(),
                },
                success: function(data) {

                    // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                    console.log('Your message has been sent to admin')
                    // console.log(this.data)
                    $('#comment_btn').slideDown();
                    location.reload()
                },
                error: function() {
                    console.log("Message adminga bormadi")
                    // Saytga yuborilgan xabar qabul qilinmadi
                }
            });


        });
    });

</script>
<script>
    $(document).ready(function() {
        'use strict';
        $.cookieBar({
            fixed: true
        });
    });
</script>
</body>

</html>
