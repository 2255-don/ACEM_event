@extends('layouts.app')

@section('style')
   <link rel="stylesheet" href="assets/vendor/libs/typeahead-js/typeahead.css" />
    <link rel="stylesheet" href="assets/vendor/libs/animate-css/animate.css" />
    <link rel="stylesheet" href="assets/vendor/libs/sweetalert2/sweetalert2.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-bs5/datatables.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-responsive-bs5/responsive.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-select-bs5/select.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-checkboxes-jquery/datatables.checkboxes.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedcolumns-bs5/fixedcolumns.bootstrap5.css" />
    <link rel="stylesheet" href="assets/vendor/libs/datatables-fixedheader-bs5/fixedheader.bootstrap5.css" />
    <style>
        /* Styles modernes pour la gestion */
        .nav-tabs .nav-link {
            border: none;
            border-bottom: 3px solid transparent;
            color: #6c757d;
            font-weight: 500;
            padding: 1rem 1.5rem;
            transition: all 0.3s ease;
        }
        
        .nav-tabs .nav-link:hover {
            border-color: #e9ecef;
            color: #495057;
        }
        
        .nav-tabs .nav-link.active {
            border-color: #696cff;
            color: #696cff;
            background: transparent;
        }
        
        /* Cards modernes */
        .management-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 2px 12px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .management-card:hover {
            box-shadow: 0 4px 20px rgba(0,0,0,0.12);
        }
        
        /* Avatars et badges */
        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 600;
            color: white;
            font-size: 14px;
        }
        
        .role-badge {
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-size: 0.75rem;
            font-weight: 500;
        }
        
        .status-badge {
            padding: 0.25rem 0.75rem;
            border-radius: 15px;
            font-size: 0.7rem;
            font-weight: 600;
        }
        
        /* Actions buttons */
        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 6px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            transition: all 0.2s ease;
            margin: 0 2px;
        }
        
        .action-btn:hover {
            transform: translateY(-1px);
        }
        
        /* Table responsive */
        .table-responsive {
            border-radius: 8px;
            overflow: hidden;
        }
        
        .table th {
            background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
            border: none;
            font-weight: 600;
            color: #495057;
            padding: 1rem 0.75rem;
        }
        
        .table td {
            padding: 1rem 0.75rem;
            vertical-align: middle;
            border-bottom: 1px solid #f1f3f4;
        }
        
        .table tbody tr:hover {
            background-color: rgba(105, 108, 255, 0.04);
        }
        
        /* Search and filters */
        .search-container {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-radius: 12px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            border: 1px solid #e9ecef;
        }
        
        /* Modal improvements */
        .modal-content {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.1);
        }
        
        .modal-header {
            border-bottom: 1px solid #f1f3f4;
            padding: 1.5rem;
        }
        
        .modal-body {
            padding: 1.5rem;
        }
        
        /* Loading states */
        .loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.8);
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            border-radius: 8px;
        }
        
        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .fade-in-up {
            animation: fadeInUp 0.5s ease forwards;
        }
        
        /* Responsive improvements */
        @media (max-width: 768px) {
            .nav-tabs .nav-link {
                padding: 0.75rem 1rem;
                font-size: 0.9rem;
            }
            
            .action-btn {
                width: 28px;
                height: 28px;
            }
        }
    </style>
@endsection

@section('content')
    <div class="container-xxl flex-grow-1 container-p-y">
        <!-- Header avec statistiques -->
        <div class="row mb-4">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h4 class="fw-bold mb-0">
                        <i class="ti ti-users me-2 text-primary"></i>
                        Gestion des utilisateurs
                    </h4>
                    <div class="d-flex gap-2">
                        <button class="btn btn-outline-primary btn-sm" onclick="exportData()">
                            <i class="ti ti-download me-1"></i>Exporter
                        </button>
                        <button class="btn btn-primary btn-sm" onclick="showImportModal()">
                            <i class="ti ti-upload me-1"></i>Importer
                        </button>
                    </div>
                </div>
                
                <!-- Statistiques rapides -->
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <div class="card management-card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar bg-primary">U</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-semibold">{{ count($data) }}</h6>
                                        <small class="text-muted">Utilisateurs</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card management-card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar bg-success">R</div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card management-card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar bg-warning">P</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-semibold">{{ count($profils) }}</h6>
                                        <small class="text-muted">Profils</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card management-card">
                            <div class="card-body p-3">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0">
                                        <div class="user-avatar bg-info">A</div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="mb-0 fw-semibold">{{ $data->where('statut', 1)->count() }}</h6>
                                        <small class="text-muted">Actifs</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Navigation par onglets -->
        <ul class="nav nav-tabs mb-4" id="gestionTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="users-tab" data-bs-toggle="tab" data-bs-target="#users" type="button" role="tab">
                            <i class="ti ti-users me-2"></i>Utilisateurs
                                </button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profils-tab" data-bs-toggle="tab" data-bs-target="#profils" type="button" role="tab">
                            <i class="ti ti-user-check me-2"></i>Profils
                        </button>
                    </li>
                </ul>
        <div class="card management-card">
        
            <div class="card-body p-0 w-100">
                

    <div class="tab-content w-100 " id="gestionTabsContent">
        <!-- Onglet Utilisateurs -->
        <div class="tab-pane fade show active w-100" id="users" role="tabpanel">
            <div class="p-4 w-100">
                <!-- Barre de recherche et filtres -->
                <div class="search-container">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="input-group">
                                <span class="input-group-text"><i class="ti ti-search"></i></span>
                                <input type="text" id="userSearch" class="form-control" placeholder="Rechercher un utilisateur...">
                            </div>
                        </div>
                       
                        <div class="col-md-3">
                            <select class="form-select" id="statusFilter">
                                <option value="">Tous les statuts</option>
                                <option value="1">Actif</option>
                                <option value="0">Inactif</option>
                            </select>
                        </div>
                        <div class="col-md-2">
                            <a href="{{route('user.form')}}" class="btn btn-primary w-100">
                                <i class="ti ti-plus me-1"></i>Ajouter
                            </a>
                        </div>
                    </div>
                </div>
                            
                            <!-- Tableau des utilisateurs -->
                <div class="table-responsive w-100">
                    <table class="table table-hover w-100" id="usersTable">
                        <thead>
                            <tr>
                                <th width="5%">#</th>
                                <th width="25%">Utilisateur</th>
                                <th width="20%">Email</th>
                                <th width="15%">Profil</th>
                                <th width="15%">Rôles</th>
                                <th width="10%">Entreprise</th>
                                <th width="10%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $index => $user)
                                <tr>
                                    <td class="text-center fw-semibold">{{ $index + 1 }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar bg-primary me-3">
                                                {{ strtoupper(substr($user['nom'], 0, 1)) }}
                                            </div>
                                            <div>
                                                <div class="fw-semibold">{{ $user['nom'] }} {{ $user['prenom'] }}</div>
                                                <small class="text-muted">ID: {{ $user['id'] }}</small>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center text-dark">
                                            <i class="ti ti-mail me-2 text-muted"></i>
                                            {{ $user['email'] }}
                                        </div>
                                    </td>
                                    <td>
                                        @if($user['profil'] == 'Super-admin')
                                            <span class="role-badge bg-danger text-dark">Super-administrateur</span>
                                        @elseif($user['profil'] == 'Admin')
                                            <span class="role-badge bg-success text-dark">Administrateur</span>
                                        @else
                                            <span class="role-badge bg-secondary text-dark">{{ $user['profil'] }}</span>
                                        @endif
                                    </td>
                                    
                                    
                                    <td>
                                        <div class="d-flex gap-1">
                                            <a href="user/reset/{{ $user['id'] }}" 
                                                class="action-btn btn btn-outline-warning"
                                                data-bs-toggle="tooltip" 
                                                title="renisiatlisé">
                                                <i class="ti ti-refresh"></i>
                                            </a>
                                            <button class="action-btn btn btn-outline-primary view-user-btn" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Voir les détails"
                                                    data-user-id="{{ $user['id'] }}"
                                                    data-user-nom="{{ $user['nom'] }}"
                                                    data-user-prenom="{{ $user['prenom'] }}"
                                                    data-user-email="{{ $user['email'] }}"
                                                    data-user-profil="{{ $user['profil'] }}"
                                                   >
                                                <i class="ti ti-eye"></i>
                                            </button>
                                            <a href="user/create/{{ $user['id'] }}" 
                                                class="action-btn btn btn-outline-warning"
                                                data-bs-toggle="tooltip" 
                                                title="Modifier">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <button class="action-btn btn btn-outline-danger delete-user-btn" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Supprimer"
                                                    data-user-id="{{ $user['id'] }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

                    <!-- Onglet Rôles -->
      

        <!-- Onglet Profils -->
        <div class="tab-pane fade w-100" id="profils" role="tabpanel">
            <div class="search-container">
                <div class="row g-3">
                    <div class="col-md-4">
                        <div class="input-group">
                            <span class="input-group-text"><i class="ti ti-search"></i></span>
                            <input type="text" id="userSearch" class="form-control" placeholder="Rechercher un utilisateur...">
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-4 w-100">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="mb-0">Gestion des profils</h5>
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#profilModal">
                        <i class="ti ti-plus me-1"></i>Ajouter un profil
                    </button>
                </div>
                            
                <div class="table-responsive w-100">
                    <table class="table table-hover w-100">
                        <thead>
                            <tr>
                                <th width="10%">#</th>
                                <th width="70%">Nom du profil</th>
                                <th width="20%">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($profils as $profil)
                                <tr>
                                    <td class="text-center fw-semibold">{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="user-avatar bg-warning me-3">P</div>
                                            <span class="fw-semibold">{{ $profil->libelle }}</span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="d-flex gap-1">
                                            <button class="action-btn btn btn-outline-warning edit-profil-btn" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Modifier"
                                                    data-profil-id="{{ $profil->id }}"
                                                    data-profil-libelle="{{ $profil->libelle }}">
                                                <i class="ti ti-pencil"></i>
                                            </button>
                                            <button class="action-btn btn btn-outline-danger delete-profil-btn" 
                                                    data-bs-toggle="tooltip" 
                                                    title="Supprimer"
                                                    data-profil-id="{{ $profil->id }}">
                                                <i class="ti ti-trash"></i>
                                            </button>
                                        </div>
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

    <!-- Modal Profil -->
    <div class="modal fade" id="profilModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="profilModalTitle">
                        <i class="ti ti-user-check me-2"></i>Ajouter un profil
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                <form id="profilForm" class="row g-3">
                    <div class="modal-body">
                        <input type="hidden" name="id" id="profil_id">
                        <div class="col-12">
                            <label class="form-label" for="profil_libelle">
                                <i class="ti ti-tag me-1"></i>Nom du profil
                            </label>
                            <input type="text" id="profil_libelle" name="libelle" class="form-control" placeholder="Ex: Utilisateur standard" />
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-label-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary" id="profilSubmitBtn">
                            <i class="ti ti-check me-1"></i>Enregistrer
                        </button>
                        </div>
                    </form>
            </div>
        </div>
    </div>

    <!-- Modal Détails Utilisateur -->
    <div class="modal fade" id="userDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">
                        <i class="ti ti-user me-2"></i>Détails de l'utilisateur
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="userDetailContent">
                    <!-- Contenu chargé dynamiquement -->
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/js/extended-ui-sweetalert2.js"></script> 
    <script src="assets/vendor/libs/sweetalert2/sweetalert2.js"></script>
    <script src="assets/vendor/libs/i18n/i18n.js"></script>
    <script src="assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="assets/vendor/libs/datatables-bs5/datatables-bootstrap5.js"></script>
    <script>
        $(document).ready(function () {
            // Initialisation des tooltips
            var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
            var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
                return new bootstrap.Tooltip(tooltipTriggerEl);
            });

            // Recherche et filtres pour les utilisateurs
            $('#userSearch, #roleFilter, #statusFilter').on('keyup change', function() {
                filterUsers();
            });

            // Gestion des rôles
            $('#roleForm').submit(function (e) {
                e.preventDefault();
                submitRole();
            });

            // Gestion des profils
            $('#profilForm').submit(function (e) {
                e.preventDefault();
                submitProfil();
            });

            // Réinitialisation des modales
            $('#roleModal, #profilModal').on('hidden.bs.modal', function () {
                resetForm($(this).find('form'));
            });

            // Gestion du clic sur le bouton "Voir" utilisateur
            $(document).on('click', '.view-user-btn', function() {
                viewUser(this);
            });

            // Gestion du clic sur le bouton "Supprimer" utilisateur
            $(document).on('click', '.delete-user-btn', function() {
                deleteUser(this);
            });

            // Gestion des clics pour les rôles
            $(document).on('click', '.edit-role-btn', function() {
                editRole(this);
            });

            $(document).on('click', '.delete-role-btn', function() {
                deleteRole(this);
            });

            // Gestion des clics pour les profils
            $(document).on('click', '.edit-profil-btn', function() {
                editProfil(this);
            });

            $(document).on('click', '.delete-profil-btn', function() {
                deleteProfil(this);
            });
        });

        // Fonction de filtrage des utilisateurs
        function filterUsers() {
            const searchTerm = $('#userSearch').val().toLowerCase();
            const roleFilter = $('#roleFilter').val();
            const statusFilter = $('#statusFilter').val();
            
            $('#usersTable tbody tr').each(function() {
                const row = $(this);
                const userName = row.find('td:nth-child(2)').text().toLowerCase();
                const userRoles = row.find('td:nth-child(5)').text();
                const userStatus = row.find('td:nth-child(6)').text();
                
                const matchesSearch = searchTerm === '' || userName.includes(searchTerm);
                const matchesRole = roleFilter === '' || userRoles.includes(roleFilter);
                const matchesStatus = statusFilter === '' || userStatus.includes(statusFilter);
                
                row.toggle(matchesSearch && matchesRole && matchesStatus);
            });
        }

        // Fonctions pour les profils
        function editProfil(button) {
            const profilData = $(button).data();
            $('#profil_id').val(profilData.profilId);
            $('#profil_libelle').val(profilData.profilLibelle);
            $('#profilModalTitle').html('<i class="ti ti-user-check me-2"></i>Modifier le profil');
            $('#profilSubmitBtn').html('<i class="ti ti-check me-1"></i>Mettre à jour');
            $('#profilModal').modal('show');
        }

        function submitProfil() {
            const profilId = $('#profil_id').val();
            const url = profilId ? `/profil/store/${profilId}` : '{{ route("profil.store") }}';

                $.ajax({
                    url: url,
                type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                    libelle: $('#profil_libelle').val()
                    },
                    success: function (resp) {
                    showSuccessToast('Profil', resp.message);
                    $('#profilModal').modal('hide');
                    setTimeout(() => location.reload(), 1500);
                    },
                    error: function (xhr) {
                    showErrorToast(xhr);
                }
            });
        }

        function deleteProfil(button) {
            const profilId = $(button).data('profil-id');
                Swal.fire({
                title: 'Supprimer ce profil ?',
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
                            url: `/profil/delete/${profilId}`,
                            type: "POST",
                            data: { 
                                _method: "DELETE",
                                _token: $('meta[name="csrf-token"]').attr('content')
                            },
                            success: resp => {
                            showSuccessToast('Profil', 'Profil supprimé avec succès');
                            setTimeout(() => location.reload(), 1500);
                            },
                            error: xhr => {
                            showErrorToast(xhr);
                                }
                                });
                            }
                        });
                    }

        // Fonctions pour les utilisateurs
        function viewUser(button) {
            const userData = $(button).data();
            const id = userData.userId;
            const nom = userData.userNom;
            const prenom = userData.userPrenom;
            const email = userData.userEmail;
            const profil = userData.userProfil;
            const roles = userData.userRoles;
            const statut = userData.userStatut;
            // Créer l'avatar avec les initiales
            const initiales = (nom.charAt(0) + prenom.charAt(0)).toUpperCase();
            
            // Formater les rôles
            let rolesFormatted = '<span class="text-muted">Aucun rôle</span>';
            if (roles && typeof roles === 'string' && roles.trim() !== '' && roles !== '-') {
                const colors = ['bg-primary', 'bg-success', 'bg-warning', 'bg-danger', 'bg-info', 'bg-secondary', ];
                rolesFormatted = roles.split(', ').map(role => {
                    const randomColor = colors[Math.floor(Math.random() * colors.length)];
                    return `<span class="role-badge ${randomColor} me-2 mb-1 d-inline-block">${role.trim()}</span>`;
                }).join('');
            }
            
            // Formater le profil
            let profilBadge = '';
            if (profil === 'Super-admin') {
                profilBadge = '<span class="role-badge bg-danger">Super-administrateur</span>';
            } else if (profil === 'Admin') {
                profilBadge = '<span class="role-badge bg-success">Administrateur</span>';
            } else {
                profilBadge = `<span class="role-badge bg-secondary">${profil}</span>`;
            }
            
            // Formater le statut
           
            
            // Afficher le modal avec les vraies données
            $('#userDetailContent').html(`
                <div class="text-center mb-4">
                    <div class="user-avatar bg-primary mx-auto mb-3" style="width: 80px; height: 80px; font-size: 2rem;">${initiales}</div>
                    <h5 class="mb-1">${nom} ${prenom}</h5>
                </div>
                
                <div class="row g-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-mail me-3 text-primary"></i>
                            <div>
                                <small class="text-muted d-block">Email</small>
                                <strong>${email}</strong>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-user-check me-3 text-warning"></i>
                            <div>
                                <small class="text-muted d-block">Profil</small>
                                ${profilBadge}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <div class="d-flex align-items-center mb-3">
                            <i class="ti ti-shield me-3 text-info"></i>
                            <div>
                                <small class="text-muted d-block">Entreprise</small>
                                ${statut}
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex align-items-start mb-3">
                            <i class="ti ti-users me-3 text-success"></i>
                            <div class="flex-grow-1">
                                <small class="text-muted d-block mb-2">Rôles</small>
                                ${rolesFormatted}
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4 pt-3 border-top">
                    <small class="text-muted">
                        <i class="ti ti-calendar me-1"></i>
                        Dernière connexion: ${new Date().toLocaleDateString()}
                    </small>
                </div>
            `);
            
            $('#userDetailModal').modal('show');
        }

        function deleteUser(button) {
            const userId = $(button).data('user-id');
            Swal.fire({
                title: 'Supprimer cet utilisateur ?',
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
                        url: `/user/delete/${userId}`,
                        type: "POST",
                        data: { 
                            _method: "DELETE",
                            _token: $('meta[name="csrf-token"]').attr('content')
                        },
                        success: resp => {
                            showSuccessToast('Utilisateur', 'Utilisateur supprimé avec succès');
                            setTimeout(() => location.reload(), 1500);
                        },
                        error: xhr => {
                            showErrorToast(xhr);
                        }
                    });
                }
            });
        }

        // Fonctions utilitaires
        function showSuccessToast(title, message) {
                            Swal.fire({
                title: 'Succès !',
                text: message,
                                icon: 'success',
                timer: 1500,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        function showErrorToast(xhr) {
            let message = 'Une erreur est survenue';
            if (xhr.status === 422) {
                const errors = xhr.responseJSON.errors;
                message = Object.values(errors).flat().join('\n');
            } else if (xhr.responseJSON && xhr.responseJSON.message) {
                message = xhr.responseJSON.message;
            }
            
                            Swal.fire({
                                title: 'Erreur',
                text: message,
                icon: 'error',
                customClass: { confirmButton: 'btn btn-primary' },
                buttonsStyling: false
            });
        }

        function resetForm(form) {
            form[0].reset();
            form.find('input[type="hidden"]').val('');
            form.find('.modal-title').html('<i class="ti ti-plus me-2"></i>Ajouter');
            form.find('button[type="submit"]').html('<i class="ti ti-check me-1"></i>Enregistrer');
        }

        function exportData() {
            Swal.fire({
                title: 'Exporter les données',
                text: 'Fonctionnalité à implémenter',
                icon: 'info'
            });
        }

        function showImportModal() {
            Swal.fire({
                title: 'Importer des données',
                text: 'Fonctionnalité à implémenter',
                icon: 'info'
            });
        }
    </script>
@endsection