@extends('layouts.app')

@section('style')
    <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css" />
endsection

@section('title','User-Home')

@section('content')

    <div class="card">
        <h5 class="card-header">Scrollable Table</h5>
        <div class="d-flex justify-content-end m-1">
            <a
                href="{{route('user.form')}}"
                class="btn btn-primary ">
                Ajouter
            </a>
        </div>
        <div class="card-datatable text-nowrap">
            <table class="dt-scrollableTable table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Nom</th>
                        <th>Prenom</th>
                        <th>Email</th>
                        <th>profil</th>
                        <th>role</th>
                        <th>statut</th>
                        <th>Action</th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>

@endsection

@section('script')
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script>
        var dt_scrollable_table = $('.dt-scrollableTable');
        var dataSet = @json($data);
            console.log('dataSet');
        const palette = [
            'badge-lightbadge-light-primary',   // bleu
            'badge-light-success',   // vert
            'badge-light-danger',    // rouge
            'badge-light-warning',   // jaune
            'badge-light-info',      // cyan
            'badge-light-dark'       // gris foncé
        ];

        // 2️⃣  Dictionnaire généré à la volée
        const roleColors = new Map();   // Map : rôle → classe couleur
        let nextColor = 0;              // index dans la palette

        function colorFor(role) {
            if (!roleColors.has(role)) {
            roleColors.set(role, palette[nextColor % palette.length]);
            nextColor += 1;
            }
            return roleColors.get(role);
        }

        $('.dt-scrollableTable').DataTable({
            data: dataSet,          // <-- pas "ajax"
            columns: [
            { data: null },       // index #
            { data: 'nom' },
            { data: 'prenom' },
            { data: 'email' },
            { data: 'profil' },
            { data: 'roles' },
            { data: 'statut' },
            { data: 'id' }
            ],
            columnDefs: [

                {
                    targets:0,
                    searchable: false,
                    orderable: false,
                    className: 'text-center fw-semibold',
                    render: (data, type, row, meta) => meta.row + 1
                },
                {
                     targets:4 ,
                    render: function (data, type, row) {
                        const map = {
                                'Super-admin': ['Super-administrateur', 'badge badge-light-danger'],
                                'Admin': ['Inactif', 'badge badge-light-success']
                            };
                            const [label, cls] = map[row.profil] ?? ['?', 'badge badge-light-success'];
                            return `<span class="badge ${cls}">${label}</span>`;
                    }
                },
                {
                    targets: 5,
                    orderable: false,
                    render: (roles /* array */) =>
                       {if (!Array.isArray(roles) || roles.length === 0) return '-';
                            return roles.map(r =>
                                `<span class="badge ${colorFor(r)} m-1">${r}</span>`
                            ).join('');
                        }
                },
                {
                    // statut
                    targets: 6,
                    render: function (data, type, row) {
                        const [label, cls] = map[row.statut] ?? ['?', 'badge badge-light-primary'];
                        return `<span class="badge ${cls}">${label}</span>`;
                    }
                },
                {
                // Actions
                targets: -1,
                title: 'Actions',
                searchable: false,
                orderable: false,
                render: function (data, type, row) {
                    const id = row.id;
                    const show = `/show/${id}`;
                    const edit = `user/create/${id}`;
                    return `
                        <div class="d-inline-block">
                            <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                                <i class="text-primary ti ti-dots-vertical"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end m-0">
                                <a href="${show}" class="dropdown-item">Details</a>
                                <a href="javascript:;" class="dropdown-item">Archive</a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:;" data-id="${id}" class="dropdown-item text-danger delete-record">
                                    <i class="text-primary ti ti-trash"></i>
                                </a>
                            </div>
                        </div>
                        <a href="${edit}" class="item-edit text-body">
                            <i class="text-primary ti ti-pencil"></i>
                        </a>
                    `;
                }
                }
            ],

           

            // Scroll options
            scrollY: '300px',
            scrollX: true,
            dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
        });

        $('#your-table-id').on('click', '.delete-record', function (e) {
            e.preventDefault();

            const id = $(this).data('id');

            Swal.fire({
                title: 'Êtes-vous sûr ?',
                text: "Cette action est irréversible.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Oui, supprimer',
                cancelButtonText: 'Annuler',
                customClass: {
                    confirmButton: 'btn btn-danger mx-2',
                    cancelButton: 'btn btn-secondary'
                },
                buttonsStyling: false
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        url: `/user/delete/${id}`,
                        method: 'POST',
                        data: { _method: 'DELETE' },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function (res) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Supprimé',
                                text: 'Le rôle a été supprimé avec succès.',
                                timer: 2000,
                                showConfirmButton: false
                            });

                            dt_scrollableTable.ajax.reload(null, false); // recharge la table sans reset pagination
                        },
                        error: function (xhr) {
                            Swal.fire({
                                icon: 'error',
                                title: 'Erreur',
                                text: xhr.responseJSON?.message || 'Une erreur est survenue.'
                            });
                        }
                    });
                }
            });
        });
        
    </script>
@endsection