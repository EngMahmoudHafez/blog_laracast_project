<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\AdminPostController;
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
Route::post('newsletter',NewsletterController::class);
Route::post('posts/{post:slug}/comments',[CommentController::class,'store']);

Route::get('register',[RegisterController::class,'create'])->middleware('guest');
Route::post('register',[RegisterController::class,'store'])->middleware('guest');


Route::get('login',[SessionsController::class,'create'])->middleware('guest');
Route::post('login',[SessionsController::class,'store'])->middleware('guest');
Route::post('logout',[SessionsController::class,'destroy'])->middleware('auth');



Route::get('/', [PostController::class,'index']);
Route::get('/posts/{post:slug}',[PostController::class,'show']);

Route::middleware('can:admin')->group(function (){
//    Route::resource('admin/posts', AdminPostController::class)->except('show');
    Route::get('admin/posts/create',[AdminPostController::class,'create']);
    Route::post('admin/posts',[AdminPostController::class,'store']);
    Route::get('admin/posts',[AdminPostController::class,'index']);
    Route::get('admin/posts/{post:id}/edit',[AdminPostController::class,'edit']);
    Route::patch('admin/posts/{post:id}',[AdminPostController::class,'update']);
    Route::get('admin/posts/{post:id}/delete',[AdminPostController::class,'destroy']);

});

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
