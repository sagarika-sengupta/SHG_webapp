<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\User; // Make sure to import User model
use App\Models\userKyc; // Make sure to import userKyc model
use Illuminate\Support\Facades\Log;



class kyc extends Component
{
    public $showModal = false;
    // Add all form fields!
    public $name;
    public $phone;
    public $aadhar_card;
    public $pan_card;
    public $kyc;

    protected $rules = [
            'name'   => 'required|string|min:3|max:50',
            'phone'  => 'required|string|min:10|unique:users_kyc,phone',
            'pan_card'    => 'required|string|min:10|max:12|unique:users_kyc,pan_card',
            'aadhar_card' => 'required|string|min:5|max:16|unique:users_kyc,aadhar_card',
    ];

    public function submitKYC()
    {
        Log::info('KYC submission started', [
        'user_id' => session('user_id'),
        'name' => $this->name,
        'phone' => $this->phone,
        'aadhar_card' => $this->aadhar_card,
        'pan_card' => $this->pan_card,
            ]);
        try{
                            $this->validate();
                            Log::info('Validation passed');

                            // Save KYC Data
                            //auth()->user()->update(['is_kyc_completed' => 1]);
                            $userId = session('user_id');
                            
                            if ($userId) {
                                // Update the authenticated user's KYC status
                                $user = User::where('user_id', $userId)->first();
                                Log::info('User fetched', ['user' => $user]);
                                // if ($user) {
                                //     $user->update(['is_kyc_completed' => 1]);
                                //     $user->update(['kyc_data' => $this->kyc_data]);
                                // }
                                if ($user) 
                                {
                                            // Create or update KYC record
                                        $kyc = userKyc::updateOrCreate(
                                                ['user_id' => $userId],
                                                [
                                                    'name'     => $this->name,
                                                    'phone'    => $this->phone,
                                                    'aadhar_card'   => $this->aadhar_card,
                                                    'pan_card'      => $this->pan_card,
                                                    'kyc_flag' => 1,
                                                ]
                                            );
                                            Log::info('KYC record updated/created', ['kyc' => $kyc]);

                                            // Mark user as KYC completed
                                            $user->update(['is_kyc_completed' => 1]);
                                            Log::info('User KYC status updated');
                                } 
                                else {
                                    Log::error('User not found for KYC submission', ['user_id' => $userId]);
                                    session()->flash('error', 'User not found for KYC submission');
                                    return;
                                }
                            } else {
                                Log::error('User ID not found in session');
                                session()->flash('error', 'User ID not found in session');
                                return;
                            }

                            // Hide modal after submission
                            $this->showModal = false;
                            session()->flash('message', 'KYC Completed Successfully!');
                            Log::info('KYC submission completed successfully');
                            

                            return redirect()->route('dashboard');
                        }
        catch(\Exception $e){
            Log::error('Error during KYC submission: ' . $e->getMessage(), [
            'trace' => $e->getTraceAsString()
        ]);
            session()->flash('error', 'Error: ' . $e->getMessage());
        }
    }
    /*public function mount()
    {
        // Check if the user is logged in
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // Check if KYC is already completed
        $user = Auth::user();
        if ($user->is_kyc_completed) {
            return redirect()->route('dashboard');
        }
    }*/
    public function render()
    {
        return view('livewire.kyc');
    }
    }
