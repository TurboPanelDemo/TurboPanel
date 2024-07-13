<div class="flex flex-col justify-center items-center h-screen text-center">

    <div class="flex flex-col justify-center items-center text-center">
        <img src="{{asset('images/turbo-logo.svg')}}" class="h-12 mb-4" alt="TurboPanel Logo">
      {{--  <span class="text-[0.9rem] font-medium text-gray-950 dark:text-white">
            Welcome to the TurboPanel installer. Please fill out the form below to get started.
        </span>--}}
    </div>

    <div class="text-left w-[50rem] mt-8">
        {{$this->form}}
    </div>

</div>
