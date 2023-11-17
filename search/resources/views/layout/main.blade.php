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
    <link rel="shortcut icon" href="assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- GOOGLE WEB FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <!-- BASE CSS -->
    <link href="assets/css/animate.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/menu.css" rel="stylesheet">
    <link href="assets/css/style.css" rel="stylesheet">
    <link href="assets/css/responsive.css" rel="stylesheet">
    <link href="assets/css/fontello/css/icon_set_1.css" rel="stylesheet">
    <link href="assets/css/fontello/css/icon_set_2.css" rel="stylesheet">
    <link href="assets/css/fontello/css/fontello.css" rel="stylesheet">
    <link href="assets/css/magnific-popup.css" rel="stylesheet">

    <!-- SPECIFIC CSS -->
    <link href="assets/css/date_time_picker.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="assets/css/owl.theme.default.css">

    <!-- SPECIFIC CSS -->
    <link href="assets/css/blog.css" rel="stylesheet">
    <!-- CUSTOM CSS -->
    <link href="assets/css/custom.css" rel="stylesheet">
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
                    <img src="assets/img/logo.png" width="190" height="23" alt="" data-retina="true" class="logo_normal">
                    <img src="assets/img/logo_sticky.png" width="190" height="23" alt="" data-retina="true" class="logo_sticky">
                </a>
            </div>
            <nav class="col-xxl-9 col-xl-9 col-lg-10 col-md-7 col-9 position-relative">
                <a class="cmn-toggle-switch cmn-toggle-switch__htx open_close" href="javascript:void(0);"><span>Menu mobile</span></a>
                {{--                    Header menu language --}}
                    {{menu('language','menu/language')}}
                {{--                    End header menu language--}}

                <div class="main-menu">
                    <div id="header_menu">
                        <img src="assets/img/logo_m.png" width="141" height="40" alt="" data-retina="true">
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
                <img src="assets/img/logo_footer.png" width="141" height="40" alt="" id="logo_footer" data-retina="true">
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
<script src="assets/js/jquery-3.7.0.min.js"></script>
<script src="assets/js/common_scripts_min.js"></script>
<script src="assets/phpmailer/validate.js"></script>
<script src="assets/js/functions.js"></script>
<script src="assets/js/room_book.js"></script>
<script src="assets/js/news_email.js"></script>

<script src="assets/js/theia-sticky-sidebar.js"></script>
<script>
    jQuery('.sidebar').theiaStickySidebar({
        additionalMarginTop: 80
    });
</script>

<!-- SPECIFIC SCRIPTS -->
<script src="assets/js/bootstrap-datepicker.js"></script>
<script src="assets/js/bootsrap_datepicker_func.js"></script>
<script src="assets/js/jquery.cookiebar.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        var firstNumber = Math.floor(Math.random() * 100) + 1;
        var secondNumber = Math.floor(Math.random() * 100) + 1;
        var operation = Math.floor(Math.random() * 2); // 0 - addition, 1 - subtraction, 2 - multiplication

        var answer;
        var operationText;

        if (operation === 0) {
            answer = firstNumber + secondNumber;
            operationText = "+";
        } else if (operation === 1) {
            answer = firstNumber - secondNumber;
            operationText = "-";
        }

        document.getElementById("verify_contact").placeholder = "{{ __('msg.are_you') }} " + firstNumber + " " + operationText + " " + secondNumber + " =";
        document.getElementById("answer_contact").value = answer;

        var submitButton = document.getElementById("submit-contact");
        var resultMessage = document.getElementById("result");

        submitButton.addEventListener("click", function(event) {
            event.preventDefault();

            var userAnswer = parseInt(document.getElementById("verify_contact").value);
            var correctAnswer = parseInt(document.getElementById("answer_contact").value);
            var firstInput = $('#first_name');
            var lastInput = $('#last_name');
            var emailInput = $('#email');
            var phoneInput = $('#phone');
            var messageInput = $('#message');
            var verifyInput = $('#verify_contact');
            var createdInput = $('#created_at');

            if (userAnswer === correctAnswer) {
                resultMessage.innerText = "Verification successful! Sending message...";
                resultMessage.style.color = "green"; // Change text color to green for successful verification

                // Send data to the server using AJAX
                $.ajax({
                    url: '/contact_message',
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': $('input[name="_token"]').val()
                    },
                    data: {
                        first_name: firstInput.val(),
                        last_name: lastInput.val(),
                        phone: phoneInput.val(),
                        email: emailInput.val(),
                        verification: verifyInput.val(),
                        message: messageInput.val(),
                        created_at: createdInput.val(),
                    },
                    success: function(data) {
                        // Saytga yuborilgan xabarning muvaffaqiyatli qabul qilindi
                        console.log('Your message has been sent to admin');
                        resultMessage.innerText = "Your message has been sent to admin";
                        resultMessage.style.color = "green";
                        $('#submit-contact').slideDown();
                        location.reload();
                    },
                    error: function() {
                        console.log("Message could not be sent to admin");
                        resultMessage.innerText = "Message could not be sent. Please try again later.";
                        resultMessage.style.color = "red";
                    }
                });
            } else {
                resultMessage.innerText = "Verification failed. Please try again.";
                resultMessage.style.color = "red";
            }
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

<script src="assets/js/isotope.min.js"></script>
<script>
    $(window).on('load', function() {
        var $container = $('.isotope-wrapper');
        $container.isotope({ itemSelector: '.item', layoutMode: 'masonry' });
    });
</script>

</body>

</html>
