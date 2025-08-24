@extends('frontend.layout.masterlayout')

@section('title', 'Book an Appointment - Hospital Management')

@section('styles')
<style>
    .appointment-container {
        padding: 60px 20px;
        max-width: 1000px;
        margin: 0 auto;
    }
    .appointment-title {
        text-align: center;
        margin-bottom: 40px;
    }
    .appointment-form {
        background: #fff;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 0 20px rgba(0,0,0,0.1);
    }
    /* Responsive styles for appointment page */
    @media (max-width: 900px) {
        .appointment-container {
            padding: 32px 4vw;
            max-width: 98vw;
        }
        .appointment-form {
            padding: 18px;
        }
        .appointment-title {
            font-size: 1.4em;
            margin-bottom: 24px;
        }
    }
    @media (max-width: 600px) {
        .appointment-container {
            padding: 16px 1vw;
        }
        .appointment-form {
            padding: 8px;
            border-radius: 7px;
        }
        .appointment-title {
            font-size: 1.08em;
            margin-bottom: 14px;
        }
        .form-group label {
            font-size: 0.97em;
        }
        .form-control, .btn {
            font-size: 0.98em;
            padding: 8px 7px;
        }
        .btn {
            width: 100%;
        }
    }
</style>
@endsection

@section('content')
    @include('frontend.partials.header')
    
    <div class="appointment-container">
        <h1 class="appointment-title">Book an Appointment</h1>
        <div class="appointment-form">
            <form action="{{ route('booking.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">Full Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="phone">Phone Number</label>
                    <input type="tel" class="form-control" id="phone" name="phone" required>
                </div>
                <div class="form-group">
                    <label for="date">Preferred Date</label>
                    <input type="date" class="form-control" id="date" name="date" required>
                </div>
                <div class="form-group">
                    <label for="department">Department</label>
                    <select class="form-control" id="department" name="department" required>
                        <option value="">Select Department</option>
                        <option value="cardiology">Cardiology</option>
                        <option value="neurology">Neurology</option>
                        <option value="orthopedics">Orthopedics</option>
                        <option value="pediatrics">Pediatrics</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="message">Additional Notes</label>
                    <textarea class="form-control" id="message" name="message" rows="4"></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Book Appointment</button>
            </form>
        </div>
    </div>

    @include('frontend.partials.footer')
@endsection
