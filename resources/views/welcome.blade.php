@extends('frontend.layout.masterlayout')

@section('<meta name="viewport" content="width=device-width, initial-scale=1.0">')
@section('title', 'Chiropractic Care')

@section('styles')
<style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background-color: #e0f2f7; 
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: space-around;
            width: 90%; 
            max-width: 1200px; 
            padding: 40px 20px;
        }

        .content-left {
            flex: 1;
            max-width: 500px;
            text-align: left;
            padding-right: 40px; 
        }

        .heading-blue {
            color: #2c8c99; 
            font-size: 3.5em; 
            margin-bottom: 0.1em;
            font-weight: bold;
            letter-spacing: 0.05em;
        }

        .heading-dark {
            color: #333; 
            font-size: 3em; 
            margin-top: 0;
            margin-bottom: 0.5em;
            font-weight: bold;
            letter-spacing: 0.03em;
        }

        .description {
            color: #555;
            font-size: 1.1em;
            line-height: 1.6;
            margin-bottom: 2em;
        }

        .btn {
            display: inline-block;
            background-color: #5abcb8; 
            color: white;
            padding: 15px 30px;
            border-radius: 5px;
            text-decoration: none;
            font-size: 1em;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #4a9e99; 
        }

        .content-right {
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .circle-outer {
            width: 300px; 
            height: 300px;
            border-radius: 50%;
            border: 15px solid #5abcb8; 
            display: flex;
            justify-content: center;
            align-items: center;
            position: relative;
            overflow: hidden; 
        }

        .circle-inner {
            width: 90%; 
            height: 90%;
            background-color: #2c8c99; 
            border-radius: 50%;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        @media (max-width: 992px) {
            .heading-blue {
                font-size: 2.8em;
            }
            .heading-dark {
                font-size: 2.4em;
            }
            .circle-outer {
                width: 250px;
                height: 250px;
                border-width: 12px;
            }
        }

        @media (max-width: 768px) {
            .container {
                flex-direction: column;
                text-align: center;
                padding: 20px;
            }
            .content-left {
                padding-right: 0;
                margin-bottom: 40px;
            }
            .btn {
                margin-top: 20px;
            }
            .circle-outer {
                width: 200px;
                height: 200px;
                border-width: 10px;
            }
            .heading-blue {
                font-size: 2.2em;
            }
            .heading-dark {
                font-size: 1.8em;
            }
            .description {
                font-size: 1em;
            }
        }

        @media (max-width: 480px) {
            .heading-blue {
                font-size: 1.8em;
            }
            .heading-dark {
                font-size: 1.5em;
            }
            .btn {
                padding: 12px 25px;
                font-size: 0.9em;
            }
            .circle-outer {
                width: 150px;
                height: 150px;
                border-width: 8px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container">
        <div class="content-left">
            <h1 class="heading-blue">CHIROPRACTIC</h1>
            <h1 class="heading-dark">CARE FOR THE FAMILY</h1>
            <p class="description">Nunc accumsan dui vel lobortis pulvinar. Duis convallis odio ut dignissim faucibus. Sed sit amet urna dictum.</p>
            <a href="{{ route('booking') }}" class="btn">Book An Appointment &rarr;</a>
            <a href="{{ route('home') }}" class="btn">Home</a>
        </div>
        <div class="content-right">
            <div class="circle-outer">
                <div class="circle-inner"></div>
            </div>
        </div>
    </div>
@endsection
