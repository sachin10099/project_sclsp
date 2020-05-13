@extends('front.formfiller_dashboard')
@section('content')
      <!-- End Navbar -->
      @if(session()->has('success'))
        <div class="alert alert-success" id="hideAlert" style="margin-top: 50px;">
            {{ session()->get('success') }}
        </div>
      @endif
      <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-success card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-arrow-right" aria-hidden="true"></i>
                  </div>
                  <p class="card-category">Total Pending Jobs</p>
                  <h3 class="card-title">{{ $data['pending_job_count'] }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/user/jobs-view') }}">View More...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-warning card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-star" aria-hidden="true"></i>
                  </div>
                  <p class="card-category">Total Under Processing Jobs</p>
                  <h3 class="card-title">{{ $data['ongoing_job_count'] }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/user/jobs-view') }}/past">View More...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-info card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-clock-o" aria-hidden="true"></i>
                  </div>
                  <p class="card-category">Total Completed Jobs</p>
                  <h3 class="card-title">{{ $data['completed_job_count'] }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/user/jobs-view') }}">View More...</a>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6">
              <div class="card card-stats">
                <div class="card-header card-header-danger card-header-icon">
                  <div class="card-icon">
                    <i class="fa fa-ban" aria-hidden="true"></i>
                  </div>
                  <p class="card-category">Total Rejected Jobs</p>
                  <h3 class="card-title">{{ $data['reject_job_count'] }}</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/user/jobs-view') }}">View More...</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-success" style="background: linear-gradient(30deg, blue, gray);color: white;">
                  <h3>Admissions</h3>
                </div>
                <div class="card-body">
                  @foreach($data['admissions'] as $admission)
                    <a href="{{ url('form-filler/job/profile/') }}/{{ $admission->id }}"><p>* {{ $admission->job_title }}</p>
                  @endforeach
                </div>
                <div class="card-footer">
                  <a href="{{ url('form-filler/admissions') }}">View All</a>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="card card-chart">
                <div class="card-header card-header-warning" style="background: linear-gradient(30deg, brown, gray);">
                  <h3>Important Notice</h3>
                </div>
                <div class="card-body">
                  <table class="table">
                      <thead>
                        <tr>
                          <th>Firstname</th>
                          <th>Lastname</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>John</td>
                          <td>Doe</td>
                          <td>john@example.com</td>
                        </tr>
                        <tr>
                          <td>Mary</td>
                          <td>Moe</td>
                          <td>mary@example.com</td>
                        </tr>
                        <tr>
                          <td>July</td>
                          <td>Dooley</td>
                          <td>july@example.com</td>
                        </tr>
                      </tbody>
                    </table>
                </div>
                <div class="card-footer">
                  <a href="#">View All</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection