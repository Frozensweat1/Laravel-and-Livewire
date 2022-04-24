<div>
    <x-loading-indicator />
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Appointments</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Appointments</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">

            {{-- @if (session()->has('message'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-check-circle mr-1"></i>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
       </div>
       @endif --}}


            <div class="row">
                <div class="col-lg-12">

                    <div class="d-flex justify-content-between mb-2">
                        <div>
                            <a href="{{ route('admin.appointments.create') }}">
                                <button class="btn btn-primary btn-sm">
                                    <i class="fas fa-plus-circle mr-1"></i> Add New Appointments
                                </button>
                            </a>
                        </div>
                        <div class="btn-group">
                            <button wire:click="filterAppointmentsByStatus" type="button"
                                class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">All</span>
                                <span class="badge bade-pill badge-info">{{ $appointmentsCount }}</span>
                            </button>


                            <button wire:click="filterAppointmentsByStatus('scheduled')" type="button"
                                class="btn {{ $status == 'scheduled' ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Scheduled</span>
                                <span class="badge bade-pill badge-primary">{{ $scheduledAppointmentsCount }}</span>
                            </button>


                            <button wire:click="filterAppointmentsByStatus('closed')" type="button"
                                class="btn {{ $status == 'closed' ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Closed</span>
                                <span class="badge bade-pill badge-success">{{ $closedAppointmentsCount }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Time</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($appointments as $appointment)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td scope="row">{{ $appointment->client->name }}</td>
                                            <td>{{ $appointment->date }}</td>
                                            <td>{{ $appointment->time }}</td>
                                            <td>
                                                <span
                                                    class="badge badge-{{ $appointment->status_badge }}">{{ $appointment->status }}</span>
                                            </td>
                                            {{-- <td>
                          @if ($appointment->status == 'SCHEDULED')
                          <span class="badge badge-primary">{{ $appointment->status }}</span>
                          @elseif($appointment -> status == 'CLOSED')
                          <span class="badge badge-success">{{ $appointment->status }}</span>
                          @endif
                        </td> --}}
                                            <td>
                                                <a href="{{ route('admin.appointments.edit', $appointment) }}">
                                                    <i class="fas fa-edit mr-2"></i>
                                                </a>
                                                <a href=""
                                                    wire:click.prevent="confirmAppointmentRemoval({{ $appointment->id }})">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $appointments->links() }}
                        </div>
                    </div>

                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->






        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    {{-- <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
  <div class="modal-dialog">
 
    <div class="modal-content">
      <div class="modal-header"> 
      <h5>Delete User</h5>      
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      </div>
    
    <div class="modal-body">
        <h4>Are you sure you want to delete this user?</h4>
    </div>

     <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i> Cancel</button>
        <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger">       
        <i class="fa fa-trash mr-1"></i> Yes Delete      
        </button>
      </div>

    </div>  
  </div>
</div> --}}

    <x-confirmation-alert />
</div>
