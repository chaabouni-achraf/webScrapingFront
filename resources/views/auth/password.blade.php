<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
                 @isset($url)
                  
                      @if($url=='fournisseur')
                       <title>Créer un site web catalogue en 2 minutes</title>
                       @endif
                        @if($url=='createur')
                       <title>DIMAZINA</title>
                       @endif
                        
                       @endisset
    

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/util.css')}}">
    <link href="{{asset('css/profil.css')}}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{asset('css/card.css')}}" rel="stylesheet" type="text/css" media="all" />
  <link href="{{asset('css/card1.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/bootstrap.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/style.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet">
  <link href="{{asset('css/form.css')}}" rel="stylesheet" type="text/css" media="all" />
    <link rel="icon" type="image/png" href="{{asset('images/iconedimazina.png')}}">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Google Tag Manager -->
<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
})(window,document,'script','dataLayer','GTM-MC5VGPG');</script>
<!-- End Google Tag Manager -->

</head>
<body>
  <!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-MC5VGPG"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <div id="app">
        <div class="container">
        <div class="row">
            <div class="col-md-8">
                <a href="{{route('homepage')}}">
                    
                    <img src="{{asset('images/logodimazinaweb.png')}}" style="width: 100%;">
                </a>
            </div>
            <div class="col-md-4">
                <center>
                  <a class="button2" href="{{route('homepage')}}">Retour au site - الصفحة الرئيسية</a>
                  </center>
            </div>
        

        </div>
        </div>
     

        <main class="py-4">
<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">

<style>
 @media screen and (max-width: 450px) 
 {
    ::placeholder {
  color: blue;
  font-size: 12px;
}
  }


  @media screen and (min-width: 500px) and (max-width:850px)
   {
    ::placeholder {
  color: blue;
  font-size: 12px;
}
    }


     @media screen and (min-width: 850px) and (max-width:1000px)
      {
        ::placeholder {
  color: blue;
  font-size: 11px;
}
      }
      @media screen and (min-width: 1001px) and (max-width:1806px)
      {
        ::placeholder {
  color: blue;
  font-size: 14px;
}
      }
</style>
<!------ Include the above in your HEAD tag ---------->

<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">



<!-- <div class="header-most-top1">
    <p>Authentique, artistique, création d'art sur mesure ou d'un esprit écologique, <a href="{{route('homepage')}}"> DIMAZINA معانا في     </a></p>
</div> -->

<div class="container">
<hr>

<div class="row">

  


  <aside class="col-md-6">
    <div class="card bg-light">
<article class="card-body mx-auto" style="width: 90%;">
  <h4 class="card-title mt-3 text-center authh4">Inscription sur DIMAZINA</h4>
  
  @isset($url)
                        <form method="POST" action='{{ url("register/$url") }}' aria-label="{{ __('Register') }}">
                        @else
                        <form method="POST" action="{{ route('register') }}" aria-label="{{ __('Register') }}">
                        @endisset
                            @csrf
                           <input type="text" name="url" value="{{session()->get('ur')}}" hidden>

 <label for="name" class="col-form-label text-md-right">{{ __('Votre nom et prénom - إسمك و لقبك   ') }}</label>
  <div class="form-group input-group">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-user"></i> </span>
     </div>
         <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" placeholder="Votre nom et prénom - إسمك و لقبك   " required autocomplete="name" autofocus>

@error('name')
    <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
@enderror

    </div> <!-- form-group// -->
    <label for="email" class="col-form-label text-md-right">{{ __('E_mail - البريد الإلكتروني') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
         <input id="Email" type="email" placeholder="إذا لم يكن لديك بريد إلكتروني ، يرجى وضعه فارغًا" class="form-control @error('Email') is-invalid @enderror" name="Email" value="{{ old('Email') }}"  autocomplete="Email">
    @error('Email')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> <!-- form-group// -->
    <label for="phone" class=" col-form-label text-md-right">{{ __('téléphone - الهاتف') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-phone"></i> </span>
    </div>
        <input id="phone" type="number" placeholder="Votre télephone - هاتفك" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}"  autocomplete="phone">
        @error('phone')
         <span class="invalid-feedback" role="alert">
             <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> <!-- form-group// -->
    <label for="password" class=" col-form-label text-md-right">{{ __('Mot de passe - كلمة السر') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input id="Password" type="password" placeholder="Créer Mot de passe - إنشاء كلمة السر  " class="form-control @error('Password') is-invalid @enderror" name="Password" required autocomplete="new-Password">
        @error('Password')
        <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div> <!-- form-group// -->
    <label for="Password-confirm" class="col-form-label text-md-right">{{ __('Confirmez le mot de passe - تأكيد كلمة السر') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input id="Password-confirm" type="password" placeholder="Confirmez le mot de passe - تأكيد كلمة السر" class="form-control" name="Password_confirmation" required autocomplete="new-Password">
    </div> <!-- form-group// -->  
    <br>                                    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">S'inscrire - تسجيل</button>
    </div> <!-- form-group// -->      
                                                                    
</form>
</article>
</div>
</aside>
  <aside class="col-md-6">
    <div class="card bg-light topform">
<article class="card-body mx-auto" style="width: 90%;">
  <h4 class="card-title mt-3 text-center authh4 ">CONNEXION SUR DIMAZINA</h4>
    <br>
  {{-- <p>
    <a href="" class="btn btn-block btn-twitter"> <i class="fab fa-google"></i>    Continuer Avec Google</a>
    <a href="" class="btn btn-block btn-facebook"> <i class="fab fa-facebook-f"></i>    Continuer Avec facebook</a>
  </p> --}}
  {{-- <p class="divider-text">
        <span class="bg-light">OR</span>
    </p> --}}
    @isset($url)
                        <form method="POST" action='{{ url("login/$url") }}' aria-label="{{ __('Login') }}">
                        @else
                        <form method="POST" action="{{ route('login') }}" aria-label="{{ __('Login') }}">
                        @endisset
                            @csrf

    <label for="email" class="col-form-label text-md-right">{{ __('E-mail / téléphone - الهاتف / البريد الإلكتروني') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-envelope"></i> </span>
     </div>
        <input name="email" class="form-control @error('email') is-invalid @enderror" placeholder="E-mail / téléphone - الهاتف / البريد الإلكتروني" type="text"autocomplete="email" autofocus>

        @error('email')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
            </span>
         @enderror
    </div> <!-- form-group// -->
    
    <label for="password" class="col-form-label text-md-right">{{ __('Votre mot de passe ici - كلمة السر الخاصة بك هنا  ') }}</label>
    <div class="form-group input-group">
      <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
    </div>
        <input class="form-control @error('password') is-invalid @enderror" placeholder="Mot de passe - كلمة السر   " type="password"name="password" required autocomplete="password" autofocus>

        @error('password')
         <span class="invalid-feedback" role="alert">
         <strong>{{ $message }}</strong>
         </span>
        @enderror
    </div> <!-- form-group// -->

    <div class="form-group input-group">  
           <div class="form-check">
           <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>&nbsp;&nbsp;
           <label class="form-check-label" for="remember"> {{ __('Se souvenez de moi') }} </label>
           </div>
    </div> 
    
    
    <div class="form-group">
        <button type="submit" class="btn btn-primary btn-block">  {{ __('Se connecter - تسجيل الدخول ') }}  </button>
        @if (Route::has('password.request'))
       <!-- <a class="btn btn-link" href="{{ route('password.request') }}">
           {{ __('Mot de passe oublié?') }}
        </a>-->
          @endif
    </div> <!-- form-group// -->      
                                                                   
</form>
</article>
</div>

  </aside> <!-- col.// -->

  
</div> <!-- row.// -->

</div> 
<!--container end.//-->
       </main>
    </div>
</body>
</html>
