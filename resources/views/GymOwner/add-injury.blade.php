@extends('GymOwner.master')
@section('title', 'Injury')
@section('content')

<!--**********************************
            Content body start
***********************************-->
<div class="modal fade" id="editInjury">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Injury</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{route('updateInjury')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="uuid" id="editInjuryId">
                    <div class="form-group">
                        <label>Injury Image</label>
                        <input type="file" id="editImage" name="image" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Injury Type</label>
                        <input type="text" id="editInjuryType" name="injury_type" class="form-control" required>
                    </div>
                    <button class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>

</div>
<div class="content-body ">
    <!-- row -->
    <div class="container-fluid">
        <div class="row">
            <!-- Modal -->
            <div class="modal fade" id="addNewPlan">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Add New Injury</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                            </button>
                        </div>
                        <div class="modal-body">
                            <form method="POST" action="{{ route('addInjury') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="form-group">
                                    <label>Image</label>
                                    <input type="file" id="image" name="image" class="form-control" required>
                                </div>
                                <div class="form-group">
                                    <label>Injury Type</label>
                                    <input type="text" id="injury_type" name="injury_type" class="form-control" placeholder="Enter Injury Type" required>
                                </div>
                                <button class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-12 col-xxl-12">
                <div class="row">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header d-sm-flex d-block pb-0 border-0">
                                <div class="me-auto pe-3">
                                    <h4 class="text-black fs-20">Injury List</h4>
                                </div>

                                <div class="dropdown mt-sm-0 mt-3">
                                    <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#addNewPlan" class="btn btn-outline-primary rounded">Add New Injury</a>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="example3" class="table table-bordered table-striped verticle-middle table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th scope="col">Image</th>
                                                <th scope="col">Injury Type</th>
                                                <th scope="col" class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($injuries as $injury)
                                            <tr>
                                                <td>
                                                    <a href="#">
                                                        <div class="media d-flex align-items-center">
                                                            <div class="avatar avatar-xl me-2">
                                                                <div class=""><img class="rounded-circle img-fluid" src="{{ $injury->image }}" style="height: 50px;width: 50px;" alt="image">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </a>
                                                </td>
                                                <td>{{ $injury->injury_type}}</td>
                                                <td class="text-end">
                                                    <span>
                                                        <a href="javascript:void(0);" class="me-4 edit-injury-button" data-bs-toggle="modal" data-bs-target="#editInjury" data-injury='@json($injury)'>
                                                            <i class="fa fa-pencil color-muted"></i>
                                                        </a>
                                                        <a onclick="confirmDelete('{{ $injury->uuid }}')" data-bs-toggle="tooltip" data-placement="top" title="Close">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </span>
                                                </td>
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
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        var editButtons = document.querySelectorAll('.edit-injury-button');

        editButtons.forEach(function(button) {
            button.addEventListener('click', function() {
                var injury = JSON.parse(this.dataset.injury);

                document.getElementById('editInjuryId').value = injury.uuid;
                document.getElementById('editInjuryType').value = injury.injury_type;
            });
        });

        const deleteButtons = document.querySelectorAll('.btn-delete');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const uuid = this.getAttribute('data-uuid');
                if (confirm('Are you sure you want to delete this injury?')) {
                    document.getElementById('delete-form-' + uuid).submit();
                }
            });
        });
    });

    function confirmDelete(uuid) {
        Swal.fire({
            title: 'Are you sure?',
            text: 'Are you sure you want to delete this injury?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = '/delete-injury/' + uuid;
            }
        });
    }
</script>
@include('CustomSweetAlert');
@endsection