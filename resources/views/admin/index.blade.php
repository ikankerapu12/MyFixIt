@extends('admin.admin_dashboard')
@section('admin')

@section('title1')
  Admin Dashboard | MyFixIt  
@endsection
<div class="page-content">

            <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
                 <div>
            <h4 class="mb-3 mb-md-0">Welcome to Dashboard</h4>
          </div>
          <!-- <div class="d-flex align-items-center flex-wrap text-nowrap">
            <div class="input-group flatpickr wd-200 me-2 mb-2 mb-md-0" id="dashboardDate">
              <span class="input-group-text input-group-addon bg-transparent border-primary" data-toggle><i data-feather="calendar" class="text-primary"></i></span>
              <input type="text" class="form-control bg-transparent border-primary" placeholder="Select date" data-input>
            </div>
            <button type="button" class="btn btn-outline-primary btn-icon-text me-2 mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="printer"></i>
              Print
            </button>
            <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
              <i class="btn-icon-prepend" data-feather="download-cloud"></i>
              Download Report
            </button>
          </div> -->
        </div>

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              
              <!-- Booking Requests -->
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Booking Requests</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $bookingCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

               <!-- Total Service -->
               <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Services</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $serviceCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Service Type -->
              <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Service Types</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $serviceTypeCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

              <!-- Total Users -->
               <div class="col-md-3 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Seksyen</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $seksyenCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>

            </div>
          </div>
        </div> <!-- row -->

        <div class="row">
          <div class="col-12 col-xl-12 stretch-card">
            <div class="row flex-grow-1">
              
              <!-- Total Technicians -->
              <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Technicians</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $technicianCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>


                                                      <div class="col-md-6 grid-margin stretch-card">
                <div class="card">
                  <div class="card-body">
                    <div class="d-flex justify-content-between align-items-baseline">
                      <h6 class="card-title mb-0">Total Users</h6>
                    </div>
                    <div class="row">
                      <div class="col-12">
                        <h3 class="mb-2">{{ $userCount }}</h3>
                      </div>
                    </div>
                  </div>
                </div>
              </div>  
            

            </div>
          </div>
        </div> <!-- row -->



        <div class="row">
          <div class="col-lg-12 col-xl-12 grid-margin stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">Monthly Bookings</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                  </div>
                </div>
                <p class="text-muted">Total number of bookings received each month.</p>
                <div id="monthlyBookingsChart"></div>
              </div> 
            </div>
          </div>

        </div> <!-- row -->

@php
    $statusMapping = [
        '1' => ['label' => 'Available', 'badge' => 'success'],
        '2' => ['label' => 'Busy', 'badge' => 'warning'],
        '3' => ['label' => 'Unavailable', 'badge' => 'danger'],
    ]; // Assuming standard mapping if not provided
@endphp

        <div class="row">
          <div class="col-lg-5 col-xl-4 grid-margin grid-margin-xl-0 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                  <h6 class="card-title mb-0">All Services</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                  </div>
                </div>
                <!-- Service Table -->
                <div class="table-responsive">
                    <table class="table table-hover mb-0">
                        <thead>
                            <tr>
                                <th class="pt-0">#</th>
                                <th class="pt-0">Service</th>
                                <th class="pt-0">Added By</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($latestServices as $key => $service)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $service->service_name }}</td>
                                <td>{{ $service->user->name ?? 'Admin' }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

              </div>
            </div>
          </div>
          <div class="col-lg-7 col-xl-8 stretch-card">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between align-items-baseline mb-2">
                <h6 class="card-title mb-0">Latest Booking Requests</h6>
                  <div class="dropdown mb-2">
                    <a type="button" id="dropdownMenuButton7" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="icon-lg text-muted pb-3px" data-feather="more-horizontal"></i>
                    </a>
                  </div>
                </div>
                <div class="table-responsive">
                  <table class="table table-hover mb-0">
                    <thead>
                      <tr>
                        <th class="pt-0">#</th>
                        <th class="pt-0">Service Name</th>
                        <th class="pt-0">User Name</th>
                        <th class="pt-0">Technician</th>
                        <th class="pt-0">Date</th>
                        <th class="pt-0">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach($latestBookings as $key => $item)
                      <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ $item['service']['service_name'] ?? 'N/A' }}</td>
                        <td>{{ $item['user']['name'] ?? 'N/A' }}</td>
                        <td>{{ $item['technician']['name'] ?? 'Unassigned' }}</td>
                        <td>{{ $item->created_at->format('d/m/Y') }}</td>
                        <td>
                             @if($item->status == 'pending')
                                <span class="badge bg-warning">Pending</span>
                            @elseif($item->status == 'confirm')
                                <span class="badge bg-info">Confirmed</span>
                             @elseif($item->status == 'complete')
                                <span class="badge bg-success">Completed</span>
                            @else
                                <span class="badge bg-danger">{{ $item->status }}</span>
                            @endif
                        </td>
                      </tr>
                      @endforeach
                    </tbody>
                  </table>
                </div>
              </div> 
            </div>
          </div>
        </div> <!-- row -->

        <!-- New Row for Technicians and Users -->
         <br>
        <div class="row">
            <!-- All Technicians -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">New Technicians</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestTechnicians as $key => $tech)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $tech->name }}</td>
                                        <td>{{ $tech->email }}</td>
                                        <td>
                                            @if($tech->status == 'active')
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-danger">{{ $tech->status }}</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <!-- All Users -->
            <div class="col-lg-6 grid-margin stretch-card">
                <div class="card">
                    <div class="card-body">
                        <h6 class="card-title">New Users</h6>
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($latestUsers as $key => $user)
                                    <tr>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ $user->phone }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

			</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
  if($('#monthlyBookingsChart').length) {
    var options = {
      chart: {
        type: 'bar',
        height: '318',
        parentHeightOffset: 0,
        foreColor: '#65748b',
        toolbar: {
          show: false
        },
      },
      theme: {
        mode: 'light'
      },
      tooltip: {
        theme: 'light'
      },
      colors: ["#727cf5"],
      fill: {
        opacity: .9
      },
      grid: {
        padding: {
          bottom: -4
        },
        borderColor: '#f1f1f1',
        xaxis: {
          lines: {
            show: true
          }
        }
      },
      series: [{
        name: 'Bookings',
        data: @json($monthlyBookings)
      }],
      xaxis: {
        type: 'category',
        categories: ['Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec'],
        axisBorder: {
          color: '#f1f1f1',
        },
        axisTicks: {
          show: true,
          color: '#f1f1f1',
        },
      },
      yaxis: {
        title: {
          text: 'Number of Bookings',
          style: {
            size: 9,
            color: '#b9b9b9'
          }
        },
      },
      legend: {
        show: true,
        position: "top",
        horizontalAlign: 'center',
        fontFamily: 'Roboto',
        itemMargin: {
          horizontal: 8,
          vertical: 0
        },
      },
      stroke: {
        width: 0
      },
      dataLabels: {
        enabled: true,
        style: {
          fontSize: '10px',
          fontFamily: 'Roboto',
        },
        offsetY: -10
      },
      plotOptions: {
        bar: {
          columnWidth: "50%",
          borderRadius: 4,
          dataLabels: {
            position: 'top',
            orientation: 'vertical',
          }
        },
      },
    }

    var apexBarChart = new ApexCharts(document.querySelector("#monthlyBookingsChart"), options);
    apexBarChart.render();
  }
});
</script>

@endsection