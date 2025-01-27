@extends('layouts.user_type.auth')

@section('content')
    <div class="container-fluid py-4">
        <div class="card" id="profile-form">
            <div class="card-header pb-0 px-3">
                <h6 class="mb-0">{{ __('Ajouter un assistant ') }}</h6>
            </div>
            <div class="card-body pt-4 p-3">
                <form action="{{ route('doctor-assistants.store') }}" method="POST" role="form text-left">
                    @csrf
                    @if($errors->any())
                        <div class="mt-3  alert alert-primary alert-dismissible fade show" role="alert">
                            <span class="alert-text text-white">
                            {{$errors->first()}}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    @if(session('success'))
                        <div class="m-3  alert alert-success alert-dismissible fade show" id="alert-success" role="alert">
                            <span class="alert-text text-white">
                            {{ session('success') }}</span>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                                <i class="fa fa-close" aria-hidden="true"></i>
                            </button>
                        </div>
                    @endif
                    <div class="row">
                        <!-- Nom -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="lastName" class="form-control-label">{{ __('Nom') }}</label>
                                <div class="@error('user.lastName')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="{{ __('Entrez le nom') }}" id="lastName" name="lastName">
                                    @error('lastName')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Prénom -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="firstName" class="form-control-label">{{ __('Prénom') }}</label>
                                <div class="@error('user.firstName')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" placeholder="{{ __('Entrez le prénom') }}" id="firstName" name="firstName">
                                    @error('firstName')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Email -->
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="email" class="form-control-label">{{ __('Email') }}</label>
                                <div class="@error('email')border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="email" placeholder="{{ __('Entrez l\'adresse email') }}" id="email" name="email">
                                    @error('email')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password" class="form-control-label">{{ __('Mot de passe') }}</label>
                                <div class="@error('password') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="password" placeholder="{{ __('Entrez votre nouveau mot de passe') }}" id="password" name="password">
                                    @error('password')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="password_confirmation" class="form-control-label">{{ __('Confirmation du mot de passe') }}</label>
                                <div class="@error('password_confirmation') border border-danger rounded-3 @enderror">
                                    <input class="form-control @error('password_confirmation') border border-danger rounded-3 @enderror" type="password" placeholder="{{ __('Confirmez votre mot de passe') }}" id="password_confirmation" name="password_confirmation">
                                    @error('password_confirmation')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <!-- Genre -->
                        <div class="col-md-4">
                            <label for="gender">{{__('Genre') }} *</label>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" name="gender" id="male"
                                       value="{{ \App\Enums\Gender::MALE }}">
                                <label class="custom-control-label"
                                       for="male">{{__('Homme')}}</label>
                            </div>
                            <div class="form-check mb-3">
                                <input type="radio" class="form-check-input" name="gender"
                                       id="female"
                                       value="{{ \App\Enums\Gender::FEMALE }}">
                                <label class="custom-control-label"
                                       for="female">{{__('Femme')}}</label>
                            </div>
                        </div>

                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Ajouter' }}</button>
                    </div>
                </form>
            </div>
        </div>

    </div>
@endsection
