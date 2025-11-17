@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="assets/vendor/libs/sweetalert2/sweetalert2.css" />
@endsection

@section('title','Role')

@section ('content')
    <div class="card">
        <h5 class="card-header">Light Table head</h5>
        <div class="d-flex justify-content-end m-1">
            <button
            type="button"
            class="btn btn-primary "
            data-bs-toggle="modal"
            data-bs-target="#addNewCCModal">
            Ajouter
        </button>
        </div>
        
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead class="table-light">
                    <tr>
                    <th>#</th>
                    <th>libelle</th>
                    <th>action</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach($profils as $key => $profil)
                        <tr>
                            <td>{{$loop->iteration}}</td>
                            <td>{{$profil->libelle}}</td>
                            <td>
                                <div class="dropdown">
                                    <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                        <i class="ti ti-dots-vertical"></i>
                                    </button>
                                    <div class="dropdown-menu">
                                        <a href="javascript:void(0);" 
                                            class="dropdown-item edit-profil-btn" 
                                            data-id="{{ $profil->id }}" 
                                            data-libelle="{{ $profil->libelle }}">
                                            <i class="ti ti-pencil me-1"></i> 
                                            Edit
                                        </a>

                                        <!-- <form action="{{route('profil.delete', ['id'=>$profil->id])}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit">ddd</button>
                                        </form> -->

                                        <a class="dropdown-item delete-profil-btn" data-id="{{ $profil->id }}">
                                            <i class="ti ti-trash me-1"></i> 
                                            Delete
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div class="modal fade" id="addNewCCModal" tabindex="-1" action="{{route('profil.store')}}" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered1 modal-simple modal-add-new-cc">
            <div class="modal-content p-3 p-md-5">
                <div class="modal-body">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="text-center mb-4">
                        <h3 class="mb-2">Ajouter un nouveau profil</h3>
                        <p class="text-muted">veuilez ajouter un nouveau profil</p>
                    </div>

                    <form id="addNewCCForm" class="row g-3" onsubmit="return false">
                        <input type="hidden" name="id" id="profil_id">

                        <div class="col-12 col-md-6">
                            <label class="form-label" for="profil_libelle">Nom</label>
                            <input type="text" id="profil_libelle" name="libelle" class="form-control" placeholder="Libelle du rôle" />
                        </div>
                        
                        <div class="col-12 text-center">
                            <button type="submit" class="btn btn-primary me-sm-3 me-1" id="submitBtn">Submit</button>
                            <button type="reset" class="btn btn-label-secondary btn-reset" data-bs-dismiss="modal" aria-label="Close">Cancel</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')

    <script src="assets/js/extended-ui-sweetalert2.js"></script> 
    <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>

    <script>
        $(document).ready(function () {
            // Quand on clique sur "Edit"
            $('.edit-profil-btn').click(function () {
                let profilId = $(this).data('id');
                let libelle = $(this).data('libelle');
                

                $('#profil_id').val(profilId);
                $('#profil_libelle').val(libelle);

                $('#submitBtn').text('Mettre à jour');
                $('#addNewCCModal').modal('show');
            });

            

            // Soumission du formulaire AJAX
            $('#addNewCCForm').submit(function (e) {
                e.preventDefault();
                let profilId = $('#profil_id').val();
                let libelle = $('#profil_libelle').val();
                let url = '';
                let method = '';
                
                if (profilId) {
                    // mode édition
                    url = '/profil/store/' + profilId;
                    method = 'POST';
                } else {
                    // mode création
                    console.log(libelle);
                    
                    url = '{{ route("profil.store") }}';
                    method = 'POST';
                }

                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        _token: '{{ csrf_token() }}',
                        libelle: libelle
                    },
                    success: function (resp) {
                        Swal.fire({
                            title: 'Succès !',
                            text: resp.message,
                            icon: 'success',
                            timer: 1500,
                            showConfirmButton: false
                        }).then(() => location.reload());
                    },
                    error: function (xhr) {
                        if (xhr.status === 422) {              // <- validation
                            // Rassembler les messages
                            let errors = xhr.responseJSON.errors;
                            let msg = Object.values(errors)
                                        .flat()
                                        .join('\n');

                            Swal.fire({
                                title: 'Validation échouée',
                                text: msg,
                                icon: 'warning',
                                customClass: { confirmButton: 'btn btn-primary' },
                                buttonsStyling: false
                            });
                        } else {
                            // Erreur générale (500, 404, …)
                            Swal.fire({
                                title: 'Erreur serveur',
                                text: 'Une erreur inattendue est survenue.',
                                icon: 'error',
                                customClass: { confirmButton: 'btn btn-primary' },
                                buttonsStyling: false
                            });
                            console.error(xhr.responseText);
                        }
                    }
                });
            });

            // délégation pour capter les clics sur tous les futurs boutons
            // délégation
            $(document).on('click', '.delete-profil-btn', function (e) {
                e.preventDefault();
                const roleId = $(this).data('id');
                
                Swal.fire({
                    title: 'Supprimer ce rôle ?',
                    text: 'Cette action est irréversible.',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Oui, supprimer',
                    cancelButtonText: 'Annuler',
                    customClass: {
                        confirmButton: 'btn btn-danger',
                        cancelButton: 'btn btn-secondary ms-2'
                    },
                    buttonsStyling: false
                }).then(result => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `/profil/delete/${roleId}`,
                            type: "POST",
                            data: { 
                                _method: "DELETE",
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            dataType: 'json',
                            success: resp => {
                                if (resp.success) {
                                    Swal.fire({
                                        title: 'Supprimé !',
                                        text: resp.message,
                                        icon: 'success',
                                        timer: 1200,
                                        showConfirmButton: false
                                    }).then(() => location.reload());
                                } else {
                                    Swal.fire({
                                        title: 'Erreur',
                                        text: resp.message,
                                        icon: 'error'
                                    });
                                }
                            },
                            error: xhr => {
                                let errorMsg = 'Une erreur est survenue';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    errorMsg = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    title: 'Erreur',
                                    text: errorMsg,
                                    icon: 'error'
                                });
                            }
                        });
                    }
                });
            });




            // Réinitialisation du formulaire (pour nouvelle création)
            $('.btn-reset').click(function () {
                $('#addNewCCForm')[0].reset();
                $('#profil_id').val('');
                $('#submitBtn').text('Submit');
            });
        });
    </script>
@endsection