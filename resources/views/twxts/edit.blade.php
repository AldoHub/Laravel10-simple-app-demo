<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Edit Twxts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2>Edit Twxt with id {{$twxt->id}} </h2>    
                    
                    <form method='POST' action="{{ route('twxts.update', $twxt->id) }}">
                        @csrf @method('PUT')
                        <!-- will use the session value as default if its available -->
                        <textarea name='message' placeholder='Start Twxting...' class='block w-full'>{{old('message', $twxt->message)}}</textarea>
                        <x-primary-button class='block mt-4'>Edit</x-primary-button>
    
                        @error('message')
                            <x-input-error :messages="$errors->get('message')" />
                        @enderror
                    </form>




                </div>
            </div>
        </div>
    </div>

</x-app-layout>
