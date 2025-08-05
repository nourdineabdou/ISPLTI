<x-layouts.auth>

    <section class="row flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-lg-4 col-md-8 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 px-1 py-1 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <img width="100px" height="100px" src="{{asset('logo.jpeg')}}" alt="branding logo" class="brand-logo img-fluid">

                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>
                                Se connecter
                            </span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('login') }}" novalidate method="POST">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text"
                                           name="email"
                                           class="form-control @error('email') is-invalid @enderror" id="user-name"
                                           placeholder="Entrer l'adresse email" required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password"
                                           name="password"
                                           class="form-control @error('password') is-invalid @enderror"
                                           id="user-password"
                                           placeholder="Entrer le mot de passe" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                </fieldset>
                                <div class="form-group row">
                                    <div class="col-sm-6 col-12 text-center text-sm-left pr-0">
                                        <fieldset>
                                            <input type="checkbox" id="remember-me" class="chk-remember">
                                            <label for="remember-me">Remember Me</label>
                                        </fieldset>
                                    </div>
                                    <div class="col-sm-6 col-12 float-sm-left text-center text-sm-right">
                                        <a href="#" class="card-link">
                                            Mot de passe oublié?
                                        </a>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-outline-info btn-block"><i
                                        class="ft-unlock"></i> Se connecter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.auth>
