@extends('front.formfiller_dashboard')
@section('content')
      <!-- End Navbar -->
      @if(session()->has('success'))
        <div class="alert alert-success" id="" style="margin-top: 50px;">
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
                  <p class="card-category">Total Upcoming Jobs</p>
                  <h3 class="card-title">0</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/job/list-view') }}">View More...</a>
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
                  <p class="card-category">Total Past<br> Jobs</p>
                  <h3 class="card-title">0</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/job/list-view') }}/past">View More...</a>
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
                  <p class="card-category">Total Pending Jobs</p>
                  <h3 class="card-title">0</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/job/list-view') }}">View More...</a>
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
                  <h3 class="card-title">0</h3>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <a href="{{ url('form-filler/job/list-view') }}">View More...</a>
                  </div>
                </div>
              </div>
            </div>
          </div>
<!--           <div class="row">
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-success">
                  <div class="ct-chart" id="dailySalesChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Daily Sales</h4>
                  <p class="card-category">
                    <span class="text-success"><i class="fa fa-long-arrow-up"></i> 55% </span> increase in today sales.</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> updated 4 minutes ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-warning">
                  <div class="ct-chart" id="websiteViewsChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Email Subscriptions</h4>
                  <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card card-chart">
                <div class="card-header card-header-danger">
                  <div class="ct-chart" id="completedTasksChart"></div>
                </div>
                <div class="card-body">
                  <h4 class="card-title">Completed Tasks</h4>
                  <p class="card-category">Last Campaign Performance</p>
                </div>
                <div class="card-footer">
                  <div class="stats">
                    <i class="material-icons">access_time</i> campaign sent 2 days ago
                  </div>
                </div>
              </div>
            </div>
          </div> -->
        </div>
      </div>
    </div>
  </div>
@endsection