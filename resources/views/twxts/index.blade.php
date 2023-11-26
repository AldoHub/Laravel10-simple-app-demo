<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Twxts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">

                    <h2>Create a New Twxt </h2>    
                    
                    <form method='POST' action="{{ route('twxts.store') }}">
                        @csrf
                        <!-- will use the session value as default if its available -->
                        <textarea name='message' placeholder='Start Twxting...' class='block w-full'>{{old('message')}}</textarea>
                        <x-primary-button class='block mt-4'>Twxt</x-primary-button>
    
                        @error('message')
                            <x-input-error :messages="$errors->get('message')" />
                        @enderror
                    </form>




                </div>
            </div>
        </div>
    </div>


    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
           
        @dump($twxts) 
        @if (count($twxts) == 0)
                        <!-- return a message when the posts are empty -->
                        <p>There are no twxts to view at the moment, please add some first</p>

        @else
                        <!-- return all the posts, use foreach -->
                        @foreach($twxts as $twxt)
                            <!-- display the needed component -->
                           <div>
                           
                            <p>{{$twxt->message}} by <em>{{$twxt->user->name}}</em> at <em>{{$twxt->created_at->format('Y-m-d')}}</em></p>
                            

                            <!--  //---TODO: Replace with Access Policy -->
                            @if(auth()->user()->id === $twxt->user_id)
                                <a href="{{route('twxts.edit', $twxt->id)}}">Edit Twxt</a> 
                              
                                <form method='POST' action="{{route('twxts.destroy', $twxt->id)}}">
                                 @csrf @method('DELETE')
                                 <input type='submit' value='Submit' />    

                                </form>

                            @endif

                           </div>
                        @endforeach
                    
                    
                      
        @endif

        </div>
    </div>

</x-app-layout>
