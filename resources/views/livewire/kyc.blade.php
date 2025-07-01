<div>
    <!-- Modal Toggle -->
    <button wire:click="$set('showModal', true)" class="btn btn-primary">Complete KYC</button>

    <!-- Modal -->
    @if ($showModal)
        <div class="fixed inset-0 flex items-center justify-center bg-gray-800 bg-opacity-50">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-semibold mb-4">KYC Form</h2>

                <!-- KYC Form -->
                <div class="mb-3">
                    <input type="text" wire:model="name" placeholder="Full Name" class="w-full border p-2" />
                    @error('name') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <input type="text" wire:model="phone" placeholder="Phone Number" class="w-full border p-2" />
                    @error('phone') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <input type="text" wire:model="aadhar_card" placeholder="Aadhaar Number" class="w-full border p-2" />
                    @error('aadhaar_card') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <input type="text" wire:model="pan_card" placeholder="PAN Number" class="w-full border p-2" />
                    @error('pan_card') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2 mt-4">
                    <button wire:click="$set('showModal', false)" class="bg-gray-500 text-white px-4 py-2 rounded">Cancel</button>
                    <button wire:click="submitKYC" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                </div>
            </div>
        </div>
    @endif
</div>
