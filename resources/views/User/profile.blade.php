@extends('layouts.app')

@section('title', 'Profile Settings')

@section('hero')
<div class="untree_co-hero overlay" style="background-image: url('{{ asset('images/img-school-3-min.jpg') }}');">
    <div class="container">
        <div class="row align-items-center justify-content-center">
            <div class="col-12 text-center">
                <h1 class="mb-4 heading text-white" data-aos="fade-up" data-aos-delay="100">Profile Settings</h1>
                <div class="mb-5 text-white desc mx-auto" data-aos="fade-up" data-aos-delay="200">
                    <p>Manage your profile information, security, notifications, and more.</p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('content')
<div class="container mt-5">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="main-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="#">User</a></li>
            <li class="breadcrumb-item active" aria-current="page">Profile Settings</li>
        </ol>
    </nav>

    <div class="row gutters-sm">
        <div class="col-md-4 d-none d-md-block">
            <div class="card">
                <div class="card-body">
                    <nav class="nav flex-column nav-pills">
                        <a href="#profile" data-toggle="tab" class="nav-item nav-link active">Profile Information</a>
                        <a href="#account" data-toggle="tab" class="nav-item nav-link">Account Settings</a>
                        <a href="#security" data-toggle="tab" class="nav-item nav-link">Security</a>
                        <a href="#notification" data-toggle="tab" class="nav-item nav-link">Notification</a>
                        <a href="#billing" data-toggle="tab" class="nav-item nav-link">Billing</a>
                    </nav>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-body tab-content">
                    {{-- Profile Information Tab --}}
                    <div class="tab-pane fade show active" id="profile">
                      @include('profile_parts/profile-info')
                    </div>

                    {{-- Account Settings Tab --}}
                    <div class="tab-pane fade" id="account">
                      @include('profile_parts/account-settings')

                    </div>

                    {{-- Security Tab --}}
                    <div class="tab-pane fade" id="security">
                        {{-- @include('profile.partials.security-settings') --}}
                    </div>

                    {{-- Notification Settings Tab --}}
                    <div class="tab-pane fade" id="notification">
                        {{-- @include('profile.partials.notification-settings') --}}
                    </div>

                    {{-- Billing Settings Tab --}}
                    <div class="tab-pane fade" id="billing">
                        {{-- @include('profile.partials.billing-settings') --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection