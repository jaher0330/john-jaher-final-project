@extends('layouts.app')
@section('title', 'About | Lost & Found System')

@section('content')
<div class="container">
  <div class="about-card">

    <h3>ℹ️ About This System</h3>
    <p>
      The <strong>Lost & Found System</strong> is a web-based application designed to help
      students and staff report, track, and manage lost and found items within the campus.
      It allows users to easily document items, update their status, and identify ownership.
    </p>

    <hr style="margin:24px 0;">

    <h6 class="fw-bold text-uppercase mb-3" style="color:#aaa; letter-spacing:1px; font-size:0.78rem;">Project Details</h6>
    <div>
      <div class="info-row">
        <span class="info-label">Project Title</span>
        <span class="info-value">Lost & Found System</span>
      </div>
      <div class="info-row">
        <span class="info-label">Technology</span>
        <span class="info-value">Laravel + Bootstrap 5</span>
      </div>
      <div class="info-row">
        <span class="info-label">CRUD Transaction</span>
        <span class="info-value">Lost/Found Item Records</span>
      </div>
      <div class="info-row">
        <span class="info-label">Developer</span>
       <span class="info-value">John Jaher S. Mokasim</span>
      </div>
      <div class="info-row">
        <span class="info-label">Authentication</span>
        <span class="info-value">Laravel Breeze</span>
      </div>
      <div class="info-row">
        <span class="info-label">Access Control</span>
        <span class="info-value">Role-Based (Admin / User)</span>
      </div>
    </div>

    <hr style="margin:24px 0;">

    <h6 class="fw-bold text-uppercase mb-3" style="color:#aaa; letter-spacing:1px; font-size:0.78rem;">System Features</h6>
    <ul class="feature-list list-unstyled">
      <li>Report lost or found items</li>
      <li>View all item records with search and filter</li>
      <li>Edit and update item information</li>
      <li>Delete records from the system</li>
      <li>Status tracking: Pending, Claimed, Resolved</li>
      <li>Login and Registration via Laravel Breeze</li>
      <li>Role-Based Access Control (Admin / User)</li>
      <li>Responsive design for mobile and desktop</li>
      <li>Navbar with active link highlighting</li>
    </ul>

    <div class="text-center mt-4">
      <a href="{{ url('/') }}" class="btn btn-danger px-4">← Back to Home</a>
    </div>

  </div>
</div>
@endsection
