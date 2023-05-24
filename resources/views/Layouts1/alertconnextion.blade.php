<!-- signup Model -->
	<!-- Modal2 -->
	<div class="modal fade" id="myModal2" tabindex="-1" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="agileinfo_sign">Connexion sur DIMAZINA</h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body modal-body-sub_agile">
                <div class="main-mailposi">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
                <div class="modal_body_left modal_body_left1">

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <center>
                            <a href="" class="button6 btn-twitter"> <i class="fa fa-google"></i>&nbsp;Continuer Avec Google</a>
                            <a href="" class="button6"> <i class="fa fa-facebook-f"></i>&nbsp;Continuer Avec Facebook</a>
                        </center>
                        <br>

                        <div class="styled-input">
                             <input id="email" type="text" class="@error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="E-mail *" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                          
                        </div>
                        <div class="styled-input">
                             <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" placeholder="Mot de passe *" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                         <div class="styled-input">
                              <div class="form-check">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="form-check-label" for="remember">
                                        {{ __('Se souvenez de moi') }}
                                    </label>
                                </div>
                           
                        </div>
                        <center>
                           <button type="submit" class="btn btn-primary">
                                    {{ __('Se connecter ') }}
                                </button>
                        </center>
                    </form>
                    <center>
                        <p>
                            <button type="button" class="alertbut
                            
                            
                            "  data-dismiss="modal" aria-label="Close"> <a href="#"  data-toggle="modal" data-target="#myModal4">Mot de passe oublié ?</a></button>
                        </p>
                    </center>
                    <center>
                        <p>
                            <button type="button" class="alertbut"  data-dismiss="modal" aria-label="Close"> <a href="#"  data-toggle="modal" data-target="#myModal1">Si vous n'êtes pas encore inscrit , Inscrivez-vous ici </a></button>
                        </p>
                    </center>
                </div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
	<!-- //Modal2 -->
	<!-- //signup Model -->