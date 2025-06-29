@extends('layouts.auth')

@section('content')
    <div class="container">
        <style>
            @media (max-width: 576px) {
                .logo-civ-pc {
                    display: none;
                }
                .logo-phone {
                    display: block!important;
                }
                img {
                    width: 50%!important;
                }
                h1 {
                    font-size: xx-large!important;
                }
                .row {
                    text-align: center;
                }
            }
        </style>
        <div class="row">
            <div class="col-sm-6">
                <div class="logo-phone p-2" style="display: none">
                    <a target="_blank" href="http://www.uncosu.gob.gt">
                        <img src="/assets/img/logo-civ.png" alt="Image" class="img-fluid">
                    </a>
                </div>
                <div class="row">
                    <div class="col-sm-12 mb-5">
                        <h1 style="font-size: xxx-large"><strong>Portal de Trámites</strong></h1>
                    </div>
                    <div class="col-sm-12">
                        <img src="/assets/img/logo_unc.png" alt="Image" class="img-fluid" style="border-radius: 10px; width: 80%">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="row">
                    <div class="col-sm-12 mb-5 text-center">
                        <a target="_blank" href="http://www.uncosu.gob.gt">
                            <img src="/assets/img/logo-civ.png" alt="Image" class="img-fluid logo-civ-pc">
                        </a>
                    </div>
                    <div class="col-sm-12">
                        <div class="card border-0 py-5 px-3" style="background:url(/assets/img/12874.png)">
                            <div class="card-header text-white text-center border-0 bg-transparent">
                                <h3 class="fw-bold">Inicio de sesión</h3>
                                <h6 class="fw-bold">Ingresa tus credenciales</h6>
                            </div>
                            <div class="card-body border-0">
                                <form id="form-login" method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <h6 class="fw-bold text-white">Usuario</h6>
                                    <div class="form-group last mb-3">
                                        <input type="text" class="form-control"  id="email" name="email" value="" required  >
                                    </div>
                                    <h6 class="fw-bold text-white">Contraseña</h6>
                                    <div class="form-group last mb-3">
                                        <input type="password" class="form-control" id="password" name="password" value="" required>
                                    </div>
                                    <button type="submit" id="btn-login" class="btn btn-block" style="background-color: #7AB700">
                                        <strong>Acceder</strong>
                                        <span class="spinner-border spinner-border-sm" id="loader" role="status" hidden="hidden"></span>
                                    </button>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-white px-3" href="{{ route('register') }}">
                                            Regístrate
                                        </a>
                                    @endif
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link text-white px-2" href="{{ route('password.request') }}">
                                            ¿Olvidaste tu contraseña?
                                        </a>
                                    @endif
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
