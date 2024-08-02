<div class=" animated animated" data-wow-delay="400ms" style="visibility: visible; animation-delay: 400ms; animation-name: fadeInUp;">
    <div class='card'>

        <div class="card-body">
            <h3 class="">{{__('Client Consent Form')}}</h3>

            <div>
                <p>{{auth()->user()->name}}</p>
            </div>
            <div>
                <div>
                    <form wire:submit.prevent="submit">
                        <div class="form-group mb-2">
                            <label for="currentMedications">Current Medications (and Dosage):</label>
                            <textarea wire:model="currentMedications" id="currentMedications" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="physicianName">Physician Name:</label>
                            <input wire:model="physicianName" id="physicianName" type="text" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label for="everHadAyurvedicConsultation">Ever Had Ayurvedic Consultation?</label>
                            <div class="">
                                <input wire:model="everHadAyurvedicConsultation" id="everHadAyurvedicConsultationYes" value="yes" type="radio" class="btn-check">
                                <label for="everHadAyurvedicConsultationYes" class="btn btn-outline-gray-500">Yes</label>

                                <input wire:model="everHadAyurvedicConsultation" id="everHadAyurvedicConsultationNo" value="no" type="radio" class="btn-check">
                                <label for="everHadAyurvedicConsultationNo" class="btn btn-outline-gray-500">No</label>
                            </div>
                            @error('everHadAyurvedicConsultation') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2" wire:if="everHadAyurvedicConsultation === 'yes'">
                            <label for="lastAyurvedicSession">When Was Your Last Session?</label>
                            <input wire:model="lastAyurvedicSession" id="lastAyurvedicSession" type="text" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label for="particularConcerns">Any Particular Areas of Concern?</label>
                            <textarea wire:model="particularConcerns" id="particularConcerns" class="form-control"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label>May We Contact You for Appointment Confirmation?</label>
                            <div class="">
                                <input wire:model="contactPermission" id="contactPermissionYes" value="yes" type="radio" class="btn-check">
                                <label for="contactPermissionYes" class="btn btn-outline-gray-500">Yes</label>

                                <input wire:model="contactPermission" id="contactPermissionNo" value="no" type="radio" class="btn-check">
                                <label for="contactPermissionNo" class="btn btn-outline-gray-500">No</label>
                            </div>
                            @error('contactPermission') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label>May We Leave a Message If You Don't Answer?</label>
                            <div class="">
                                <input wire:model="leaveMessagePermission" id="leaveMessagePermissionYes" value="yes" type="radio" class="btn-check">
                                <label for="leaveMessagePermissionYes" class="btn btn-outline-gray-500">Yes</label>

                                <input wire:model="leaveMessagePermission" id="leaveMessagePermissionNo" value="no" type="radio" class="btn-check">
                                <label for="leaveMessagePermissionNo" class="btn btn-outline-gray-500">No</label>
                            </div>
                            @error('leaveMessagePermission') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
                        <div class="form-group mb-2">
                            <label>May We Discuss Medical Condition with Family Member?</label>
                            <div class="custom-control custom-radio">
                                <input wire:model="discussMedicalConditionPermission" id="discussMedicalConditionPermissionYes" value="yes" type="radio" class="btn-check">
                                <label for="discussMedicalConditionPermissionYes" class="btn btn-outline-gray-500">Yes</label>
                                <input wire:model="discussMedicalConditionPermission" id="discussMedicalConditionPermissionNo" value="no" type="radio" class="btn-check">
                                <label for="discussMedicalConditionPermissionNo" class="btn btn-outline-gray-500">No</label>
                            </div>
                            @error('discussMedicalConditionPermission') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-2">
                            <label for="familyMemberNames">Family Member Names (if applicable):</label>
                            <input wire:model="familyMemberNames" id="familyMemberNames" type="text" class="form-control">
                        </div>

                        <div class="form-group mb-2">
                            <label for="readAndUnderstood">Read and Understood All Client Consent?</label>
                            <div class="custom-control custom-radio">
                                <input wire:model="readAndUnderstood" id="readAndUnderstoodYes" value="yes" type="radio" class="btn-check">
                                <label for="readAndUnderstoodYes" class="btn btn-outline-gray-500">Yes</label>
                            </div>
                            @error('readAndUnderstood') <span class="invalid-feedback">{{ $message }}</span> @enderror
                        </div>
    
                        <div class='d-flex justify-content-end mb-3'>
                            <button type="submit" class="btn btn-success">{{__('Agree to the client consent')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>