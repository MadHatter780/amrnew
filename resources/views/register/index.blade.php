@extends('base.index')

@section('content')
    <div class="flex items-center justify-center w-screen h-screen bg-[#3e3c40]">
        <div class="w-full py-3 mx-4 bg-[#2b292e] border border-gray-200 rounded-lg shadow-md md:w-1/4 md:mx-0">
            <div
                class="flex items-end w-full pt-1 pl-2 text-xl font-semibold leading-7 text-orange-500 border-l-4 xl:pt-1 lg:pt-0 justify-items-end border-l-orange-300 xl:text-2xl lg:text-lg">
                Register
            </div>

            <div class="text-white flex w-full pt-2 pl-2 text-xs font-thin xl:text-xs lg:text-[0.7rem]">
                Please input here username and password with carefully
            </div>

            <div>
                <div id="form" class="transition-transform ease-in-out transform">
                    <form action="{{ route('register.register') }}" method="post">
                        @csrf
                        <x-input label="Username" name="username" type="text" />
                        <x-input label="Email" name="email" type="email" />
                        <x-input label="Password" name="password" type="password" />
                        <x-input label="Re-Confirm" name="reconfirm" type="password" />
                        <div class="w-full mt-3 -mb-1 xl:-mb-1 lg:-mb-0.5 font-thin text-center">
                            <p id="alert_confirm" class="hidden text-base text-orange-500 lg:text-xs xl:text-base">
                                Password doesn't match!
                            </p>
                        </div>
                        <div class="w-full mt-3 -mb-1 xl:-mb-1 lg:-mb-0.5 font-thin text-center">
                            <p id="pass_wrong" class="hidden text-sm text-orange-500 lg:text-xs xl:text-sm">
                                Password must have uppercase, lowercase, and number, and minimum length is 8 or higher
                            </p>
                        </div>
                        <div class="w-full mt-3 -mb-1 xl:-mb-1 lg:-mb-0.5 font-thin text-center">
                            <p id="" class="text-sm text-orange-500 lg:text-xs xl:text-sm">
                                {{ $errors }}

                            </p>
                        </div>

                        <div class="w-full text-center">
                            <button type="submit"
                                class="inline px-4 py-1 mt-4 text-base text-white bg-orange-400 rounded-md lg:text-sm xl:text-base"
                                type="button">
                                Register
                            </button>
                        </div>
                    </form>

                </div>




            </div>
        </div>
    </div>
@endsection

@push('script')
    <script>
        const form = document.getElementById('form');
        const lol = document.getElementById('lol');

        function nextForm() {
            // Mengatur transform dan kelas Tailwind
            form.classList.add('translate-x-full');
            lol.classList.remove('hidden');
        }

        function prevForm() {
            const form = document.getElementById('form');
            const lol = document.getElementById('lol');

            // Mengatur transform dan kelas Tailwind
            form.classList.remove('translate-x-full');
            lol.classList.add('hidden');
        }

        const pass = document.getElementById("password");
        const reconfirm = document.getElementById("reconfirm");
        const pass_wrong = document.getElementById("pass_wrong");
        const alert_confirm = document.getElementById("alert_confirm");

        pass.onkeyup = function() {
            // Validate lowercase letters
            let lowerCaseLetters = /[a-z]/g;
            let upperCaseLetters = /[A-Z]/g;
            let numbers = /[0-9]/g;

            alert_confirm.classList.add("hidden");

            if (
                pass.value.match(lowerCaseLetters) &&
                pass.value.match(upperCaseLetters) &&
                pass.value.match(numbers) &&
                pass.value.length >= 8
            ) {
                pass_wrong.classList.add("hidden");
            } else {
                pass_wrong.classList.remove("hidden");
            }
        };

        const register = () => {
            if (pass.value == reconfirm.value) {
                console.log("kembar");
            } else {
                alert_confirm.classList.remove("hidden");
                console.log("lol");
            }
        };
    </script>
@endpush
