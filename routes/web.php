<?php

use App\Http\Controllers\NotesController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    $name = "Afooboy";
    $school = "SQI";
    $username = "afolabi_ademola";
    // "With" Method
    // return view('home')->with('name', $name)->with('school', $school);

    // "Compact" Method
    // return view('home', compact('name', 'school', 'username'));

    // Direct Method
    return view('home', [
        'name' => $name,
        'school' => $school,
        'username' => $username
    ]);
});

Route::post('/register', [UserController::class, 'createUser']);

Route::get('/login', function(){
    return view('login');
});

Route::post('/login', [UserController::class, 'authUser']);

Route::get('/dashboard', [UserController::class, 'dashboard']);

Route::post('/deleteuser', [UserController::class, 'deleteUser']);

Route::get('/dashboard/{id}', [UserController::class, 'editUser']);
Route::put('/dashboard/{id}', [UserController::class, 'updateUser']);

Route::post('/dashboard', [NotesController::class, 'createNote']);

Route::post('/dashboard/editnote/{noteId}', [NotesController::class, 'editNote']);
Route::put('/dashboard/editnote/{noteId}', [NotesController::class, 'editNote']);

Route::post('/dashboard/deletenote/{noteId}', [NotesController::class, 'deleteNote']);

Route::get('/logout', [UserController::class, 'logOut']);

Route::get('/forgot', function(){
    return view('forgot');
});

Route::post('/forgot', [UserController::class, 'forgotPassword']);

Route::get('/resetpassword', action: function(){
    return view('resetpassword');
});

Route::post('/resetpassword', [UserController::class, 'resetPassword'])->name('resetpassword');

Route::get('/admin', [UserController::class, 'allusers']);

Route::get('/allnotes', [UserController::class, 'allnotes']);

Route::get('/user/{id}', [UserController::class, 'usernotes']);


Route::get('/dashboard/updatepfp/{id}', function($id){
    return view('pfp', compact('id'));
});

Route::post('/dashboard/updatepfp/{id}', [UserController::class, 'updatepfp']);

Route::get('/dashboard/ecommerce/{id}', action: function($id){
    $user = User::find($id);
    return view('ecommerce', compact('user'));
});

Route::post('/dashboard/ecommerce/{id}', [ProductsController::class, 'createProduct']);
// Route::post('/register', function(Request $req){
//     echo $req->full_name;
//     // echo $_POST['full_name'];
//     return "Details received, will be processed soon";
// });
