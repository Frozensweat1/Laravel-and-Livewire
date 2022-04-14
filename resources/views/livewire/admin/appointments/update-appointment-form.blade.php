<div>
    
  
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Create Appointment</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
              <li class="breadcrumb-item active">Add New Appointment</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    
    <!-- Main content -->
    <div class="content">
      <div class="container-fluid">

      {{-- @if(session()->has('message'))
       <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong><i class="fa fa-check-circle mr-1"></i>{{ session('message') }}</strong>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
       </div>
       @endif --}}
  <!-- SELECT2 EXAMPLE -->
  <form wire:submit.prevent="updateAppointment" autocomplete="off">
  <div class="card card-primary">
          <div class="card-header">
            <h3 class="card-title">Add New Appointment</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widget="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="col-md-12">
            <div class="form-group">
                  <label>Client:</label>
                  <select wire:model.defer="state.client_id" class="form-control @error('client_id') is-invalid @enderror" style="width: 100%;">
                    <option selected="selected" disabled>Select Client</option>
                    
                    @foreach($clients as $client)
                    <option value="{{ $client->id }}">{{ $client->name }}</option>
                    @endforeach
                  </select>
                  @error('client_id')
                  <div class="invalid-feedback">
                    {{ $message }}
                 </div>
                 @enderror
                </div>
            </div>
         
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                    <label>Date:</label>
                      <div class="input-group date">
                       <x-datepicker wire:model.defer="state.date" id="appointmentDate" :error="'date'"/>                                               
                          <div class="input-group-append" data-target="#appointmentDate" data-toggle="datetimepicker">
                              <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                          </div>
                          @error('date')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                          @enderror
                      </div>                    
                  </div>
                  <!-- /.form-group -->                                  
                </div>
              
              <div class="col-12 col-sm-6">
                <!-- time Picker -->
                <div class="bootstrap-timepicker">
                   <div class="form-group">
                     <label for="appointmentTime">Appointment Time:</label>      
                     <div class="input-group date">
                      <x-timepicker wire:model.defer="state.time" id="appointmentTime" :error="'time'"/>
                       <div class="input-group-append" data-target="#appointmentTime" data-toggle="datetimepicker">
                           <div class="input-group-text"><i class="far fa-clock"></i></div>
                       </div>
                       @error('time')
                       <div class="invalid-feedback">
                         {{ $message }}
                      </div>
                      @enderror
                       </div>                     
                     <!-- /.input group -->
                   </div>
                   <!-- /.form group -->
                 </div>               
              </div>
            </div>
            <!-- /.row -->
            <div class="row">
                    <div class="col-sm-12">
                      <!-- textarea -->
                      <div wire:ignore class="form-group">
                        <label>Note:</label>
                        <textarea id="note" data-note="@this" wire:model.defer="state.note" class="form-control" rows="3" placeholder="Enter note here ...">
                            {!! $state['note'] !!}
                        </textarea>
                      </div>
                    </div>
                   
            </div>
            
            <div class="col-md-12">
              <div class="form-group">
                    <label>Status:</label>
                    <select wire:model.defer="state.status" class="form-control @error('status') is-invalid @enderror" style="width: 100%;">

                      <option value="" selected>Select Status</option>                     
                      <option value="SCHEDULED">SCHEDULED</option>
                      <option value="CLOSED">CLOSED</option>
                     
                    </select>
                    @error('status')
                    <div class="invalid-feedback">
                      {{ $message }}
                   </div>
                   @enderror
                  </div>
              </div>

          </div>
          <!-- /.card-body -->
          <div class="card-footer d-flex justify-content-end">
          <button type="reset" class="btn btn-danger mr-2"><i class="fas fa-times mr-2"></i> Cancel</button> 
           <button type="submit" id="save" class="btn btn-primary mr-1"><i class="fas fa-save mr-2"></i> Save Changes</button>
          </div>
        </div>
        </form>
        <!-- /.card -->
</div>
</div>

@push('js')

<script src="https://cdn.ckeditor.com/ckeditor5/33.0.0/classic/ckeditor.js"></script>
<script>
  ClassicEditor
          .create( document.querySelector( '#note' ) )
          .then( editor => {
                  // editor.model.document.on('change:data', () => {
                  //   let note = $('#note').data('note');
                  //   eval(note).set('state.note', editor.getData());
                  // });
                  document.querySelector('#save').addEventListener('click', () => {
                    let note = $('#note').data('note');
                    eval(note).set('state.note', editor.getData());
                  });
          } )
          .catch( error => {
                  console.error( error );
          } );
</script>

@endpush
</div>
