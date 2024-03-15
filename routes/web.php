<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\SessionsController;
use App\Models\Category;
use App\Models\Post;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Validation\ValidationException;
use Spatie\YamlFrontMatter\YamlFrontMatter;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::post('newsletter',function (){
    request()->validate(['email'=>'required|email']);
    $mailchimp = new \MailchimpMarketing\ApiClient();

    $mailchimp->setConfig([
        'apiKey' => config('services.mailchimp.key'),
        'server' => 'us18'
    ]);
    try{
        $response = $mailchimp->lists->addListMember('81912ff90a',[
            'email_address'=>request('email'),
            'status'=>'subscribed',
        ]);
    }catch (\Exception $e){
        throw ValidationException::withMessages([
            'email'=>'this email could not be in our list'
        ]);
    }

    return redirect('/')->with('success','You are now in our newsletter!');
});

Route::get('/', [PostController::class,'index']);

Route::get('/posts/{post:slug}',[PostController::class,'show']);
Route::post('posts/{post:slug}/comments',[CommentController::class,'store']);

Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');


Route::get('login',[SessionsController::class,'create'])->middleware('guest');
Route::post('login',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout',[SessionsController::class,'destroy'])->middleware('auth');

//Route::get('/categories/{category:slug}',function (Category $category){
//    return view('posts',[
//        'posts'=> $category->posts,
//        'current_category'=>$category,
//        'categories'=>Category::all(),
//
//    ]);
//});

//Route::get('/authors/{author:username}',function (User $author){
//    return view('posts.index',[
//        'posts'=> $author->posts,
//    ]);
//});
