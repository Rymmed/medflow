@extends('layouts.user_type.auth')

@section('content')
    <div class="row">
        <div class="container col-md-4 col-lg-3 card px-1">
            <h6 class="m-3">Trouver un médecin</h6>
            <div class="card-body">
                <form action="{{ route('search_doctors') }}" method="POST" id="search-form">
                    @csrf
                    <div class="mb-3">
                        <label for="speciality">Spécialité :</label>
                        <select id="speciality" name="speciality[]" class="form-control" multiple>
                            @foreach(config('specialities') as $speciality)
                                <option
                                    value="{{ $speciality }}" {{ in_array($speciality, old('speciality', [])) ? 'selected' : '' }}>
                                    {{ $speciality }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="country">Pays :</label>
                        <input type="text" id="country" name="country" class="form-control"
                               value="{{ old('country', $country) }}">
                    </div>
                    <div class="mb-3">
                        <label for="city">Ville :</label>
                        <input type="text" id="city" name="city" class="form-control" value="{{ old('city', $city) }}">
                    </div>
                    <button type="submit" class="btn btn-secondary right-0 " id="search-button">Rechercher</button>
                </form>
            </div>
        </div>
        <div id="search-results" class="container col-md-8 col-lg-9">
            <p class="mt-4 text-sm">Affichage de {{$results->count()}} parmis {{ $totalResults->count() }} résultats
                trouvés</p>
            <div class="card-body">
                <div class="row d-flex position-relative">
                    @if(isset($results) && $results->count() === 0)
                        <p>Aucun médecin trouvé.</p>
                    @elseif(isset($results))
                        <div class="row justify-content-center position-absolute">
                            @foreach($results as $doctor)
                                <div class="col-md-5 mb-4">
                                    <div class="card p-4">
                                        <div class="text-center">
                                            <x-profile-image :class="'avatar avatar-xl border-radius-section shadow'"
                                                             :image="$doctor->profile_image"></x-profile-image>
                                            <h6 class="card-title text-sm text-center mt-2">
                                                Dr. {{ $doctor->lastName }} {{ $doctor->firstName }}
                                            </h6>
                                        </div>

                                        <p class="card-text text-xs"><i class="fas fa-notes-medical mx-2"></i>{{ $doctor->doctor_info->speciality }}</p>
                                        <p class="card-text text-xs"><i class="fas fa-map-marker-alt mx-2"></i>{{ $doctor->city }} {{ $doctor->country }}</p>
                                        <p class="card-text text-xs"><i class="fas fa-phone-alt mx-2"></i>{{ $doctor->phone_number }}</p>

                                        <!-- Système de notation en étoiles -->
                                        <div class="text-center">
                                            <div class="rating-stars">
                                                @php
                                                    $rating = $doctor->averageRating() ?? 0;  // Valeur par défaut 0 si aucune note
                                                    $fullStars = floor($rating); // Nombre d'étoiles pleines
                                                    $halfStar = $rating - $fullStars >= 0.5; // Étoile à moitié pleine ?
                                                @endphp

                                                    <!-- Affichage des étoiles pleines -->
                                                @for ($i = 0; $i < $fullStars; $i++)
                                                    <i class="fas fa-star text-warning"></i>
                                                @endfor

                                                <!-- Affichage d'une étoile à moitié pleine -->
                                                @if ($halfStar)
                                                    <i class="fas fa-star-half-alt text-warning"></i>
                                                @endif

                                                <!-- Affichage des étoiles vides -->
                                                @for ($i = $fullStars + $halfStar; $i < 5; $i++)
                                                    <i class="far fa-star text-warning"></i>
                                                @endfor

                                                <p class="text-xs mt-2">Moyenne : {{ number_format($rating, 1) }} / 5</p>
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <a href="{{ route('appointment.request', ['doctor_id' => $doctor->id]) }}"
                                               class="btn bg-gradient-primary text-white">Prendre rendez-vous</a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                    @endif
                </div>
            </div>

        </div>
        <div class="d-flex justify-content-center">
            {{ $results->links() }}
        </div>
    </div>
@endsection
