<div> 
    <div class="container mt-5">
        <h2 class="text-center text-primary">Select Payment Amount</h2>
        
        <!-- Group Selection -->
        <div class="d-flex justify-content-center mt-4">
            <select class="form-select w-50" wire:model.live="group_id">
                <option value="" disabled>Select Group</option>
                @foreach($groups as $group)
                    <option value="{{ $group['group_id'] }}">
                        {{ $group['group_name'] }} - {{ $group['village'] }}, {{ $group['district'] }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Amount Input -->
        <div class="d-flex justify-content-center mt-4">
            <div class="w-50">
                <label for="manual_amount" class="form-label">Enter Amount</label>
                <input type="number" 
                       id="manual_amount" 
                       wire:model.live="manual_amount" 
                       class="form-control" 
                       placeholder="Enter amount"
                       min="1"
                       step="0.01">
            </div>
        </div>

        <!-- Transaction Type Selection -->
        <div class="d-flex justify-content-center mt-4">
            <select class="form-select w-50" id="transaction_type" wire:model="transaction_type">
                <option value="" disabled>Deposit Type</option>
                <option value="RD">Recurring Deposit</option>
                <option value="FD">Fixed Deposit</option>
                <option value="Others">Others</option>
            </select>
        </div>

        <!-- Warning Message -->
        @if (session()->has('payment-warning') && $showWarning)
            <div class="alert alert-warning mt-4 text-center">
                <p class="mb-3">{{ session('payment-warning') }}</p>
                <div>
                    <button class="btn btn-warning me-2" wire:click="confirmMismatch">
                        Proceed Anyway
                    </button>
                    <button class="btn btn-secondary" wire:click="$set('showWarning', false)">
                        Cancel
                    </button>
                </div>
            </div>
        @endif

        <!-- Pay Button -->
        <div class="text-center mt-4">
            <button class="btn btn-success px-5" 
                    wire:click="makePayment"
                    wire:loading.attr="disabled"
                    wire:target="makePayment">
                <span wire:loading.remove wire:target="makePayment">Pay Now</span>
                <span wire:loading wire:target="makePayment">Processing...</span>
            </button>
        </div>

        <!-- Success Message -->
        @if (session()->has('payment-success'))
            <div class="alert alert-success mt-4 text-center">
                {{ session('payment-success') }}
            </div>
        @endif

        <!-- Error Message -->
        @if (session()->has('payment-error'))
            <div class="alert alert-danger mt-4 text-center">
                {{ session('payment-error') }}
            </div>
        @endif

        <!-- Invalid Amount Message -->
        @if (session()->has('payment-invalid_amount'))
            <div class="alert alert-warning mt-4 text-center">
                {{ session('payment-invalid_amount') }}
            </div>
        @endif
    </div>

    <!-- Loading Indicator -->
    <div wire:loading wire:target="makePayment" class="text-center mt-3">
        <div class="spinner-border text-primary" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>
</div>
