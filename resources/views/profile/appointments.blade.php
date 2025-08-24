<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Appointments</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            margin: 0;
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #fafbfb;
            color: #222;
        }
        .container {
            display: flex;
            min-height: 100vh;
        }
        .sidebar {
            width: 220px;
            min-width: 180px;
            transition: all 0.3s;
        }
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
                padding-top: 0;
            }
            .sidebar {
                width: 100%;
                min-width: 0;
                flex-direction: row;
                flex-wrap: wrap;
                padding: 0;
                border-right: none;
                border-bottom: 1px solid #ececec;
                justify-content: flex-start;
                align-items: center;
                overflow-x: auto;
            }
            .sidebar nav {
                flex-direction: row;
                gap: 2px;
                width: 100%;
                padding: 0 4px;
                overflow-x: auto;
            }
            .sidebar nav a {
                font-size: 14px;
                padding: 8px 6px;
                min-width: 80px;
                text-align: center;
            }
        }
        @media (max-width: 600px) {
            .sidebar nav a {
                font-size: 13px;
                padding: 7px 3px;
            }
        }
            background: #fff;
            border-right: 1px solid #ececec;
            padding: 30px 0;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }
        .logo {
            font-weight: bold;
            font-size: 1.3em;
            display: flex;
            align-items: center;
            letter-spacing: 0.5px;
        }
        .logo-circle {
            width: 32px;
            height: 32px;
            background: #13382e;
            border-radius: 50%;
            margin-right: 10px;
            display: inline-block;
        }
        .sidebar .logo {
            margin-left: 30px;
            margin-bottom: 40px;
        }
        .sidebar nav {
            display: flex;
            flex-direction: column;
            gap: 10px;
            width: 100%;
            padding: 0 12px;
            box-sizing: border-box;
        }
        .sidebar nav a {
            text-decoration: none;
            color: #222;
            display: flex;
            align-items: center;
            font-size: 15px;
            padding: 10px 16px;
            border-radius: 8px;
            transition: background 0.2s, color 0.2s, font-weight 0.2s;
            width: 100%;
            box-sizing: border-box;
        }
        .sidebar nav a.active,
        .sidebar nav a:hover {
            color: #00796b;
            font-weight: bold;
            background: #eaf6f3;
        }
        .sidebar nav a .icon {
            margin-right: 10px;
            font-size: 16px;
        }
        .main {
            flex: 1;
            padding: 40px 40px 0 40px;
        }
        .topbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            height: 60px;
            background: #fff;
            border-bottom: 1px solid #ececec;
            padding: 0 40px;
        }
        .back-btn {
            background: #eaf6f3;
            border: none;
            border-radius: 8px;
            padding: 7px 18px;
            color: #00796b;
            font-size: 15px;
            cursor: pointer;
        }
        .avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e0e0e0;
        }
        .content {
            margin-top: 40px;
        }
        .content h2 {
            margin-bottom: 30px;
            font-size: 1.4em;
            font-weight: 600;
        }
        .appointments-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            background: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.03);
        }
        .appointments-table th,
        .appointments-table td {
            padding: 18px 15px;
            text-align: left;
        }
        .appointments-table th {
            background: #f5f8f7;
            font-weight: 600;
            color: #444;
        }
        .appointments-table tr:not(:last-child) td {
            border-bottom: 1px solid #ececec;
        }
        .appointments-table td {
            color: #444;
            font-size: 15px;
        }
        .status-confirm {
            color: #00796b;
            font-weight: 500;
        }
        @media (max-width: 900px) {
            .container {
                flex-direction: column;
            }
            .sidebar {
                width: 100%;
                border-right: none;
                border-bottom: 1px solid #ececec;
            }
            .main {
                padding: 20px 10px;
            }
            .topbar {
                padding: 0 10px;
            }
        }
    </style>
</head>
<body>
<div class="topbar">
    <div class="logo">
        <div class="logo-circle"></div>
        LOGO
    </div>
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('home') }}" class="back-btn">&larr; Back</a>
        <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="avatar">
    </div>
</div>

<div class="container">
    <aside class="sidebar">
        <nav>
            <a href="{{ route('profile') }}"><span class="icon">👤</span> Profile</a>
            <a href="{{ route('profile.appointments') }}" class="active"><span class="icon">📅</span> Appointments</a>
            <a href="{{ route('profile.favorite') }}"><span class="icon">❤️</span> Favorite Doctor</a>
            <a href="{{ route('profile.service-history') }}"><span class="icon">🕑</span> Service History</a>
        </nav>
    </aside>

    <div class="main">
        <div class="content">
            <h2>Appointments</h2>
            <table class="appointments-table">
                <thead>
                    <tr>
                        <th>Doctor</th>
                        <th>Services</th>
                        <th>Date</th>
                        <th>Time</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00–01:00 pm</td>
                        <td class="status-confirm">Confirm</td>
                    </tr>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00–01:00 pm</td>
                        <td>-</td>
                    </tr>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00–01:00 pm</td>
                        <td class="status-confirm">Confirm</td>
                    </tr>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00–01:00 pm</td>
                        <td class="status-confirm">Confirm</td>
                    </tr>
                    <tr>
                        <td>Dr. Jakir Ali</td>
                        <td>Cupping Therapy</td>
                        <td>12/12/2024</td>
                        <td>12:00–01:00 pm</td>
                        <td class="status-confirm">Confirm</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
