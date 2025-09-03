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
        <div class="row row-gap-4">
            <div class="col-lg-4 d-none d-lg-block">
                <div class="booking-image">
                    <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="booking-image">
                </div>
            </div>
            <div class="col-lg-8">
                <div class="booking-content p-3">
                    <h1 class="heading_title">Book Your Appointment</h1>
                    <p class="booking-subtitle">Schedule your visit with our experienced medical professionals. Fill out the form below and we'll get back to you shortly.</p>
                    
                    <form class="booking-form" action="" method="POST">
                        @csrf   
                        <div class="row row-gap-4">
                            <div class="col-md-6">
                                <label for="full_name">Full Name <span class="required">*</span></label>
                                <input type="text" id="full_name" class="form-control" name="full_name" required>
                            </div>
                            <div class="col-md-6">
                                 <label for="email">Email Address <span class="required">*</span></label>
                                <input type="email" id="email" class="form-control" name="email" required>
                            </div>
                            <div class="col-md-6">
                                <label for="phone">Phone Number <span class="required">*</span></label>
                                <input type="tel" id="phone" name="phone" class="form-control" required>
                            </div>
                             <div class="col-md-6">
                                <label for="appointment_date">Preferred Date <span class="required">*</span></label>
                                <input type="date" id="appointment_date" class="form-control" name="appointment_date" required>
                            </div>
                             <div class="col-md-6">
                                <label for="appointment_time">Preferred Time <span class="required">*</span></label>
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
                                <label for="department">Department <span class="required">*</span></label>
                                <select id="department" class="form-select" name="department" required>
                                    <option value="">Select Department</option>
                                    <option value="cardiology">Cardiology</option>
                                    <option value="neurology">Neurology</option>
                                    <option value="orthopedics">Orthopedics</option>
                                    <option value="pediatrics">Pediatrics</option>
                                    <option value="general">General Medicine</option>
                                </select>
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
