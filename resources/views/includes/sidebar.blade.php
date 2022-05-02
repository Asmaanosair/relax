<aside class="sidebar position-fixed top-0 start-0 h-100 bg-white border-end">
    <header class="text-center p-3">
        <h2 class="lh-1 mb-0">{{ __('relax') }}</h2>
    </header>
    <ul class="pt-3 ps-0 border-top">
        @if (Auth::user()->isAdmin())
        <li class="d-flex align-items-center" id="base--l">
            <i class="uil uil-estate"></i>
            <a href="{{ route('home') }}">{{ __('dashboard') }}</a>
        </li>
        <li class="d-flex align-items-center" id="patients--l">
            <i class="uil uil-user-nurse"></i>
            <a href="{{ route('admin.patients.index') }}">{{ __('patients') }}</a>
        </li>
        <li class="d-flex align-items-center" id="doctors--l">
            <i class="uil uil-building"></i>
            <a href="{{ route('admin.doctors.index') }}">{{ __('internal_dep_docs') }}</a>
        </li>
        <li class="d-flex align-items-center" id="doctor_clinics--l">
            <i class="uil uil-clinic-medical"></i>
            <a href="{{ route('admin.doctor_clinics.index') }}">{{ __('external_clinics') }}</a>
        </li>
        <li class="d-flex align-items-center justify-content-between pe-3" id="activities--l">
            <div>
                <i class="uil uil-comment-alt-chart-lines"></i>
                <a href="{{ route('admin.activities.index') }}">{{ __('activities') }}</a>
            </div>
            {{-- <span class="badge bg-primary rounded-pill small p-0" style="width: 20px; height: 20px; line-height: 20px">14</span> --}}
        </li>
        <li class="d-flex align-items-center" id="nationalities--l">
            <i class="uil uil-parcel"></i>
            <a href="{{ route('admin.nationalities.index') }}">{{ __('nationalities') }}</a>
        </li>
        <li class="d-flex align-items-center" id="assessments--l">
            <i class="uil uil-comment-verify"></i>
            <a href="{{ route('admin.assessments.index') }}">{{ __('assessments') }}</a>
        </li>
        <li class="d-flex align-items-center" id="inside_departments--l">
            <i class="uil uil-window-section"></i>
            <a href="{{ route('admin.inside_departments.index') }}">{{ __('intrnl_sections') }}</a>
        </li>
        <li class="d-flex align-items-center" id="pricings--l">
            <i class="uil uil-bill"></i>
            <a href="{{ route('admin.pricings.index') }}">{{ __('pricing') }}</a>
        </li>
        <li class="d-flex align-items-center" id="clinics--l">
            <i class="uil uil-clinic-medical"></i>
            <a href="{{ route('admin.clinics.index') }}">{{ __('clinics') }}</a>
        </li>
        <li class="d-flex align-items-center" id="payment_method--l">
            <i class="uil uil-invoice"></i>
            <a href="{{ route('admin.payment_method.index') }}">{{ __('pymnt_methods') }}</a>
        </li>
        <li class="d-flex align-items-center" id="schools--l">
            <i class="uil uil-bus-school"></i>
            <a href="{{ route('admin.schools.index') }}">{{ __('schools') }}</a>
        </li>
        <li class="d-flex align-items-center" id="treatments--l">
            <i class="uil uil-coins"></i>
            <a href="{{ route('admin.treatments.index') }}">{{ __('treatments') }}</a>
        </li>
        <li class="d-flex align-items-center" id="categories--l">
            <i class="uil uil-hospital"></i>
            <a href="{{ route('admin.categories.index') }}">{{ __('hsptl_depmnt') }}</a>
        </li>
        <li class="d-flex align-items-center" id="question--l">
            <i class="uil uil-question-circle"></i>
            <a href="{{ route('admin.question.index') }}">{{ __('questions') }}</a>
        </li>
        @endif

        @if (Auth::user()->isClinicDoctor())
        <li class="d-flex align-items-center" id="doctor_appointments--l">
            <i class="uil uil-calender"></i>
            <a href="{{ route('doctor.doctor_appointments.index') }}">{{ __('Appointments') }}</a>
        </li>
        <li class="d-flex align-items-center" id="appointment_patients--l">
            <i class="uil uil-accessible-icon-alt"></i>
            <a href="{{ route('doctor.appointment_patients.index') }}">{{ __('Appointments with patients') }}</a>
        </li>
        <li class="d-flex align-items-center" id="question--l">
            <i class="uil uil-comments-alt"></i>
            <a href="{{ route('chat.index') }}">Conversations</a>
        </li>
        @endif

        @if(Auth::user()->isInsideDoctor())
        <li class="d-flex align-items-center" id="internal_appointment_patients--l">
            <i class="uil uil-accessible-icon-alt"></i>
            <a href="{{ route('doctor.internal_appointment_patients.index') }}">Internal appointments patients</a>
        </li>
        {{-- @TODO: currently don't know why --}}
        {{-- @if (Auth::user()->id == 3)
        <li class="d-flex align-items-center" id="question--l">
            <i class="uil uil-ambulance"></i>
            <a href="{{ url('department-doctor/dr-video') }}">Emergency</a>
        </li>
        @endif --}}
        <li class="d-flex align-items-center" id="doctor_patients--l">
            <i class="uil uil-building"></i>
            <a href="{{ route('doctor.doctor_patients.index') }}">Patients internal section</a>
        </li>
        <li class="d-flex align-items-center" id="question--l">
            <i class="uil uil-comments-alt"></i>
            <a href="{{ route('chat.index') }}">Conversations</a>
        </li>
        @endif
    </ul>
</aside>