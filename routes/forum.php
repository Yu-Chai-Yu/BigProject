<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CarpoolController;
use App\Http\Controllers\MemberController;
use App\Http\Controllers\SendJoinNoticeMailController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FeelController;
use App\Http\Controllers\ForumController;
use App\Http\Controllers\IndexController;


// 論壇
Route::get('/forumIndex',[ForumController::class,'forumIndex'])->name('foindex');

Route::get('/forumDetail/{sfid}/{foid}', [ForumController::class,'forumDetail'])->name('fodetail');

Route::get('/forumMessage', [ForumController::class,'getuserpic'])->name('fomes');

Route::post('/forumCom/{sfid}/{foid}',[ForumController::class,'forumCom'])->name('forumcom');

Route::post('/forumMes/{uid}', [ForumController::class,'forumMes'])->name('forummes');

Route::get('/forumSaved/{sfid}/{ftid}', [ForumController::class,'forumSaved'])->name('fosave');

Route::get('/forumUnsaved/{sfid}/{ftid}',[ForumController::class,'forumUnsaved'])->name('founsave');
