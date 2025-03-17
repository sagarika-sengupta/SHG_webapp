<div> 
    <div class="container mt-5">
        <h2 class="text-center text-primary">Select Payment Amount</h2>
        <div class="d-flex justify-content-center mt-4">
            <select class="form-select w-50" wire:model="amount">
                <option selected disabled>Select an Amount</option>
               <!-- <option value="100">Rs. 100</option> -->
                <option value="200">Rs. 200</option>
                <option value="500">Rs. 500</option>
                <option value="1000">Rs. 1000</option>
            </select>
        </div>
        <div class="text-center mt-4">
            <button class="btn btn-success px-5" wire:click="makePayment">Pay Now</button>
        </div>
    </div>
    @if (session()->has('payment-success'))
            <div class="alert alert-success mt-4">
                {{ session('payment-success') }}
            </div>
        @endif

        @if (session()->has('payment-error'))
            <div class="alert alert-danger mt-4">
                {{ session('payment-error') }}
            </div>
        @endif
        <!--payment-invalid_amount', "Invalid amount! You can only contribute ₹$registeredAmount.-->
        @if (session()->has('payment-invalid_amount'))
            <div class="alert alert-success mt-4">
                {{ session('payment-invalid_amount') }}
            </div>
        @endif
    </div>

    <!-- Livewire event handlers for alerts -->
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            @if (session()->has('payment-success'))
                alert('{{ session('payment-success') }}');
            @endif

            @if (session()->has('payment-error'))
                alert('{{ session('payment-error') }}');
            @endif
            @if (session()->has('payment-invalid_amount'))
                alert('{{ session('payment-invalid_amount') }}');
            @endif
        });
    </script>
    <!-- Livewire event handlers for alerts -->
   <!-- <script>
        //window.addEventListener('payment-success', event => {
          //  alert(event.detail.message);
        //});

        //window.addEventListener('payment-error', event => {
          //  alert(event.detail.message);
        //});
    </script> -->
</div>
