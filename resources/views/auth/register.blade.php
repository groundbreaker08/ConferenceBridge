@extends('layouts.visitor')

@section('header_css')
    <link href='assets/css/vendor/googleapi/font.css' rel='stylesheet' type='text/css'>
    <link href="assets/css/signup-new.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {background-color: #fff;}
        .main{margin:0 auto;}
        #signupcontainer{margin:0 auto;max-width:500px;}
        .umain .loggedin-userinfo{display:block;margin:-150px 0 0 -250px;}
        .product-logo-part{text-align:center;}
        .signup-head{padding:10px 0 25px;text-align:center;}
        .soniclogo{
            background: url("assets/images/Sonic-20160916-logo.min.png") no-repeat center;
            background-size: contain;
            display:inline-block;
            height:54px;max-width:160px;
            padding:0;
            text-indent:-999em;
            width:156px;
        }
        .signupbtn, .sgnbtn input{
            border:none;
            box-shadow:0 0 0 #5bb46c inset;
            transition:3.5s ease-in-out box-shadow;
            -webkit-transition:3.5s ease-in-out box-shadow;
        }
        .signupbtn.loading{
            box-shadow:600px 0 0 #5bb46c inset;
            -webkit-box-shadow:600px 0 0 #5bb46c inset;
        }
        @media only screen and (-webkit-min-device-pixel-ratio:1.5), only screen and (min--moz-device-pixel-ratio:1.5), only screen and (min-resolution:240dpi){.soniclogo{background-image:url("images/zohohome-sprite-new@2x.png");background-size:700px 100px;}
        }
        @media screen and (max-width:650px){.login-text{margin:10px 20px 0 0;}
            .header-part{padding:0 0 3px;position:relative;border:none;}
            #signupcontainer{padding:40px 10% 0;}
            .soniclogo{margin:0 auto 20px;}
            .sign_agree{font-size:11px;letter-spacing:0;line-height:16px;}
            .signup-head{line-height:26px;padding:15px 0 10px;text-align:center;}
        }
    </style>
@endsection
@section('content')
    <div class="header-part"> <span class="login-text">Have a Sonic account? <a class="login" href="login">Login</a> </span> </div>
<!-- SIGNUP PART STARTS -->
<div class="main">
    <div id="signupcontainer">
        <!-- SIGNUP AREA STARTS -->
        <div class="product-logo-part">
            <a class="product-logo soniclogo" href="{{secure_url('/')}}">Sonic</a>
        </div>
        <h1 class="signup-head">Start with your free account today.</h1>

        <div class="signup-box">
            <!-- SIGNUP FORM STARTS -->
            <form name="signupform" method="POST" action="register" class="form">
                <div class="signupcontainer" >
                    {{ csrf_field() }}

                    <!-- first name container -->
                    <div class="za-name-container sgfrm">
                        <span class="placeholder">First name</span>
                        <input type="text" name="firstname" class="form-input sgnname" tabindex="1" id="firstnamefield" onkeypress="hideMsg(this)" value="{{ old('firstname') }}">
                        @if($errors->has('firstname'))
                        <div>
                            <span class="error jqval-error">
                                {{ $errors->first('firstname') }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- last name container -->
                    <div class="za-name-container sgfrm">
                        <span class="placeholder">Last name</span>
                        <input type="text" name="lastname" class="form-input sgnname" tabindex="2" id="lastnamefield" onkeypress="hideMsg(this)" value="{{ old('lastname') }}">
                        @if($errors->has('lastname'))
                        <div>
                            <span class="error jqval-error">
                                {{ $errors->first('lastname') }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- email container -->
                    <div class="za-email-container sgfrm">
                        <span class="placeholder">Email</span>
                        <input type="email" name="email" class="form-input sgnemail" tabindex="3" id="emailfield" onkeypress="hideMsg(this)" value="{{ old('email') }}">
                        @if($errors->has('email'))
                        <div>
                            <span class="error jqval-error">
                                {{ $errors->first('email') }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <div class="za-captcha-container sgfrm">
                        {!! app('captcha')->display() !!}
                        @if($errors->has('g-recaptcha-response'))
                            <div>
                            <span class="error jqval-error">
                                {{ $errors->first('g-recaptcha-response') }}
                            </span>
                            </div>
                        @endif
                    </div>
                    <!-- sign up container -->
                    <div class="sgnbtnmn">
                        <div class="sign_agree">By clicking 'Sign Up for free', you agree to the
                            <a target="_blank" href="disclaimer">Terms of Service</a> and
                            <a target="_blank" href="privacy">Privacy Policy</a>
                        </div>
                        <div class="sgnbtn">
                            <input type="submit" tabindex="4" class="signupbtn" id="signupbtn" value="Sign up for Free">
                            <div class="loadingImg"></div>
                        </div>
                    </div>
                </div>
            </form><!-- SIGNUP FORM ENDS -->
        </div><!-- SIGNUP AREA ENDS -->
    </div>
</div><!-- SIGNUP PART ENDS -->
@endsection

@section('footer_js')
<!-- SCRIPT SECTION STARTS -->
<script type="text/javascript" src="assets/js/jquery-1.12.4.min.js"></script>
<script src="assets/js/vendor/prd-common.js"></script>
<script src="assets/js/signup.js"></script>
<script type="text/javascript">
    $(function(){
        var signupbtn=$('#signupbtn');
        signupbtn.removeClass('disabledClass');
        signupbtn.css({'opacity':1});
    });
    function onSignupReady() {
        $(document.signupform).zaSignUp({
            onsubmit : function(){
                signupbtn.val("Creating your account...");
                zohoGASignupEvent();
                //$( ".signupbtn" ).addClass('loading');
            },

        });
    }
</script>
<!-- SCRIPT SECTION ENDS -->
@endsection
