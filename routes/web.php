<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\SubsectionController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\InvController;

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

// MAIN

Route::get('/', function () {
	$page = app(PageController::class)->loadIndex();
	return view('main/index', compact("page"));
})->name('index');

Route::get('/error', function () {
	return view('main.error');
})->name('error');

Route::get('/subsection/{id_subsection}', function ($id_subsection) {
	try {
		$section = app(SectionController::class)->sectionBySubsection($id_subsection);
		$subsection = app(SubsectionController::class)->loadContent($id_subsection);
		return view('main/subsection', compact('subsection', 'section'));
	} catch (ModelNotFoundException $e) {
		return redirect()->route('error');
	}
})->name('subsection');

Route::get('/article/{id_article}', function ($id_article) {
	try {
		$section = app(ArticleController::class)->sectionByArticle($id_article);
		$subsection = app(ArticleController::class)->subsectionByArticle($id_article);
		$article = app(ArticleController::class)->loadContent($id_article);
		return view('main/article', compact('article', 'section', 'subsection'));
	} catch (ModelNotFoundException $e) {
		return redirect()->route('error');
	}
})->name('article');

Route::get('/inv/{id_inv}', function ($id_inv) {
	try {
		$section = app(InvController::class)->sectionByInv($id_inv);
		$subsection = app(InvController::class)->subsectionByInv($id_inv);
		$inv = app(InvController::class)->loadContent($id_inv);
		return view('main/inv', compact('inv', 'section', 'subsection'));
	} catch (ModelNotFoundException $e) {
		return redirect()->route('error');
	}
})->name('inv');

// LOGIN

Route::get('/admin/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/forgot', [AuthController::class, 'sendMail'])->name('mail');
Route::get('/admin/logout', [AuthController::class, 'logout'])->name('logout');

// ADMIN

Route::group(['middleware' => 'auth'], function () {
	Route::get('/admin', function () {
		return view('admin/index-admin');
	})->name('admin');

	Route::get('/admin/sections', function () {
		$sections = app(SectionController::class)->allSections();
		$msg = session()->pull('msg');
		$tab = session()->pull('tab', 1);
		$expand = session()->pull('expand');
		$new = session()->pull('new');
		$new_type = session()->pull('new_type', 'subsection');

		return view('admin/selector-section', compact('sections', 'tab', 'expand', 'new', 'new_type', 'msg'));
	})->name('selector-section');

	// OTHER
	Route::get('/admin/other', function () {
		$sections = app(SectionController::class)->allSections();
		$allSubsections = app(SubsectionController::class)->allSubsections();
		$subsections = app(SubsectionController::class)->allNullSubsections();
		$articles = app(ArticleController::class)->allNullArticles();
		$invs = app(InvController::class)->allNullInvs();

		$msg = session()->pull('msg');
		return view('admin/other', compact('sections', 'allSubsections', 'subsections', 'articles', 'invs', 'msg'));
	})->name('other');

	// ARTICLE
	Route::post('/post/admin/article/add/{id_belong}', [ArticleController::class, 'insert'])->name('post-article');
	Route::get('/admin/article/add/{id_belong}', [ArticleController::class, "addForm"])->name('add-article');
	Route::put('/put/admin/article/edit/{id_element}', [ArticleController::class, "update"])->name('put-article');
	Route::get('/admin/article/edit/{id_element}/{id_belong}', [ArticleController::class, "editForm"])->name('edit-article');
	Route::delete('/delete/admin/article/remove/{id_element}', [ArticleController::class, "delete"])->name('remove-article');

	// INV
	Route::post('/post/admin/inv/add/{id_belong}', [InvController::class, 'insert'])->name('post-inv');
	Route::get('/admin/inv/add/{id_belong}', [InvController::class, "addForm"])->name('add-inv');
	Route::put('/put/admin/inv/edit/{id_element}', [InvController::class, "update"])->name('put-inv');
	Route::get('/admin/inv/edit/{id_element}/{id_belong}', [InvController::class, "editForm"])->name('edit-inv');
	Route::delete('/delete/admin/inv/remove/{id_element}', [InvController::class, "delete"])->name('remove-inv');

	// SUBSECTION
	Route::post('/post/admin/subsection/add/{id_belong}', [SubsectionController::class, 'insert'])->name('post-subsection');
	Route::get('/admin/subsection/add/{id_belong}', [SubsectionController::class, "addForm"])->name('add-subsection');
	Route::put('/put/admin/subsection/edit/{id_element}', [SubsectionController::class, "update"])->name('put-subsection');
	Route::get('/admin/subsection/edit/{id_element}/{id_belong}', [SubsectionController::class, "editForm"])->name('edit-subsection');
	Route::delete('/delete/admin/subsection/remove/{id_element}', [SubsectionController::class, "delete"])->name('remove-subsection');

	// SECTION
	Route::post('/post/admin/section/add', [SectionController::class, 'insert'])->name('post-section');
	Route::get('/admin/section/add', [SectionController::class, "addForm"])->name('add-section');
	Route::put('/put/admin/section/edit/{id_element}', [SectionController::class, "update"])->name('put-section');
	Route::get('/admin/section/edit/{id_element}', [SectionController::class, "editForm"])->name('edit-section');
	Route::delete('/delete/admin/section/remove/{id_element}', [SectionController::class, "delete"])->name('remove-section');

	// INDEX
	Route::put('/put/admin/home/edit', [PageController::class, "update"])->name('put-index');
	Route::get('/admin/home/edit', [PageController::class, "editForm"])->name('edit-index');

	// PASSWORD
	Route::put('/put/admin/password', [AuthController::class, "update"])->name('put-password');
	Route::get('/admin/password', function () {
		return view('admin/form-password');
	})->name('password');
});