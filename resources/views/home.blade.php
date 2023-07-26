<x-panel.layout.oauth :pageinfo="$pageinfo">
    <div class="col-12">
        <div class="row justify-content-center no-gutters">
            <div class="col-8">
                <div class="bg-white rounded30 shadow-lg">
                    <div class="content-top-agile p-20">
                        <img src="{{ url('img/avatar-13.png') }}" alt="User Image" class="rounded-circle">
                        {{-- <h3 class="mb-0">توسعه دهنده گرامی</h3> --}}
                        @if (Auth::check())
                            <h3 class="mb-0">{{ Auth::user()->fullname }}</h3>
                        @endif
                    </div>
                    <div class="p-20">
                        <div class="text-center">
                            <label>                                Access Token :
                            </label>
                            <p class="mb-4">
                                <textarea class="p-10" rows="15" cols="100" id="copycode">{{ Auth::user()->accesstoken }}</textarea>
                            </p>
                            <p>                                به زودی دسترسی API کل محصولات با متد Restful  برای راه اندازی اپلیکیشن ها وپلت فرم های مجزا فراهم خواهد آمد.
                            </p>
                            <p class="mb-6">
                                از اینکه ما را دنبال می کنید خرسندیم. </p>
                        </div>
                        @auth
                            <div class="text-center">
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                    <button type="submit" class="btn btn-danger mt-10">خروج</button>
                                </form>
                            </div>
                        @endauth
                    </div>
                </div>

            </div>
        </div>
    </div>

    <x-slot:script>

        </x-slot>

</x-panel.layout.oauth>
