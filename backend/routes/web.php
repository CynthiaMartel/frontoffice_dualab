<?php

use App\Http\Controllers\Web\VisibilidadController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Buscadores e IA: dualab.es/robots.txt, /llms.txt y /sitemap.xml (ver VisibilidadController)
Route::middleware('throttle:60,1,web-visibilidad')->withoutMiddleware([
    \Illuminate\Session\Middleware\StartSession::class,
    \Illuminate\View\Middleware\ShareErrorsFromSession::class,
    \Illuminate\Foundation\Http\Middleware\PreventRequestForgery::class,
    \Illuminate\Cookie\Middleware\EncryptCookies::class,
    \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
])->group(function () {
    Route::get('robots.txt',  [VisibilidadController::class, 'robots'])->name('visibilidad.robots');
    Route::get('llms.txt',    [VisibilidadController::class, 'llms'])->name('visibilidad.llms');
    Route::get('sitemap.xml', [VisibilidadController::class, 'sitemap'])->name('visibilidad.sitemap');
});
