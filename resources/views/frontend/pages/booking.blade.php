@extends('frontend.layout.masterlayout')

@section('title', 'Book Appointment - Hospital Management')

@section('styles')
<style>
    @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap');
    
    body {
        margin: 0;
        padding: 0;
        background: #fff;
        font-family: 'Poppins', sans-serif;
    }
    
    .main-wrap {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 40px 20px;
    }
    
    .booking-container {
        display: flex;
        align-items: flex-start;
        background: transparent;
        gap: 60px;
        max-width: 1200px;
        width: 100%;
    }
    
    .booking-image {
        width: 370px;
        height: 370px;
        border-radius: 20px;
        overflow: hidden;
        background: #f7f7f7;
        box-shadow: none;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .booking-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 20px;
    }
    
    .booking-content {
        background: #fff;
        border-radius: 0;
        box-shadow: none;
        padding: 0;
        min-width: 600px;
        flex: 1;
    }
    
    .booking-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: #333;
        margin-bottom: 8px;
        line-height: 1.2;
    }
    
    .booking-subtitle {
        font-size: 1rem;
        color: #666;
        margin-bottom: 40px;
        line-height: 1.5;
    }
    
    .booking-form {
        display: flex;
        flex-direction: column;
        gap: 24px;
    }
    
    .form-row {
        display: flex;
        gap: 20px;
    }
    
    .form-group {
        flex: 1;
        display: flex;
        flex-direction: column;
    }
    
    .form-group label {
        font-size: 0.9rem;
        font-weight: 500;
        color: #333;
        margin-bottom: 8px;
    }
    
    .form-group input,
    .form-group select,
    .form-group textarea {
        padding: 14px 16px;
        border: 2px solid #e5e5e5;
        border-radius: 8px;
        font-size: 0.95rem;
        font-family: 'Poppins', sans-serif;
        transition: border-color 0.3s ease;
        background: #fff;
    }
    
    .form-group input:focus,
    .form-group select:focus,
    .form-group textarea:focus {
        outline: none;
        border-color: #22B8CF;
        box-shadow: 0 0 0 3px rgba(34, 184, 207, 0.1);
    }
    
    .form-group textarea {
        resize: vertical;
        min-height: 100px;
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
    
    /* Responsive Design */
    @media (max-width: 768px) {
        .booking-container {
            flex-direction: column;
            gap: 40px;
            align-items: center;
        }
        
        .booking-image {
            width: 300px;
            height: 300px;
        }
        
        .booking-content {
            min-width: auto;
            width: 100%;
            max-width: 500px;
        }
        
        .form-row {
            flex-direction: column;
            gap: 16px;
        }
        
        .booking-title {
            font-size: 2rem;
            text-align: center;
        }
        
        .booking-subtitle {
            text-align: center;
        }
        
        .submit-btn {
            align-self: stretch;
        }
    }
    
    @media (max-width: 480px) {
        .main-wrap {
            padding: 20px 15px;
        }
        
        .booking-image {
            width: 250px;
            height: 250px;
        }
        
        .booking-title {
            font-size: 1.8rem;
        }
    }
    @media (max-width: 900px) {
        .main-wrap {
            padding: 18px 2vw;
        }
        .booking-container {
            flex-direction: column;
            gap: 28px;
            align-items: center;
        }
        .booking-image {
            width: 70vw;
            max-width: 340px;
            height: auto;
        }
        .booking-content {
            min-width: 0;
            width: 100%;
            padding: 0 2vw;
        }
    }
    @media (max-width: 600px) {
        .main-wrap {
            padding: 6px 1vw;
        }
        .booking-image {
            width: 98vw;
            max-width: 200px;
            height: auto;
        }
        .booking-content {
            padding: 0 1vw;
        }
        .booking-content form input,
        .booking-content form select,
        .booking-content form textarea {
            font-size: 0.98em;
        }
        .booking-content form button {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
<div class="main-wrap">
    <div class="booking-container">
        <div class="booking-image">
            <img src="https://i.postimg.cc/yN0NFzRH/image.png" alt="booking-image">
        </div>
        
        <div class="booking-content">
            <h1 class="booking-title">Book Your Appointment</h1>
            <p class="booking-subtitle">Schedule your visit with our experienced medical professionals. Fill out the form below and we'll get back to you shortly.</p>
            
            <form class="booking-form" action="{{ route('booking.store') }}" method="POST">
                @csrf
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="first_name">First Name <span class="required">*</span></label>
                        <input type="text" id="first_name" name="first_name" required>
                    </div>
                    <div class="form-group">
                        <label for="last_name">Last Name <span class="required">*</span></label>
                        <input type="text" id="last_name" name="last_name" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <input type="email" id="email" name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <input type="tel" id="phone" name="phone" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="appointment_date">Preferred Date <span class="required">*</span></label>
                        <input type="date" id="appointment_date" name="appointment_date" required>
                    </div>
                    <div class="form-group">
                        <label for="appointment_time">Preferred Time <span class="required">*</span></label>
                        <select id="appointment_time" name="appointment_time" required>
                            <option value="">Select Time</option>
                            <option value="09:00">9:00 AM</option>
                            <option value="10:00">10:00 AM</option>
                            <option value="11:00">11:00 AM</option>
                            <option value="14:00">2:00 PM</option>
                            <option value="15:00">3:00 PM</option>
                            <option value="16:00">4:00 PM</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="department">Department <span class="required">*</span></label>
                        <select id="department" name="department" required>
                            <option value="">Select Department</option>
                            <option value="cardiology">Cardiology</option>
                            <option value="neurology">Neurology</option>
                            <option value="orthopedics">Orthopedics</option>
                            <option value="pediatrics">Pediatrics</option>
                            <option value="general">General Medicine</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="doctor">Preferred Doctor</label>
                        <select id="doctor" name="doctor">
                            <option value="">Any Available Doctor</option>
                            <option value="dr_smith">Dr. John Smith</option>
                            <option value="dr_johnson">Dr. Sarah Johnson</option>
                            <option value="dr_brown">Dr. Michael Brown</option>
                            <option value="dr_davis">Dr. Emily Davis</option>
                        </select>
                    </div>
                </div>
                
                <div class="form-group">
                    <label for="message">Additional Message</label>
                    <textarea id="message" name="message" placeholder="Please describe your symptoms or reason for visit..."></textarea>
                </div>
                
                <button type="submit" class="submit-btn">Book Appointment</button>
            </form>
        </div>
    </div>
</div>
@endsection
