<div>
    <!-- Modal Toggle -->
    <button wire:click="$set('showModal', true)" class="btn btn-primary">Complete KYC</button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-semibold mb-4">KYC Form</h2>

                <!-- KYC Form -->
                <input type="text" wire:model="kyc_data" placeholder="Enter KYC details"
                    class="w-full border p-2 mb-3" />
                @error('kyc_data') <span class="text-red-500">{{ $message }}</span> @enderror

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <button wire:click="$set('showModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button wire:click="submitKYC" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </div>
        </div>
    @endif
</div>
