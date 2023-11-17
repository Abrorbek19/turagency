<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::group(['prefix'=>'/'],function(){
    Route::get('', function () {
        $rooms = \Illuminate\Support\Facades\DB::table('rooms')->limit(3)->get();
        $jihozlar = DB::table('jihozlar')->pluck( 'id');
        $price = \Illuminate\Support\Facades\DB::table('price')->get();
        $client_say = \Illuminate\Support\Facades\DB::table('client_say')->get();
        $locale = Session::get('locale','uz');
        return view('template.index',compact('rooms','price','locale','jihozlar','client_say'));
    });

    Route::get('about', function () {
        $image = DB::table('image')->where('category','Our Wonderfull Rooms')->get();
        $event = DB::table('event')->get();
        $room_items = DB::table('room_items')->get();
        $facility = DB::table('facility')->get();
        $locale = Session::get('locale','uz');
        return view('template.about',compact('image','event','locale','room_items','facility'));
    });

    Route::get('blog', function () {
        $category_news = DB::table('category_news')->get();
        $image = DB::table('image')->where('category','blog')->get();
        $tags = DB::table('tags')->get();
        $news = DB::table('news')->paginate(3);
        $posts = DB::table('news')->get();
        $locale = Session::get('locale','uz');
        return view('template.blog',compact('category_news','image','locale','tags','news','posts'));
    });

    Route::get('blog_list/{id}', function ($id) {

        $news = DB::table('news')->where('id',$id)->first();

        if (!$news) {
            abort(404); // Not found error
        }
        $image = DB::table('image')->where('category','blog')->get();
        $category_news = DB::table('category_news')->get();
        $recent = DB::table('news')->limit(5)->orderBy('id', 'DESC')->get();
        $tags = DB::table('tags')->get();
        $comment  = DB::table('comment_blog')->where(['blog_id'=>$id,'status'=>'true'])->count();
        $comments  = DB::table('comment_blog')->where(['blog_id'=>$id,'status'=>'true'])->get();
        $posts = DB::table('news')->where('id',$id)->get();
        $locale = Session::get('locale','uz');
        return view('template.blog_list',compact('category_news','locale','comments','comment','image','recent','tags','news','posts'));
    });

    Route::get('gallery', function () {
        $image = DB::table('image')->where('category','gallery')->get();
        $gallery = DB::table('gallery')->get();
        $locale = Session::get('locale','uz');
        return view('template.gallery',compact('gallery','locale','image'));
    });

    Route::get('faq', function () {
        $category = DB::table('faq_category')->get();
        $item = DB::table('faq_item')->get();
        $locale = Session::get('locale','uz');
        $image = DB::table('image')->where('category','Our Wonderfull Rooms')->get();
        return view('template.faq',compact('category','item','locale','image'));
    });

    Route::get('contact', function () {
        $information = DB::table('information')->get();
        $locale = Session::get('locale','uz');
        $image = DB::table('image')->where('category','Contact')->get();
        return view('template.contact',compact('image','locale','information'));
    });

    Route::resource("/contact_message", \App\Http\Controllers\ContactController::class);

    Route::resource("/comment_message", \App\Http\Controllers\CommentBlogController::class);


    Route::resource("/room_book", \App\Http\Controllers\RoomBookController::class);
    Route::resource("/news_email", \App\Http\Controllers\NewsEmailController::class);

    Route::get('lang/{locale}', function ($locale) {
        $langs = ['uz', 'en','ru'];
        if (in_array($locale, $langs)) {
            Session::put('locale', $locale);
            App::setLocale($locale);
        } else {
            Session::put('locale', "en");
            App::setLocale('en');
        }
        return redirect()->back();
    })->name('locale');

    Route::get('room_detail/{id}', function ($id) {
        $room = DB::table('rooms')->where('id',$id)->first();

        if (!$room) {
            abort(404); // Not found error
        }
        $rooms = DB::table('rooms')->where('id',$id)->get();
        $room_images = DB::table('room_images')->where('category',$id)->get();
        $jihozlar = \Illuminate\Support\Facades\DB::table('jihozlar')->get();
        $room_facility = DB::table('room_facility')->where('category',$id)->get();
        $room_items = DB::table('room_items')->get();
        $locale = Session::get('locale','uz');
        $policy  =DB::table('policy')->get();
        return view('template.room_detail',compact('room','locale','rooms','policy','jihozlar','room_images','room_facility','room_items'));
    });

    Route::get('room_list',function (){
        $facility = DB::table('general_facility')->get();
        $general = DB::table('general_item')->get();
        $rooms = \Illuminate\Support\Facades\DB::table('rooms')->paginate(5);
        $jihozlar = \Illuminate\Support\Facades\DB::table('jihozlar')->get();
        $price = \Illuminate\Support\Facades\DB::table('price')->get();
        $information = DB::table('information')->get();
        $locale = Session::get('locale','uz');
        $image = DB::table('image')->where('category','Our Wonderfull Rooms')->get();
        return view('template.room_list',compact('image','rooms','general','locale','information','jihozlar','price','facility'));
    });




});


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
