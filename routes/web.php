<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Home;
use App\Livewire\About;
use App\Livewire\Login;
use App\Livewire\Register;
use App\Livewire\Contact;
use App\Livewire\Dashboard;
use App\Livewire\Accounts;
use App\Livewire\Settings;
use App\Livewire\Contribution;
use App\Livewire\Deposit;
use App\Livewire\Loan;
use App\Livewire\GroupDashboard;
use App\Livewire\GroupRegistration;
use App\Livewire\Notification;
use App\Models\Group;
use App\Http\Controllers\GroupTable;

//use App\Http\Controllers\GroupController;
//use App\Http\Controllers\GroupLoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\TransactionController;




Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/contribution', Contribution::class)->name('contribution');
Route::get('/deposit', Deposit::class)->name('deposit');
Route::get('/loan', Loan::class)->name('loan');
Route::get('/group-registration', GroupRegistration::class)->name('group-registration');
Route::get('/notification', Notification::class)->name('notification');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/account', Accounts::class)->name('account');
    Route::get('/settings', Settings::class)->name('settings');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('/save-transaction', [TransactionController::class, 'store']);
    Route::get('/group', [GroupTable::class, 'index']);
    Route::get('/group-dashboard', GroupDashboard::class)->name('GroupDashboard');
});