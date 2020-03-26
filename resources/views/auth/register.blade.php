@extends('layouts.app')

@section('content')

                <h1>{{ __('Register') }}</h1>

                <div>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <!-- Nachname -->
                        <div class="form-group row">
                            <label for="firstname" class="col-md-4 col-form-label text-md-right">{{ __('Vorname') }}</label>

                            <div class="col-md-6">
                                <input id="firstname" type="text" class="form-control @error('firstname') is-invalid @enderror" name="firstname" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>

                                @error('firstname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        
                        <!-- Nachname -->
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- birthdate -->
                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">{{ __('Geburtsdatum') }}</label>

                            <div class="col-md-6">
                                <input id="birthdate" type="date" class="form-control @error('birthdate') is-invalid @enderror" name="birthdate" value="{{ old('birthdate') }}" required autocomplete="birthdate" autofocus>

                                @error('birthdate')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- tel -->
                        <div class="form-group row">
                            <label for="tel" class="col-md-4 col-form-label text-md-right">{{ __('Telefon') }}</label>

                            <div class="col-md-6">
                                <input id="tel" type="text" class="form-control @error('tel') is-invalid @enderror" name="tel" value="{{ old('tel') }}" required autocomplete="tel" autofocus>

                                @error('tel')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Strasse -->
                        <div class="form-group row">
                            <label for="strasse" class="col-md-4 col-form-label text-md-right">{{ __('Straße') }}</label>

                            <div class="col-md-6">
                                <input id="strasse" type="text" class="form-control @error('strasse') is-invalid @enderror" name="strasse" value="{{ old('strasse') }}" required autocomplete="strasse" autofocus>

                                @error('strasse')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- plz -->
                        <div class="form-group row">
                            <label for="plz" class="col-md-4 col-form-label text-md-right">{{ __('PLZ') }}</label>

                            <div class="col-md-6">
                                <input id="plz" type="text" class="form-control @error('plz') is-invalid @enderror" name="plz" value="{{ old('plz') }}" required autocomplete="plz" autofocus>

                                @error('plz')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- ort -->
                        <div class="form-group row">
                            <label for="ort" class="col-md-4 col-form-label text-md-right">{{ __('Ort') }}</label>

                            <div class="col-md-6">
                                <input id="ort" type="text" class="form-control @error('ort') is-invalid @enderror" name="ort" value="{{ old('ort') }}" required autocomplete="ort" autofocus>

                                @error('ort')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- E-Mail -->
                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Passwort -->
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <!-- Password confirm -->
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <!-- Einverständnis -->
                        <div class="form-group row mb-0">
                            <!-- Datenschutz -->
                            
                            <div class="offset-4 col-6 form-check">
                                <input id="datenschutz" type="checkbox" class="red-green-checkbox form-check-input" required>
                                <label for="datenschutz" class="form-check-label">Ich erkenne die <a href="/datenschutz">Datenschutzbestimmungen</a> an.</label>
                            </div>

                            <!-- Mitgliedsbeitrag -->

                            <div class="offset-4 col-6 form-check">
                                <input id="mitgliedsbeitrag" type="checkbox" class="red-green-checkbox form-check-input" required>
                                <label for="mitgliedsbeitrag" class="form-check-label">{{ __('Ich erkläre mich bereit den satzungsgemäßen Mitgliedsbeitrag zu entrichten') }}</label>
                            </div>

                            <!-- Satzung -->

                            <div class="offset-4 col-6 form-check">
                                <input id="satzung" type="checkbox" class="red-green-checkbox form-check-input" required>
                                <label for="satzung" class="form-check-label">{{ __('Confirm Password') }}</label>
                            </div>
                        </div>
                        
                        <!-- Submit -->
                        <div class="mt-3 form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Mitglied werden') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
@endsection
