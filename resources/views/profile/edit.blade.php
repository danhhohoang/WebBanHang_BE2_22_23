<x-app-layout>
    <section class="vh-100" style="background-color: #f4f5f7;">
        <div class=" py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center">
                <div class="col col-lg-6 mb-4 mb-lg-0">
                    <div class="card mb-3" style="border-radius: .5rem;">
                        <div class="row g-0">
                            <div class="col-md-4 gradient-custom text-center text-white"
                                style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                                <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-chat/ava1-bg.webp"
                                    alt="Avatar" class="img-fluid my-5" style="width: 80px;" />
                                <h5>{{ Auth::user()->name }}</h5>
                                <a href="{{ route('profile.edit') }}"><i class="far fa-edit mb-5"></i></a>
                            </div>
                            <div class="col-md-8">
                                <div class="card-body p-4">
                                    <h6>Information</h6>
                                    <hr class="mt-0 mb-4">
                                    <div class="row pt-1">
                                        <div class="col">
                                            <h6>Name</h6>
                                            <p class="text-muted">{{ Auth::user()->name }}</p>
                                        </div>
                                        <div class="col">
                                            <h6>Email</h6>
                                            <p class="text-muted">{{ Auth::user()->email }}</p>
                                        </div>
                                    </div>
                                    <div class="py-12">
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-profile-information-form')
                                        </div>
                                        <div class="max-w-xl">
                                            @include('profile.partials.update-password-form')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</x-app-layout>
