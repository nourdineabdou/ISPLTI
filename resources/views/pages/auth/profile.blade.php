<x-layouts.main
    :title="__('My Profile')"
>
    <section>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title text-center">
                            {{ __('Profile') }}
                        </h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group
                                        @error('name') has-error @enderror">
                                        <label for="name">Name</label>
                                        <input type="text" id="name" class="form-control" name="name"
                                               value="{{ auth()->user()->name }}" disabled>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group
                                        @error('email') has-error @enderror">
                                        <label for="email">Email</label>
                                        <input type="email" id="email" class="form-control" name="email"
                                               value="{{ auth()->user()->email }}" disabled>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group
                                        @error('password') has-error @enderror">
                                        <label for="password">Password</label>
                                        <input type="password" id="password" class="form-control" name="password"
                                               value="********" disabled>
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.main>
