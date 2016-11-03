@extends('layouts.visitor')

@section('header_css')
    <link href="assets/css/signup-new.css" rel="stylesheet" type="text/css">
    <style type="text/css">
        body {margin: 0px;padding:0px;font-family: "Open sans";font-weight: 300}
        h3 {margin:0px;font-size:14px;}
        .hide {display:none;}
    </style>
    <link href="assets/css/signin.css" rel="stylesheet" type="text/css">
@endsection
@section('content')
    <div class="header-part">
        <a class="logo" href="{{secure_url('/')}}"> Sonic</a>
        <span class="login-text">Don't have a Sonic account? <a class="login" href="register">Register</a> </span>
    </div>
    <div class="signin-part" id="signin-container">
        <table width="100%" id="outertable" class="mobile-login" style="">
            <tbody>
            <tr>
                <td align="center">
                    <div id="loginform">
                        <form name="login" id="login" action="login" method="POST" novalidate="">
                            {{csrf_field()}}
                            <table id="inntbl" class="mob_width" cellspacing="0" cellpadding="0" align="center">
                                <tbody><tr>
                                    <td valign="top">
                                        <table width="260" class="mob_width" cellpadding="1" cellspacing="2" align="center">
                                            <tbody>
                                            <tr>
                                                <td colspan="2"><h3 class="signintxt">Sign In</h3></td>
                                            </tr>
                                            @if (count($errors) > 0)
                                                <tr>
                                                    @foreach ($errors->all() as $error)
                                                        <td colspan="2" align="center"><span id="msgpanel" class="msg">{{ $error }}</span></td>
                                                    @endforeach
                                                </tr>
                                            @endif
                                            <tr>
                                                <td class="label">Email:</td>
                                                <td align="left"><input type="email" name="email" id="lid" class="input usrbx" value=""></td>
                                            </tr>
                                            <tr>
                                                <td class="label">Password:</td>
                                                <td align="left"><input type="password" name="password" id="pwd" class="input passbx"></td>
                                            </tr>

                                            <tr>
                                                <td class="label"></td>
                                                <td align="left"><div class="forgotpasslink"><a href="password/reset">Forgot Password?</a></div>
                                                </td>
                                            </tr>

                                            <tr id="hiptr" style="display:none;">
                                                <td class="label">&nbsp;</td><td align="left">&nbsp;</td>
                                            </tr>
                                            <tr>
                                                <td class="emptytd"></td>
                                                <td height="30" class="mobile-height">
                                                    <div class="sectxt">
                                                        <label>
                                                            <input type="checkbox" name="remember" id="rem" value="10">
                                                            <span class="securetxt">Keep me signed in</span>
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="emptytd"></td>
                                                <td align="left">
                                                    <button type="submit" id="submit_but" name="submit" class="submit_mobile">Sign In</button>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </form>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
@section('footer_js')
<script type="text/javascript" src="{{secure_asset('assets/js/jquery.min.js')}}"></script>
<script>
    $(function(){
        $('#pwd').on('keypress change input keyup',function( e ) {
            if(e.which === 32)
                return false;
        }).bind('paste',function(e){
            var pwd_field = $(this);
            setTimeout(function(){
                pwd_field.val($.trim(pwd_field.val()));
                pwd_field.val((pwd_field.val()));
            });
        });
    });
</script>
@endsection