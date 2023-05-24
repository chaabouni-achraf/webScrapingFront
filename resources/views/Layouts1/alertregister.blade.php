	<!-- signin Model -->
<!-- Modal1 -->
<div class="modal fade" id="myModal1" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="agileinfo_sign">Inscription sur DIMAZINA </h3>
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body modal-body-sub_agile">
                <div class="main-mailposi">
                    <span class="fa fa-envelope-o" aria-hidden="true"></span>
                </div>
                <div class="modal_body_left modal_body_left1">


                   <form method="POST" action="{{ route('register') }}">
                        @csrf


                        <div class="styled-input agile-styled-input-top">
                              <input id="name" type="text" class=" @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Votre nom *" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>


                        <!--<div class="styled-input agile-styled-input-top">
                              <input id="photo" type="file" class=" @error('photo') is-invalid @enderror" name="photo" value="{{ old('photo') }}"  required autocomplete="photo" autofocus>

                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>-->
                        
                        <div class="styled-input">
                            <input type="text" placeholder="Télephone *" lass=" @error('phone') is-invalid @enderror" name="phone" required="">
                            @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                        <div class="styled-input">
                             <input id="email" type="email" class=" @error('email') is-invalid @enderror" placeholder="E-mail *" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                       
                     
                        <div class="styled-input">
                             <input id="password" type="password" class=" @error('password') is-invalid @enderror"  placeholder="Mot de passe * " name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                        </div>
                        <div class="styled-input">
                            <input id="password-confirm" type="password"  name="password_confirmation" required autocomplete="new-password" placeholder="Confirmer mot de passe *">
                           
                        </div>
                        <center>
                            <button type="submit" class="btn btn-primary">
                                    {{ __('Register') }}
                                </button>
                        </center>
                    </form>
                    <div class="clearfix"></div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
        <!-- //Modal content-->
    </div>
</div>
<!-- //Modal1 -->
<!-- //signin Model -->