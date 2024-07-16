@props(['doctor_info', 'consultation_infos'])

<div class="card" id="availability-form" style="display: none;">
    <div class="card-header pb-0 px-3">
        <h6 class="mb-0">{{ __('Horaires de travail') }}</h6>
    </div>
    <div class="card-body pt-4 p-3">
        <form action="{{ route('doctor_infos.update', ['doctor_info' => auth()->user()->id]) }}"
              method="POST" role="form" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            @if($errors->any())
                <div class="mt-3 alert alert-primary alert-dismissible fade show" role="alert">
                    <span class="alert-text text-white">{{ $errors->first() }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
            @endif

            @if(session('success'))
                <div class="m-3 alert alert-success alert-dismissible fade show" id="success-message"
                     role="alert">
                    <span class="alert-text text-white">{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
                        <i class="fa fa-close" aria-hidden="true"></i>
                    </button>
                </div>
            @endif

            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time" class="form-control-label">{{ __('Heure d\'ouverture') }}</label>
                        <div class="@error('start_time') border border-danger rounded-3 @enderror">
                            <select class="form-select" name="speciality" id="speciality">
                                <option value="{{ $doctor_info->speciality }}" disabled selected>{{ __('Sélectionner une spécialité') }}</option>
                                @foreach(config('specialities') as $speciality)
                                    <option value="{{ $speciality }}">{{ $speciality }}</option>
                                @endforeach
                            </select>
                            @error('speciality')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="start_time" class="form-control-label">{{ __('Heure d\'ouverture') }}</label>
                        <div class="@error('start_time') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="time" id="start_time" name="start_time"
                                   value="{{ $doctor_info->start_time }}">
                            @error('start_time')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="end_time" class="form-control-label">{{ __('Heure de fermeture') }}</label>
                        <div class="@error('end_time') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="time" id="end_time" name="end_time"
                                   value="{{ $doctor_info->end_time }}">
                            @error('end_time')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="office_phone_number" class="form-control-label">{{ __('Heure de fermeture') }}</label>
                        <div class="@error('office_phone_number') border border-danger rounded-3 @enderror">
                            <input class="form-control" type="text" id="office_phone_number" name="office_phone_number"
                                   value="{{ $doctor_info->office_phone_number }}">
                            @error('office_phone_number')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="days_of_week" class="form-control-label">{{ __('Jours de travail') }}</label>
                        <div class="@error('days_of_week') border border-danger rounded-3 @enderror">
                            <select class="form-control" id="days_of_week" name="days_of_week[]"
                                    aria-label="days_of_week" multiple>
                                @foreach(['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'] as $index => $day)
                                    <option
                                        value="{{ $index }}" {{ $doctor_info->days_of_week && in_array($index, json_decode($doctor_info->days_of_week)) ? 'selected' : '' }}>{{ $day }}</option>
                                @endforeach
                            </select>
                            @error('days_of_week')
                            <p class="text-danger text-xs mt-2">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <h6 class="mb-3">{{ __('Informations sur la consultation') }}</h6>
            <div id="consultation-info-container">
                @foreach($consultation_infos as $consultation_info)
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="type_{{ $consultation_info->id }}" class="form-control-label">{{ __('Type de consultation') }}</label>
                                <div class="@error('type') border border-danger rounded-3 @enderror">
                                    <select id="type_{{ $consultation_info->id }}" name="type_{{ $consultation_info->id }}" class="form-control" required>
                                        @foreach(App\Enums\ConsultationType::getValues() as $type)
                                            <option value="{{ $type }}" {{ $type === $consultation_info->type ? 'selected' : '' }}>{{ $type }}</option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fees_{{ $consultation_info->id }}" class="form-control-label">{{ __('Frais de consultation') }}</label>
                                <div class="@error('fees') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="text" id="fees_{{ $consultation_info->id }}" name="fees_{{ $consultation_info->id }}"
                                           value="{{ $consultation_info->fees }}">
                                    @error('fees')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="duration_{{ $consultation_info->id }}" class="form-control-label">{{ __('Durée (minutes)') }}</label>
                                <div class="@error('duration') border border-danger rounded-3 @enderror">
                                    <input class="form-control" type="number" id="duration_{{ $consultation_info->id }}" name="duration_{{ $consultation_info->id }}"
                                           value="{{ $consultation_info->duration }}">
                                    @error('duration')
                                    <p class="text-danger text-xs mt-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit"
                        class="btn bg-gradient-dark btn-md mt-4 mb-4">{{ 'Sauvegarder' }}</button>
            </div>
        </form>
    </div>
</div>
