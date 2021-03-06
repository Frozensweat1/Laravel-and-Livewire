<div>

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Users</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                        <li class="breadcrumb-item active">Users</li>
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
                        <button wire:click.prevent="addNew" class="btn btn-primary btn-sm"><i
                                class="fas fa-plus-circle mr-1"></i> Add New User</button>
                        <x-search-input wire:model="searchTerm" />
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Options</th>
                                    </tr>
                                </thead>
                                <tbody wire:loading.class="text-muted">
                                    @forelse($users as $user)
                                        <tr>
                                            <th scope="row">{{ $loop->iteration }}</th>
                                            <td>
                                                <img src="{{ $user->avatar_url }}" class="img img-circle mr-2"
                                                    style="width: 50px;" alt="">
                                                {{ $user->name }}
                                            </td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a href="" wire:click.prevent="edit({{ $user }})">
                                                    <i class="fas fa-edit mr-2"></i>
                                                </a>
                                                <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                                    <i class="fas fa-trash text-danger"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="5">

                                                <img src="{{ asset('backend/dist/img/void.svg') }}"
                                                    alt="No Result Found." width="100">
                                                <p class="mt-2">No Results Found!</p>
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        <div class="card-footer d-flex justify-content-end">
                            {{ $users->links() }}
                        </div>
                    </div>

                    <!-- /.card -->
                </div>

            </div>
            <!-- /.row -->






        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content -->

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true"
        wire:ignore.self>
        <div class="modal-dialog">
            <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">
                            @if ($showEditModal)
                                <span>Edit User</span>
                            @else
                                <span>Add New User</span>
                            @endif
                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                wire:model.defer="state.name" id="name" aria-describedby="nameHelp"
                                placeholder="Enter Full Name">
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="name" class="form-label">Email</label>
                            <input type="email" wire:model.defer="state.email"
                                class="form-control @error('email') is-invalid @enderror" id="email"
                                placeholder="someone@example.com">
                            @error('email')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" wire:model.defer="state.password" id="password"
                                class="form-control @error('password') is-invalid @enderror"
                                aria-describedby="passwordHelpBlock" placeholder="Password">
                            @error('password')
                                <div class="invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="confirm" class="form-label">Confirm</label>
                            <input type="password" wire:model.defer="state.password_confirmation"
                                id="password_confirmation" class="form-control" aria-describedby="passwordHelpBlock"
                                placeholder="Confirm password">
                        </div>
                        <div class="form-group">
                            <label for="customFile">Profile Photo</label>

                            <div class="custom-file">
                                <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true"
                                    x-on:livewire-upload-finish="isUploading = false; progress = 5"
                                    x-on:livewire-upload-error="isUploading = false"
                                    x-on:livewire-upload-progress="progress = $event.detail.progress">
                                    <input wire:model="photo" type="file" class="custom-file-input" id="customFile">
                                    <div x-show.transition="isUploading" class="progress mt-2 rounded">
                                        <div class="progress-bar bg-primary progress-bar-striped" role="progressbar"
                                            aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"
                                            x-bind:style="'width: ${progress}%'">
                                            <span class="sr-only">40% Complete (success)</span>
                                        </div>
                                    </div>
                                </div>
                                <label class="custom-file-label" for="customFile">
                                    @if ($photo)
                                        {{ $photo->getClientOriginalName() }}
                                    @else
                                        Choose Image
                                    @endif
                                </label>
                            </div>

                            @if ($photo)
                                <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-3 w-100" alt="">
                            @else
                                <img src="{{ $state['avatar_url'] ?? '' }}" class="img d-block mt-3 w-100" alt="">
                            @endif

                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal"><i
                                class="fa fa-times"></i> Cancel</button>
                        <button type="submit" class="btn btn-primary">
                            @if ($showEditModal)
                                <i class="fa fa-recycle mr-1"></i> Save Changes
                            @else
                                <i class="fa fa-save mr-1"></i> Save
                            @endif
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <h5>Delete User</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                            aria-hidden="true">&times;</span></button>
                </div>

                <div class="modal-body">
                    <h4>Are you sure you want to delete this user?</h4>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times"></i>
                        Cancel</button>
                    <button type="button" wire:click.prevent="deleteUser" class="btn btn-danger">
                        <i class="fa fa-trash mr-1"></i> Yes Delete
                    </button>
                </div>

            </div>
        </div>
    </div>

</div>
