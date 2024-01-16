@extends('base.index')

@section('content')
    <div class="flex items-center justify-center w-screen h-screen bg-slate-100">
        <div class="w-1/4 py-3 bg-white border border-gray-200 rounded-lg shadow-md ">
            <div
                class="flex items-end w-full pt-1 pl-2 text-xl font-semibold leading-7 text-red-500 border-l-4 justify-items-end border-l-red-300 xl:text-2xl lg:text-base">
                Register
            </div>

            <div class="flex w-full pt-2 pl-2 text-xs font-thin">
                Please input here username and password with carefully
            </div>

            <div class="">
                <form action="{{ route('login.auth') }}" method="post" class="">
                    @csrf
                    <x-input label="Username" name="username" type="text" />
                    <x-input label="Password" name="password" type="password" />
                    <x-input label="Re-Confirm Password" name="password" type="password" />
                    <div class="w-full mt-3 -mb-1 font-thin text-center">
                        <p class="text-red-500">
                            Password doesn't match !
                        </p>
                    </div>
                    <div class="w-full text-center ">
                        <button class="inline px-4 py-1 mt-4 text-base text-white bg-red-400 rounded-md" type="submit">
                            Register
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
