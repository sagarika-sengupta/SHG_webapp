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
use App\Livewire\kyc;
use App\Models\Group;
use App\Http\Controllers\GroupTable;
use App\Livewire\TransactionHistory;
//use App\Http\Controllers\GroupController;
//use App\Http\Controllers\GroupLoginController;
use App\Http\Controllers\LogoutController;
use Illuminate\Auth\Events\Logout;
use App\Http\Controllers\TransactionController;
use App\Http\Middleware\viewMiddleware;
use App\Livewire\GroupMember;
use App\Livewire\MemberDisplay;
use App\Http\Controllers\GroupLogoutController;
use App\Livewire\GroupView;
use App\Livewire\UserGroupView;
use App\Livewire\GroupTransactions;
use App\Livewire\ApproveGroupTransactions;



Route::get('/', Home::class)->name('home');
Route::get('/about', About::class)->name('about');
Route::get('/register', Register::class)->name('register');
Route::get('/login', Login::class)->name('login');
Route::get('/contact', Contact::class)->name('contact');
Route::get('/contribution', Contribution::class)->name('contribution');
Route::get('/deposit', Deposit::class)->name('deposit');
Route::get('/loan', Loan::class)->name('loan');
Route::get('/group-registration', GroupRegistration::class)->name('group-registration');
//Route::get('/notification', Notification::class)->name('notification');
//Route::get('/kyc', kyc::class)->name('kyc');

//Route::middleware(userLogin::class)->group(function () {
    Route::get('/dashboard', Dashboard::class)->name('dashboard');
    Route::get('/account', Accounts::class)->name('account');
    Route::get('/settings', Settings::class)->name('settings');
    Route::post('/logout', [LogoutController::class, 'logout'])->name('logout');
    Route::post('/save-transaction', [TransactionController::class, 'store']);
    Route::get('/group', [GroupTable::class, 'index']);
    
    Route::get('/transaction-history', TransactionHistory::class)->name('transaction-history');
    Route::get('/notification', Notification::class)->name('notification');
    Route::get('/group-view',GroupView::class)->name('group-view');
    Route::get('/user-group-view',UserGroupView::class)->name('user-group-view');
    //});

Route::middleware(viewMiddleware::class)->group(function () {

    Route::post('/group_logout', [GroupLogoutController::class, 'group_logout'])//group_logout is the method in GroupLogoutController
    ->name('group_logout');
    
});

Route::get('/group-dashboard', GroupDashboard::class)->name('GroupDashboard');
Route::get('/group-member', GroupMember::class)->name('group-member');
Route::get('/member-display', MemberDisplay::class)->name('member-display');
Route::get('/group-transactions', GroupTransactions::class)->name('group-transactions');
Route::get('/approve-group-transactions',ApproveGroupTransactions::class)->name('approve-group-transactions');
Route::get("/test", function () {
    return view('livewire.test');
});