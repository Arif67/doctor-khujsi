<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Profile - Dashboard</title>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Roboto', Arial, sans-serif;
      background: #fff;
    }

    .topbar {
      display: flex;
      align-items: center;
      justify-content: space-between;
      background: #fff;
      border-bottom: 1px solid #ececec;
      padding: 0 40px;
      height: 60px;
      position: fixed;
      top: 0;
      left: 0;
      right: 0;
      z-index: 10;
    }

    .topbar .logo {
      display: flex;
      align-items: center;
      font-weight: bold;
      font-size: 1.3em;
    }

    .topbar .logo-circle {
      width: 32px;
      height: 32px;
      background: #13382e;
      border-radius: 50%;
      margin-right: 10px;
    }

    .topbar .avatar {
      width: 40px;
      height: 40px;
      border-radius: 50%;
      object-fit: cover;
      border: 2px solid #fff;
      box-shadow: 0 1px 4px rgba(0,0,0,0.03);
    }

    .container {
      display: block;
      padding-top: 60px; /* offset for fixed topbar */
    }

    .sidebar {
      width: 220px;
      min-width: 180px;
      transition: all 0.3s;
    }
    @media (max-width: 900px) {
      .container {
        flex-direction: column;
        padding-top: 60px;
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
      .topbar {
        padding: 0 10px;
        height: 48px;
      }
      .sidebar {
        padding: 0;
      }
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
      min-height: calc(100vh - 60px);
      position: fixed;
      top: 60px;
      left: 0;
      bottom: 0;
      overflow-y: auto;
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
      margin-left: 220px; /* match sidebar width */
      padding: 80px 24px 24px 24px;
      background: #fff;
      min-height: calc(100vh - 60px);
    }

    .profile-title {
      font-size: 24px;
      font-weight: 500;
      margin-bottom: 28px;
      color: #183d3d;
    }

    .profile-card {
      background: #fff;
      border: 1px solid #289ca7;
      border-radius: 14px;
      box-shadow: 0 2px 10px rgba(40, 156, 167, 0.04);
      max-width: 400px;
      padding: 20px 28px 32px 28px;
    }

    .profile-card .card-header {
      font-size: 16px;
      font-weight: 500;
      margin-bottom: 18px;
      color: #183d3d;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .profile-card .edit-btn {
      background: #289ca7;
      color: #fff;
      border: none;
      border-radius: 7px;
      padding: 6px 26px;
      font-size: 15px;
      cursor: pointer;
      transition: background 0.2s;
      font-weight: 400;
    }

    .profile-card .edit-btn:hover {
      background: #183d3d;
    }

    .profile-card label {
      font-size: 14px;
      color: #183d3d;
      margin-bottom: 7px;
      display: block;
      margin-top: 10px;
    }

    .profile-card input[type="text"],
    .profile-card input[type="email"] {
      width: 100%;
      padding: 8px 12px;
      font-size: 15px;
      border: 1px solid #289ca7;
      border-radius: 7px;
      margin-bottom: 10px;
      outline: none;
      background: #f8fafa;
      transition: border 0.2s;
    }

    .profile-card input[type="text"]:focus,
    .profile-card input[type="email"]:focus {
      border: 1.5px solid #183d3d;
    }

    .profile-card .row {
      display: flex;
      gap: 32px;
    }

    .profile-card .row > div {
      flex: 1;
    }

    @media (max-width: 800px) {
      .sidebar {
        position: static;
        width: 100%;
        border-right: none;
        border-bottom: 1px solid #ececec;
        flex-direction: row;
        align-items: center;
        justify-content: space-around;
        padding: 10px 0;
      }

      .main {
        margin-left: 0;
        padding: 100px 16px 16px 16px;
      }

      .profile-card {
        max-width: 100%;
      }
    }
  </style>
</head>
<body>
  <!-- Topbar -->
  <div class="topbar">
    <div class="logo">
      <div class="logo-circle"></div>
      LOGO
    </div>
    <div style="display: flex; align-items: center; gap: 16px;">
        <a href="{{ route('home') }}" class="back-btn" style="background: #eaf6f3; border: none; border-radius: 8px; padding: 7px 18px; color: #00796b; font-size: 15px; cursor: pointer;">&larr; Back</a>
      <img src="https://randomuser.me/api/portraits/women/44.jpg" alt="Avatar" class="avatar" />
    </div>
  </div>

  <div class="container">
    <!-- Sidebar -->
    <aside class="sidebar">
      <nav>
        <a href="{{ route('profile') }}" class="active"><span class="icon">👤</span> Profile</a>
        <a href="{{ route('profile.appointments') }}"><span class="icon">📅</span> Appointments</a>
        <a href="{{ route('profile.favorite') }}"><span class="icon">❤️</span> Favorite Doctor</a>
        <a href="{{ route('profile.service-history') }}"><span class="icon">🕑</span> Service History</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main">
      <div class="profile-title">My Profile</div>
      @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

      <div class="profile-card">
        <div class="card-header">
          <span>Details</span>
          <button id="editToggleBtn" class="edit-btn">Edit</button>
        </div>
        <form id="profileForm" action="{{ route('profile.update') }}" method="POST" style="display: none;">
            @csrf
            @method('PATCH')
          <div class="form-group">
              <label for="name">Your Name</label>
              <input type="text" id="name" name="name" value="{{ Auth::user()->name }}" class="form-control" readonly>
          </div>
          <div class="form-group">
              <label for="email">Email</label>
              <input type="email" id="email" name="email" value="{{ Auth::user()->email }}" class="form-control" readonly>
          </div>
          <div class="row">
            <div>
              <div class="form-group">
                  <label for="phone">Mobile No</label>
                  <input type="text" id="phone" name="phone" value="{{ Auth::user()->phone }}" class="form-control" readonly>
              </div>
            </div>
            <div>
              <div class="form-group">
                  <label for="date_of_birth">Date of Birth</label>
                  <input type="date" id="date_of_birth" name="date_of_birth" value="{{ Auth::user()->date_of_birth }}" class="form-control" readonly>
              </div>
            </div>
          </div>
          <div class="form-actions" style="display: none; margin-top: 20px; display: flex; gap: 10px;">
              <button type="submit" class="save-btn" style="flex: 1; background: #4CAF50; color: white; border: none; border-radius: 8px; padding: 10px; cursor: pointer;">
                  Save Changes
              </button>
              <button type="button" class="cancel-btn" style="flex: 1; background: #f44336; color: white; border: none; border-radius: 8px; padding: 10px; cursor: pointer;">
                  Cancel
              </button>
          </div>
        </form>

        <div id="viewMode" class="profile-details">
            <div class="detail-item">
                <span class="detail-label">Your Name</span>
                <span class="detail-value">{{ Auth::user()->name ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Email</span>
                <span class="detail-value">{{ Auth::user()->email ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Mobile No</span>
                <span class="detail-value">{{ Auth::user()->phone ?? 'N/A' }}</span>
            </div>
            <div class="detail-item">
                <span class="detail-label">Date of Birth</span>
                <span class="detail-value">{{ Auth::user()->date_of_birth ? \Carbon\Carbon::parse(Auth::user()->date_of_birth)->format('d/m/Y') : 'N/A' }}</span>
            </div>
            <form method="POST" action="{{ route('logout') }}" style="margin-top: 20px;">
                @csrf
                <button type="submit" style="background: #ff4444; color: white; border: none; border-radius: 8px; padding: 10px 20px; width: 100%; cursor: pointer; display: flex; align-items: center; justify-content: center; gap: 8px; font-size: 15px;">
                    <span class="icon"></span> Logout
                </button>
            </form>
        </div>
        </form>
      </div>
    </main>
  </div>
<style>
    .form-group {
        margin-bottom: 15px;
    }
    .form-control {
        width: 100%;
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }
    .form-actions {
        margin-top: 20px;
        display: flex;
        gap: 10px;
    }
    .save-btn {
        flex: 1;
        background: #4CAF50;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px;
        cursor: pointer;
    }
    .cancel-btn {
        flex: 1;
        background: #f44336;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 10px;
        cursor: pointer;
    }
    .alert {
        padding: 15px;
        background-color: #4CAF50;
        color: white;
        margin-bottom: 15px;
        border-radius: 4px;
    }
    .value {
        padding: 8px 0;
    }
    .profile-details {
        background: #fff;
        border-radius: 8px;
        padding: 0;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }
    .detail-item {
        display: flex;
        padding: 16px 20px;
        border-bottom: 1px solid #f0f0f0;
    }
    .detail-item:last-child {
        border-bottom: none;
    }
    .detail-label {
        width: 120px;
        color: #666;
        font-size: 14px;
    }
    .detail-value {
        flex: 1;
        color: #333;
        font-size: 14px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editToggleBtn = document.getElementById('editToggleBtn');
        const profileForm = document.getElementById('profileForm');
        const viewMode = document.getElementById('viewMode');
        const cancelBtn = document.querySelector('.cancel-btn');
        
        editToggleBtn.addEventListener('click', function() {
            // Toggle between view and edit modes
            profileForm.style.display = 'block';
            viewMode.style.display = 'none';
            this.style.display = 'none';
            
            // Make all inputs editable
            const inputs = profileForm.querySelectorAll('input');
            inputs.forEach(input => {
                input.readOnly = false;
            });
        });
        
        cancelBtn.addEventListener('click', function() {
            // Switch back to view mode
            profileForm.style.display = 'none';
            viewMode.style.display = 'block';
            editToggleBtn.style.display = 'block';
            
            // Reset form values
            profileForm.reset();
        });
    });
</script>
</body>
</html>
