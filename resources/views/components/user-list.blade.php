@props(['users'])

@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css') }}" />
@endpush

<div class="card">
    <h5 class="card-header">Liste des Utilisateurs</h5>
    <div class="d-flex justify-content-end m-1">
        <a href="{{ route('user.form') }}" class="btn btn-primary">Ajouter</a>
    </div>
    <div class="card-datatable text-nowrap">
        <table class="dt-scrollableTable table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nom</th>
                    <th>Prenom</th>
                    <th>Email</th>
                    <th>Profil</th>
                    <th>Rôle</th>
                    <th>Statut</th>
                    <th>Action</th>
                </tr>
            </thead>
        </table>
    </div>
</div>

@push('scripts')
    <script src="{{ asset('assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js') }}"></script>
    <script>
        $(function () {
            var dt_scrollable_table = $('.dt-scrollableTable');
            var dataSet = @json($users);

            const palette = ['bg-label-primary', 'bg-label-success', 'bg-label-danger', 'bg-label-warning', 'bg-label-info', 'bg-label-dark'];
            const roleColors = new Map();
            let nextColor = 0;

            function colorFor(role) {
                if (!roleColors.has(role)) {
                    roleColors.set(role, palette[nextColor % palette.length]);
                    nextColor += 1;
                }
                return roleColors.get(role);
            }

            if (dt_scrollable_table.length) {
                dt_scrollable_table.DataTable({
                    data: dataSet,
                    columns: [
                        { data: null, defaultContent: '' },
                        { data: 'nom' },
                        { data: 'prenom' },
                        { data: 'email' },
                        { data: 'profil.name' }, // Adjusted for object access
                        { data: 'roles[, ].name' }, // Adjusted for object access
                        { data: 'statut' },
                        { data: 'id' }
                    ],
                    columnDefs: [
                        {
                            targets: 0,
                            searchable: false,
                            orderable: false,
                            render: (data, type, row, meta) => meta.row + 1
                        },
                        {
                            targets: 4,
                            render: function (data, type, row) {
                                const map = {
                                    'Super-admin': ['Super-administrateur', 'bg-label-danger badge'],
                                    'Admin': ['Admin', 'bg-label-success badge']
                                };
                                const [label, cls] = map[row.profil.name] ?? ['?', 'bg-secondary'];
                                return `<span class="badge ${cls}">${label}</span>`;
                            }
                        },
                        {
                            targets: 5,
                            orderable: false,
                            render: (roles) => {
                                if (!Array.isArray(roles) || roles.length === 0) return '-';
                                return roles.map(r =>
                                    `<span class="badge ${colorFor(r.name)} m-1">${r.name}</span>`
                                ).join('');
                            }
                        },
                        {
                            targets: 6,
                            render: function (data, type, row) {
                                const map = {
                                    1: ['Actif', 'bg-label-success'],
                                    0: ['Inactif', 'bg-label-danger']
                                };
                                const [label, cls] = map[row.statut] ?? ['?', 'bg-secondary'];
                                return `<span class="badge ${cls}">${label}</span>`;
                            }
                        },
                        {
                            targets: -1,
                            title: 'Actions',
                            searchable: false,
                            orderable: false,
                            render: function (data, type, row) {
                                const id = row.id;
                                const showUrl = `{{ route("user.show", [":id"]) }}`.replace(':id', id);
                                const editUrl = `{{ route("user.form", [":id"]) }}`.replace(':id', id);
                                const deleteUrl = `{{ route("user.delete", [":id"]) }}`.replace(':id', id);

                                return `
                                    <div class="d-inline-block">
                                        <a href="javascript:;" class="btn btn-sm btn-icon dropdown-toggle hide-arrow" data-bs-toggle="dropdown"><i class="text-primary ti ti-dots-vertical"></i></a>
                                        <div class="dropdown-menu dropdown-menu-end m-0">
                                            <a href="${showUrl}" class="dropdown-item">Details</a>
                                            <a href="${editUrl}" class="dropdown-item">Modifier</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="javascript:;" data-url="${deleteUrl}" class="dropdown-item text-danger delete-record">Supprimer</a>
                                        </div>
                                    </div>`;
                            }
                        }
                    ],
                    scrollY: '300px',
                    scrollX: true,
                    dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>'
                });
            }

            // Handle delete record
            $('.dt-scrollableTable').on('click', '.delete-record', function () {
                var url = $(this).data('url');
                // ... your sweetalert logic ...
            });
        });
    </script>
@endpush
