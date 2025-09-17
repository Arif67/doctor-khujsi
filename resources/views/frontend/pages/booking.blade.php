@extends('layouts.app')

@section('title', 'Book Appointment - Hospital Management')

@push('styles')
<style>
    .booking-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }
    
    .booking-content {
        background: #fff;
    }
    
    .booking-subtitle {
        font-size: 1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.5;
    }
    
    label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }
    
    input.form-control,
    select.form-select,
    textarea.form-control {
        padding: 14px 16px;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s ease;
    }
    
    input.form-control:focus,
    select.form-select:focus,
    textarea.form-control:focus {
        outline: none;
        border-color: #22B8CF;
        box-shadow: 0 0 0 3px rgba(34, 184, 207, 0.1);
    }
    
    .submit-btn {
        background: #22B8CF;
        color: white;
        padding: 16px 32px;
        border: none;
        border-radius: 8px;
        font-size: 1rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        margin-top: 20px;
        align-self: flex-start;
    }
    
    .submit-btn:hover {
        background: #1a9bb0;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(34, 184, 207, 0.3);
    }
    
    .required {
        color: #e74c3c;
    }

    
</style>
@endpush

@section('content')
<div class="main-wrap py-5">
    <div class="container">
        <div class="row row-gap-4 align-items-md-center">
            <div class="col-lg-4 d-none d-lg-block">
                <div class="booking-image">
                    <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="booking-image">
                </div>
            </div>
            @if ($errors->any())
                {{ $errors }}
            @endif
            <div class="col-lg-8">
                <div class="booking-content p-3">
                    <h1 class="heading_title">Book Your Appointment</h1>
                    <p class="booking-subtitle">Schedule your visit with our experienced medical professionals. Fill out the form below and we'll get back to you shortly.</p>
                    
                    <form class="booking-form" action="{{route('app.booking.store')}}" method="POST">
                        @csrf   
                        <div class="row row-gap-4">
                            <div class="col-md-6">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required placeholder="First Name">
                            </div>
                            <div class="col-md-6">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required placeholder="Last Name">
                            </div>
                            
                            <div class="col-md-6">
                                 <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" required placeholder="Email Address">
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control" required placeholder="Phone Number">
                            </div>
                            <div class="col-md-6">
                                <label for="mobile">Mobile</label>
                                <input type="tel" id="mobile" name="mobile" class="form-control" required placeholder="Mobile">
                            </div>
                            <div class="col-md-6">
                                <label for="blood">Blood Group</label>
                                <select name="blood" class="form-select">
                                    <option value="">Select Blood Group</option>
                                    <option value="A+" {{ old('blood') == 'A+' ? 'selected' : '' }}>A+</option>
                                    <option value="A-" {{ old('blood') == 'A-' ? 'selected' : '' }}>A-</option>
                                    <option value="B+" {{ old('blood') == 'B+' ? 'selected' : '' }}>B+</option>
                                    <option value="B-" {{ old('blood') == 'B-' ? 'selected' : '' }}>B-</option>
                                    <option value="O+" {{ old('blood') == 'O+' ? 'selected' : '' }}>O+</option>
                                    <option value="O-" {{ old('blood') == 'O-' ? 'selected' : '' }}>O-</option>
                                    <option value="AB+" {{ old('blood') == 'AB+' ? 'selected' : '' }}>AB+</option>
                                    <option value="AB-" {{ old('blood') == 'AB-' ? 'selected' : '' }}>AB-</option>
                                </select>
                                @error('blood') 
                                    <p class="text-red-500 text-sm mt-1">{{ $message }}</p> 
                                @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="sex">Sex</label>
                                <select name="sex" class="form-select">
                                    <option value="">Select</option>
                                    <option value="Male" {{ old('sex') == 'Male' ? 'selected' : '' }}>Male</option>
                                    <option value="Female" {{ old('sex') == 'Female' ? 'selected' : '' }}>Female</option>
                                </select>
                                @error('sex') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                            <div class="col-md-6">
                                <label for="date_of_birth">Date of Birth</label>
                                <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" class="form-control">
                                @error('date_of_birth') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                            </div>
                             <div class="col-md-6">
                                <label for="appointment_date">Appointment Date <span class="required">*</span></label>
                                <input type="date" id="appointment_date" class="form-control" name="appointment_date" required>
                            </div>
                             <div class="col-md-6">
                                <label for="appointment_time">Appointment Time <span class="required">*</span></label>
                                <select id="appointment_time" class="form-select" name="appointment_time" class="form-control" required>
                                    <option value="">Select Time</option>
                                    <option value="09:00">9:00 AM</option>
                                    <option value="10:00">10:00 AM</option>
                                    <option value="11:00">11:00 AM</option>
                                    <option value="14:00">2:00 PM</option>
                                    <option value="15:00">3:00 PM</option>
                                    <option value="16:00">4:00 PM</option>
                                </select>
                            </div>
                             <div class="col-md-6">
                                <label for="department_id">Department <span class="required">*</span></label>
                                <select id="department_id" class="form-select" name="department_id" required>
                                    <option value="">Select Department</option>
                                    @foreach ($departments as $department)
                                    <option value="{{$department->id}}">{{$department->name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="password">Password:</label>
                                <input type="password" id="password" name="password" class="form-control" required placeholder="Enter Password">
                            </div>
                            <div class="col-12">
                                <label for="message">Additional Message</label>
                                <textarea id="message" class="form-control" name="message" placeholder="Please describe your symptoms or reason for visit..."></textarea>
                            </div>
                        
                        </div> 
                        <button type="submit" class="submit-btn">Book Appointment</button>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
