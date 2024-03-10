    <form wire:submit.prevent="submit" class="w-full max-w-sm">
        <input wire:model="inputValue" aria-label="Enter integer or Roman" type="text" placeholder="Enter integer or Roman" class="text-sm text-gray-base w-full mr-3 py-5 px-4 h-2 border  border-gray-200 rounded mb-2" />
        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Convert
        </button>
        @if($result !== null)
        <div>Conversion Result: <strong>{{ $result }}</strong></div>
        @endif
        @error('inputValue')

        <div class="p-4 mb-4 text-sm text-red-800 rounded-lg bg-red-50 dark:bg-gray-800 dark:text-red-400" role="alert">

            {{ $message }}
        </div>

        @enderror


    </form>