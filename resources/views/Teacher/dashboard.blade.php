@extends('layouts.app_tech')

@section('title', 'Teacher Dashboard')

@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
<style>
.argon-root { display: flex; min-height: 100vh; background: #f8f9fb; }
.argon-sidebar { width: 250px; background: #fff; border-right: 1px solid #e0e0e0; display: flex; flex-direction: column; min-height: 100vh; }
.argon-sidebar .sidebar-title { font-size: 1.6rem; font-weight: 700; color: #7f63f6; margin: 32px 0 32px 0; padding-left: 32px; letter-spacing: 0.5px; display: flex; align-items: center; gap: 8px; }
.argon-sidebar nav { flex: 1; }
.argon-sidebar ul { list-style: none; padding: 0; margin: 0; }
.argon-sidebar li { margin-bottom: 6px; }
.argon-sidebar a { display: flex; align-items: center; color: #7b809a; text-decoration: none; padding: 12px 32px; border-radius: 10px; font-size: 1.08rem; gap: 14px; transition: background 0.2s, color 0.2s; cursor: pointer; }
.argon-sidebar a.active, .argon-sidebar a:hover { background: #f6f9fe; color: #7f63f6; }
.argon-sidebar .sidebar-docs { margin-top: auto; padding: 18px 16px; color: #7b809a; font-size: 0.98rem; border-top: 1px solid #e0e0e0; }
.argon-sidebar .sidebar-docs strong { color: #22223b; }
.argon-main { flex: 1; display: flex; flex-direction: column; min-width: 0; background: #f8f9fb; }
.argon-topbar { background: #7f63f6; padding: 32px 40px 0 40px; display: flex; align-items: center; justify-content: space-between; border-bottom-left-radius: 32px; }
.argon-searchbar { display: flex; align-items: center; background: #fff; border-radius: 32px; padding: 8px 24px; box-shadow: 0 2px 8px rgba(127,99,246,0.06); min-width: 340px; font-size: 1.1rem; gap: 12px; }
.argon-searchbar input { border: none; outline: none; background: transparent; font-size: 1.1rem; width: 100%; }
.argon-topbar-profile { display: flex; align-items: center; gap: 18px; }
.argon-topbar-profile .profile-img { width: 40px; height: 40px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; }
.argon-topbar-profile .profile-bell { color: #fff; font-size: 1.2rem; background: #7f63f6; border-radius: 50%; padding: 7px; }
.argon-content { flex: 1; padding: 32px 40px 40px 40px; background: #f8f9fb; }
.argon-breadcrumb { color: #bfc9e0; font-size: 1.05rem; margin-bottom: 18px; display: flex; align-items: center; gap: 8px; }
.argon-breadcrumb .active { color: #22223b; font-weight: 700; }
.section-title { font-size: 1.3rem; font-weight: 700; color: #7f63f6; margin-bottom: 18px; }
/* Profile */
.teacher-profile-avatar { width: 90px; height: 90px; border-radius: 50%; object-fit: cover; border: 3px solid #e0e0e0; margin-bottom: 16px; }
.teacher-profile-name { font-size: 1.2rem; font-weight: 600; margin-bottom: 4px; }
.teacher-profile-role { color: #7f63f6; font-size: 1rem; margin-bottom: 16px; }
.profile-stats { display: flex; gap: 24px; margin-bottom: 16px; }
.profile-stat { text-align: center; }
.profile-stat .stat-value { font-weight: 700; font-size: 1.1rem; }
.profile-stat .stat-label { color: #888; font-size: 0.95rem; }
/* Subjects */
.subjects-list { display: flex; flex-wrap: wrap; gap: 16px; }
.subject-card { background: #f8f9fb; border-radius: 8px; padding: 12px 16px; min-width: 140px; flex: 1 1 140px; display: flex; flex-direction: column; align-items: flex-start; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
.subject-card .subject-title { font-weight: 600; font-size: 1rem; margin-bottom: 2px; }
.subject-card .subject-class { color: #7f63f6; font-size: 0.95rem; margin-bottom: 4px; }
.subject-card .subject-actions { margin-top: 4px; display: flex; gap: 4px; }
.subject-card .btn-action { background: #7f63f6; color: #fff; border: none; border-radius: 6px; padding: 2px 8px; font-size: 0.95rem; cursor: pointer; transition: background 0.2s; }
.subject-card .btn-action.edit { background: #fb6340; }
.subject-card .btn-action.delete { background: #f5365c; }
.subject-card .btn-action.view { background: #11cdef; }
.subjects-add-btn { background: #2dce89; color: #fff; border: none; border-radius: 8px; padding: 6px 14px; font-weight: 600; margin-bottom: 8px; cursor: pointer; transition: background 0.2s; }
.subjects-add-btn:hover { background: #24b97a; }
/* Grades */
.grades-table { width: 100%; border-collapse: separate; border-spacing: 0; margin-bottom: 8px; }
.grades-table th, .grades-table td { padding: 8px 6px; text-align: left; border-bottom: 1px solid #e0e0e0; }
.grades-table th { background: #f8f9fb; font-weight: 600; }
.grades-table input[type='number'] { width: 50px; border-radius: 6px; border: 1px solid #e0e0e0; padding: 2px 6px; }
.btn-save-grades { background: #7f63f6; color: #fff; border: none; border-radius: 8px; padding: 6px 14px; font-weight: 600; margin-top: 6px; cursor: pointer; transition: background 0.2s; }
.btn-save-grades:hover { background: #5a47c2; }
/* Inbox */
.inbox-list { display: flex; flex-direction: column; gap: 8px; }
.inbox-item { background: #f8f9fb; border-radius: 8px; padding: 8px 10px; display: flex; align-items: flex-start; gap: 10px; box-shadow: 0 1px 4px rgba(0,0,0,0.04); }
.inbox-item.unread { border-right: 4px solid #7f63f6; }
.inbox-avatar { width: 36px; height: 36px; border-radius: 50%; object-fit: cover; }
.inbox-content { flex: 1; }
.inbox-header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 2px; }
.inbox-sender { font-weight: 600; }
.inbox-time { color: #888; font-size: 0.92rem; }
.inbox-message { color: #333; font-size: 0.98rem; }
.inbox-reply-btn { background: #7f63f6; color: #fff; border: none; border-radius: 6px; padding: 2px 10px; font-size: 0.95rem; cursor: pointer; transition: background 0.2s; }
.inbox-reply-btn:hover { background: #5a47c2; }
@media (max-width: 991px) {
  .argon-content, .argon-topbar { padding-left: 16px; padding-right: 16px; }
  .argon-sidebar { position: fixed; left: -260px; top: 0; z-index: 1002; height: 100vh; transition: left 0.3s; box-shadow: 2px 0 12px rgba(44,62,80,0.08); }
  .argon-sidebar.open { left: 0; }
  .argon-root { flex-direction: column; }
  .argon-main { width: 100%; }
  .argon-topbar { border-radius: 0; padding: 20px 16px 0 56px; position: relative; }
  .argon-sidebar .sidebar-title { margin: 24px 0 24px 0; padding-left: 20px; font-size: 1.2rem; }
}
@media (max-width: 600px) {
  .argon-content { padding: 12px 4px 24px 4px; }
  .argon-topbar { padding: 12px 4px 0 44px; }
  .section-title, h2, h3 { font-size: 1.1rem !important; }
  .grades-table th, .grades-table td { font-size: 0.95rem; }
  .profile-stat .stat-value { font-size: 1rem; }
  .profile-stat .stat-label { font-size: 0.85rem; }
  .subjects-list, .inbox-list { gap: 8px; }
  .subject-card, .inbox-item { padding: 8px 6px; min-width: 120px; }
  .btn-action, .subjects-add-btn, .btn-save-grades, .inbox-reply-btn { font-size: 0.9rem; padding: 4px 8px; }
}
/* Hamburger button */
.argon-hamburger { display: none; position: absolute; left: 16px; top: 32px; z-index: 1100; background: #fff; border: none; border-radius: 6px; width: 38px; height: 38px; box-shadow: 0 2px 8px rgba(44,62,80,0.08); align-items: center; justify-content: center; cursor: pointer; }
.argon-hamburger span { display: block; width: 22px; height: 3px; background: #7f63f6; margin: 4px 0; border-radius: 2px; transition: 0.2s; }
@media (max-width: 991px) {
  .argon-hamburger { display: flex; }
}
</style>
<div class="argon-root">
  <!-- Hamburger Button -->
  <button class="argon-hamburger" onclick="toggleSidebar()" aria-label="Open sidebar">
    <span></span><span></span><span></span>
  </button>
  <!-- Sidebar -->
  <aside class="argon-sidebar" id="argonSidebar">
    <div class="sidebar-title"><i class="fas fa-atom"></i> argon</div>
    <nav>
      <ul>
        <li><a href="#dashboard" class="active" onclick="showSection(event, 'dashboard')"><i class="fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li><a href="#profile" onclick="showSection(event, 'profile')"><i class="fas fa-user"></i> Profile</a></li>
        <li><a href="#subjects" onclick="showSection(event, 'subjects')"><i class="fas fa-book"></i> Subjects</a></li>
        <li><a href="#grades" onclick="showSection(event, 'grades')"><i class="fas fa-clipboard-list"></i> Grades</a></li>
        <li><a href="#complaints" onclick="showSection(event, 'complaints')"><i class="fas fa-inbox"></i> Complaints</a></li>
      </ul>
    </nav>
    <div class="sidebar-docs">
      <strong>DOCUMENTATION</strong><br>
      Upgrade to PRO
    </div>
  </aside>
  <!-- Main -->
  <div class="argon-main">
    <!-- Topbar -->
    <div class="argon-topbar">
      <div class="argon-searchbar">
        <i class="fas fa-search"></i>
        <input type="text" placeholder="Search">
      </div>
      <div class="argon-topbar-profile">
        <i class="fas fa-bell profile-bell"></i>
        <img src="https://randomuser.me/api/portraits/men/32.jpg" class="profile-img" alt="Profile">
        <span style="color:#fff;font-weight:600;">Mr. John Doe</span>
      </div>
    </div>
    <div class="argon-content">
      <div class="argon-breadcrumb">
        <span><i class="fas fa-home"></i></span> / Teacher Dashboard
      </div>
      <!-- Dashboard Home Section -->
      <div id="dashboard-section" class="section-page">
        <div style="background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%); border-radius: 18px; padding: 36px 32px 36px 32px; color: #fff; margin-bottom: 32px; overflow: hidden;">
          <h2 style="font-size:2.3rem;font-weight:700;margin-bottom:8px;">Welcome back, John!</h2>
          <div style="font-size:1.15rem;opacity:0.95;max-width:420px;">Here is an overview of your teaching activity and quick stats.</div>
        </div>
        <div style="display:flex;gap:32px;flex-wrap:wrap;margin-bottom:32px;">
          <div style="flex:1 1 220px;min-width:220px;background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(44,62,80,0.06);padding:28px 24px;display:flex;align-items:center;gap:18px;">
            <div style="background:#5e72e4;color:#fff;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;"><i class="fas fa-book"></i></div>
            <div>
              <div style="font-size:1.5rem;font-weight:700;">5</div>
              <div style="color:#8898aa;font-size:1.05rem;">Subjects</div>
            </div>
          </div>
          <div style="flex:1 1 220px;min-width:220px;background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(44,62,80,0.06);padding:28px 24px;display:flex;align-items:center;gap:18px;">
            <div style="background:#2dce89;color:#fff;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;"><i class="fas fa-users"></i></div>
            <div>
              <div style="font-size:1.5rem;font-weight:700;">120</div>
              <div style="color:#8898aa;font-size:1.05rem;">Students</div>
            </div>
          </div>
          <div style="flex:1 1 220px;min-width:220px;background:#fff;border-radius:14px;box-shadow:0 2px 16px rgba(44,62,80,0.06);padding:28px 24px;display:flex;align-items:center;gap:18px;">
            <div style="background:#f5365c;color:#fff;border-radius:50%;width:48px;height:48px;display:flex;align-items:center;justify-content:center;font-size:1.6rem;"><i class="fas fa-inbox"></i></div>
            <div>
              <div style="font-size:1.5rem;font-weight:700;">8</div>
              <div style="color:#8898aa;font-size:1.05rem;">Messages</div>
            </div>
          </div>
        </div>
        <div style="background:#fff;border-radius:16px;padding:32px 24px 24px 24px;box-shadow:0 2px 16px rgba(44,62,80,0.06);max-width:900px;margin:auto;">
          <h3 style="font-size:1.3rem;font-weight:700;color:#5e72e4;margin-bottom:18px;">Quick Actions</h3>
          <div style="display:flex;gap:24px;flex-wrap:wrap;">
            <a href="#subjects" onclick="showSection(event, 'subjects')" style="flex:1 1 180px;min-width:180px;background:#5e72e4;color:#fff;border-radius:10px;padding:18px 0;text-align:center;font-weight:600;font-size:1.08rem;text-decoration:none;transition:background 0.2s;">Manage Subjects</a>
            <a href="#grades" onclick="showSection(event, 'grades')" style="flex:1 1 180px;min-width:180px;background:#2dce89;color:#fff;border-radius:10px;padding:18px 0;text-align:center;font-weight:600;font-size:1.08rem;text-decoration:none;transition:background 0.2s;">Enter Grades</a>
            <a href="#complaints" onclick="showSection(event, 'complaints')" style="flex:1 1 180px;min-width:180px;background:#f5365c;color:#fff;border-radius:10px;padding:18px 0;text-align:center;font-weight:600;font-size:1.08rem;text-decoration:none;transition:background 0.2s;">View Inbox</a>
          </div>
        </div>
      </div>
      <!-- Profile Section -->
      <div id="profile-section" class="section-page">
        <!-- Argon Profile Header -->
        <div style="background: linear-gradient(87deg, #5e72e4 0, #825ee4 100%); border-radius: 18px; padding: 36px 32px 60px 32px; color: #fff; position: relative; margin-bottom: 32px; overflow: hidden;">
          <div style="display: flex; align-items: center; justify-content: space-between;">
            <div>
              <h2 style="font-size:2.3rem;font-weight:700;margin-bottom:8px;">Hello John</h2>
              <div style="font-size:1.15rem;opacity:0.95;max-width:420px;">This is your profile page. You can see the progress you've made with your work and manage your projects or assigned tasks</div>
            </div>
            <button style="background:#fff;color:#5e72e4;font-weight:600;padding:10px 24px;border-radius:8px;border:none;font-size:1.08rem;box-shadow:0 2px 8px rgba(94,114,228,0.12);cursor:pointer;transition:background 0.2s;">Edit profile</button>
          </div>
          <button style="position:absolute;top:24px;right:24px;background:#7f63f6;color:#fff;font-weight:600;padding:7px 18px;border-radius:7px;border:none;font-size:1rem;box-shadow:0 2px 8px rgba(127,99,246,0.12);cursor:pointer;">Settings</button>
        </div>
        <!-- Argon Profile Form -->
        <div style="background:#fff;border-radius:16px;padding:32px 24px 24px 24px;box-shadow:0 2px 16px rgba(44,62,80,0.06);max-width:900px;margin:auto;">
          <h3 style="font-size:1.3rem;font-weight:700;color:#5e72e4;margin-bottom:18px;">Edit profile</h3>
          <form>
            <div style="display:flex;flex-wrap:wrap;gap:24px 32px;">
              <div style="flex:1 1 220px;min-width:220px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Username</label>
                <input type="text" value="john.doe" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 220px;min-width:220px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Email address</label>
                <input type="email" value="john@example.com" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 220px;min-width:220px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">First name</label>
                <input type="text" value="John" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 220px;min-width:220px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Last name</label>
                <input type="text" value="Doe" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
            </div>
            <hr style="margin:24px 0;">
            <div style="color:#8898aa;font-size:1.05rem;font-weight:600;margin-bottom:12px;">Contact Information</div>
            <div style="display:flex;flex-wrap:wrap;gap:24px 32px;">
              <div style="flex:2 1 340px;min-width:220px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Address</label>
                <input type="text" value="123 Main St, City Center" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 120px;min-width:120px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">City</label>
                <input type="text" value="New York" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 120px;min-width:120px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Country</label>
                <input type="text" value="USA" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
              <div style="flex:1 1 120px;min-width:120px;">
                <label style="color:#8898aa;font-size:0.98rem;font-weight:600;">Postal code</label>
                <input type="text" value="10001" style="width:100%;padding:8px 12px;border-radius:8px;border:1px solid #e0e0e0;margin-bottom:14px;">
              </div>
            </div>
          </form>
        </div>
      </div>
      <!-- Subjects Section -->
      <div id="subjects-section" class="section-page" style="display:none;">
        <div class="section-title">Subjects Management</div>
        <button class="subjects-add-btn">+ Add Subject</button>
        <div class="subjects-list">
          <div class="subject-card">
            <div class="subject-title">Mathematics</div>
            <div class="subject-class">Grade 10</div>
            <div class="subject-actions">
              <button class="btn-action view">View</button>
              <button class="btn-action edit">Edit</button>
              <button class="btn-action delete">Delete</button>
            </div>
          </div>
          <div class="subject-card">
            <div class="subject-title">Physics</div>
            <div class="subject-class">Grade 11</div>
            <div class="subject-actions">
              <button class="btn-action view">View</button>
              <button class="btn-action edit">Edit</button>
              <button class="btn-action delete">Delete</button>
            </div>
          </div>
          <!-- More subject cards ... -->
        </div>
      </div>
      <!-- Grades Section -->
      <div id="grades-section" class="section-page" style="display:none;">
        <div class="section-title">Enter Grades</div>
        <table class="grades-table">
          <thead>
            <tr>
              <th>Student Name</th>
              <th>Mathematics</th>
              <th>Physics</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Jane Smith</td>
              <td><input type="number" min="0" max="100" value="85"></td>
              <td><input type="number" min="0" max="100" value="90"></td>
              <td>175</td>
            </tr>
            <tr>
              <td>Michael Brown</td>
              <td><input type="number" min="0" max="100" value="78"></td>
              <td><input type="number" min="0" max="100" value="88"></td>
              <td>166</td>
            </tr>
            <!-- More students ... -->
          </tbody>
        </table>
        <button class="btn-save-grades">Save Grades</button>
      </div>
      <!-- Complaints Section -->
      <div id="complaints-section" class="section-page" style="display:none;">
        <div class="section-title">Instructions & Complaints Inbox</div>
        <div class="inbox-list">
          <div class="inbox-item unread">
            <img src="https://randomuser.me/api/portraits/women/44.jpg" class="inbox-avatar" alt="Student">
            <div class="inbox-content">
              <div class="inbox-header">
                <span class="inbox-sender">Jane Smith</span>
                <span class="inbox-time">2 hours ago</span>
              </div>
              <div class="inbox-message">I have a question about the last math lesson.</div>
            </div>
            <button class="inbox-reply-btn">Reply</button>
          </div>
          <div class="inbox-item">
            <img src="https://randomuser.me/api/portraits/men/45.jpg" class="inbox-avatar" alt="Student">
            <div class="inbox-content">
              <div class="inbox-header">
                <span class="inbox-sender">Michael Brown</span>
                <span class="inbox-time">Yesterday</span>
              </div>
              <div class="inbox-message">Can you explain the homework for physics?</div>
            </div>
            <button class="inbox-reply-btn">Reply</button>
          </div>
          <!-- More inbox items ... -->
        </div>
      </div>
    </div>
  </div>
</div>
<script>
function showSection(e, section) {
  e.preventDefault();
  document.querySelectorAll('.section-page').forEach(el => el.style.display = 'none');
  document.querySelectorAll('.argon-sidebar a').forEach(a => a.classList.remove('active'));
  document.getElementById(section+'-section').style.display = '';
  e.currentTarget.classList.add('active');
  // Close sidebar on mobile after navigation
  if(window.innerWidth <= 991) document.getElementById('argonSidebar').classList.remove('open');
}
function toggleSidebar() {
  document.getElementById('argonSidebar').classList.toggle('open');
}
// Default: show dashboard
showSection({preventDefault:()=>{},currentTarget:document.querySelector('.argon-sidebar a')}, 'dashboard');
</script>
@endsection
