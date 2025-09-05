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
                                Inscrivez-vous
                            </span>
                        </h6>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal" action="{{ route('inscriptions.login_bachelier') }}"  method="POST">
                                @csrf
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="text"
                                           name="bac"
                                           class="form-control @error('bac') is-invalid @enderror" id="user-bac"
                                           placeholder="Entrer votre N° BAC" required>
                                    <div class="form-control-position">
                                        <i class="la la-user"></i>
                                    </div>
                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="nii"
                                           name="nii"
                                           class="form-control @error('nii') is-invalid @enderror"
                                           id="user-nii"
                                           placeholder="Entrer le N° NII" required>
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                </fieldset>
                                {{--
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
                                --}}
                                <button type="submit" class="btn btn-outline-info btn-block"><i
                                        class="ft-unlock"></i> Se connecter
                                </button>
                                {{-- retour à l'accueil --}}
                                <div class="form-group row">
                                    <div class="col-sm-12 col-12 text-center">
                                        <a href="{{ url('/') }}" class="card-link">
                                            Retour à l'accueil
                                        </a>
                                    </div>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-layouts.auth>
