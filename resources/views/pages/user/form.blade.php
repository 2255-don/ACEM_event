@extends('layouts.app')

@section('title', $user ? 'Modifier l\'utilisateur' : 'Créer un utilisateur')

@section('style')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/select2/select2.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/tagify/tagify.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.css')}}" />
    <style>
        /* Styles modernes pour le formulaire utilisateur */
        .user-form-card {
            border: none;
            border-radius: 16px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        
        .user-form-card:hover {
            box-shadow: 0 12px 40px rgba(0,0,0,0.12);
        }
        
        .form-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            border-radius: 16px 16px 0 0;
            padding: 2rem;
        }
        
        .form-header h4 {
            margin: 0;
            font-weight: 600;
        }
        
        .form-header .subtitle {
            opacity: 0.9;
            margin-top: 0.5rem;
        }
        
        .form-body {
            padding: 2rem;
        }
        
        /* Champs de formulaire modernes */
        .form-floating {
            position: relative;
            margin-bottom: 1.5rem;
        }
        
        .form-control, .form-select {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            padding: 1rem 1rem;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
        }
        
        .form-control:focus, .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
            background: white;
        }
        
        .form-label {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.5rem;
            display: flex;
            align-items: center;
        }
        
        .form-label i {
            margin-right: 0.5rem;
            color: #667eea;
        }
        
        /* Select2 personnalisé */
        .select2-container--default .select2-selection--single {
            height: 50px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #f8f9fa;
        }
        
        .select2-container--default .select2-selection--multiple {
            border: 2px solid #e9ecef;
            border-radius: 12px;
            background: #f8f9fa;
            min-height: 50px;
        }
        
        .select2-container--default .select2-selection--single:focus,
        .select2-container--default .select2-selection--multiple:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
        }
        
        /* Boutons modernes */
        .btn-modern {
            border-radius: 12px;
            padding: 0.75rem 2rem;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }
        
        .btn-primary-modern {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }
        
        .btn-primary-modern:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(102, 126, 234, 0.3);
        }
        
        .btn-secondary-modern {
            background: #6c757d;
            color: white;
        }
        
        .btn-secondary-modern:hover {
            background: #5a6268;
            transform: translateY(-1px);
        }
        
        /* Animations */
        .animate-fade-in {
            animation: fadeInUp 0.6s ease forwards;
        }
        
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .form-header {
                padding: 1.5rem;
            }
            
            .form-body {
                padding: 1.5rem;
            }
        }
        
        /* Validation visuelle */
        .form-control.is-valid {
            border-color: #28a745;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 8 8'%3e%3cpath fill='%2328a745' d='M2.3 6.73L.6 4.53c-.4-1.04.46-1.4 1.1-.8l1.1 1.4 3.4-3.8c.6-.63 1.6-.27 1.2.7l-4 4.6c-.43.5-.8.4-1.1.1z'/%3e%3c/svg%3e");
        }
        
        .form-control.is-invalid {
            border-color: #dc3545;
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' fill='%23dc3545' viewBox='-2 -2 7 7'%3e%3cpath stroke='%23dc3545' d='M0 0l3 3m0-3L0 3'/%3e%3ccircle r='.5'/%3e%3ccircle cx='3' r='.5'/%3e%3ccircle cy='3' r='.5'/%3e%3ccircle cx='3' cy='3' r='.5'/%3e%3c/svg%3E");
        }
    </style>
@endsection

@section('content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card user-form-card animate-fade-in">
                <div class="form-header">
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <div class="bg-white bg-opacity-20 rounded-circle p-3 me-3">
                                <i class="ti ti-user-plus text-primary" style="font-size: 1.5rem;"></i>
                            </div>
                        </div>
                        <div class="flex-grow-1">
                            <h4 class="mb-1">
                                {{ $user ? 'Modifier l\'utilisateur' : 'Créer un nouvel utilisateur' }}
                            </h4>
                            <p class="subtitle mb-0">
                                {{ $user ? 'Mettez à jour les informations de l\'utilisateur' : 'Remplissez les informations pour créer un nouvel utilisateur' }}
                            </p>
                        </div>
                    </div>
                </div>

                <div class="form-body">
                    <form id="userForm" action="{{$user && $user->id ? route('user.store', ['id' => $user->id]) : route('user.store') }}" method="POST">
                        @csrf
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <h5 class="mb-2">Veuillez corriger les erreurs suivantes :</h5>
                                <ul class="mb-0 ps-3">
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        
                        <!-- Informations personnelles -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="ti ti-user me-2"></i>Informations personnelles
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="ti ti-user"></i>Nom
                                </label>
                                <input name="nom" value="{{ $user->nom ?? old('nom') }}" 
                                       class="form-control @error('nom') is-invalid @enderror" 
                                       placeholder="Entrez le nom"
                                       required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="ti ti-user"></i>Prénom
                                </label>
                                <input name="prenom" value="{{ $user->prenom ?? old('prenom') }}" 
                                       class="form-control @error('prenom') is-invalid @enderror" 
                                       placeholder="Entrez le prénom"
                                       >
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Informations de contact -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="ti ti-mail me-2"></i>Informations de contact
                                </h6>
                            </div>
                            
                            <div class="col-md-12">
                                <label class="form-label">
                                    <i class="ti ti-mail"></i>Adresse email
                                </label>
                                <input type="email" name="email" value="{{ $user->email ?? old('email') }}" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       placeholder="exemple@email.com"
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Rôles et permissions -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="text-primary mb-3">
                                    <i class="ti ti-shield me-2"></i>Rôles et permissions
                                </h6>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label">
                                    <i class="ti ti-user-check"></i>Profil utilisateur
                                </label>
                                <select name="profils_id" id="select2basic" class="select2 form-control @error('profils_id') is-invalid @enderror" required>
                                    <option value="">-- Choisir un profil --</option>
                                    @foreach($profils as $p)
                                        <option value="{{ $p->id }}" {{ isset($user) && $user->profils_id == $p->id ? 'selected' : '' }}>
                                            {{ $p->libelle }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('profils_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="col-md-6">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <label class="form-label mb-0">
                                        <i class="ti ti-building"></i>Entreprise 
                                    </label>
                                </div>
                                @error('roles_id')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <!-- Actions -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex justify-content-between align-items-center pt-3 border-top">
                                    <a href="{{ route('user.index') }}" class="btn btn-secondary-modern btn-modern">
                                        <i class="ti ti-arrow-left me-2"></i>Retour
                                    </a>
                                    
                                    <button class="btn btn-primary-modern btn-modern" type="submit">
                                        <i class="ti ti-check me-2"></i>
                                        {{ $user ? 'Mettre à jour' : 'Créer l\'utilisateur' }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <script src="{{asset('assets/vendor/libs/select2/select2.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bootstrap-select/bootstrap-select.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>
    <script src="{{asset('assets/vendor/libs/bloodhound/bloodhound.js')}}"></script>
    <script src="{{asset('assets/js/forms-selects.js')}}"></script>
    
    <script>
        $(document).ready(function() {
            // Initialisation Select2 pour le profil
            $('#select2basic').select2({
                placeholder: '-- Choisir un profil --',
                allowClear: true,
                theme: 'bootstrap-5'
            });
            $('#select2basics').select2({
                placeholder: '-- Choisir une entreprise --',
                allowClear: f,
                theme: 'bootstrap-5'
            });
            
            // Initialisation Select2 pour les rôles multiples
            $('#select2Multiple').select2({
                placeholder: '-- Choisir des rôles --',
                allowClear: false,
                theme: 'bootstrap-5',
                tags: false
            });
            
            // Validation en temps réel
            $('input, select').on('blur', function() {
                validateField($(this));
            });
            
            // Soumission du formulaire avec validation
            $('#userForm').on('submit', function(e) {
                let isValid = true;
                
                // Valider tous les champs
                $(this).find('input, select').each(function() {
                    if (!validateField($(this))) {
                        isValid = false;
                    }
                });
                
                if (!isValid) {
                    e.preventDefault();
                    showErrorToast('Veuillez corriger les erreurs dans le formulaire');
                } else {
                    // Afficher loader
                    $(this).find('button[type="submit"]').html('<i class="ti ti-loader ti-spin me-2"></i>Enregistrement...');
                }
            });
            
            // Fonction de validation
            function validateField(field) {
                const value = field.val();
                const isRequired = field.prop('required');
                
                field.removeClass('is-valid is-invalid');
                
                if (isRequired && (!value || value.trim() === '')) {
                    field.addClass('is-invalid');
                    return false;
                }
                
                if (field.attr('type') === 'email' && value) {
                    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                    if (!emailRegex.test(value)) {
                        field.addClass('is-invalid');
                        return false;
                    }
                }
                
                field.addClass('is-valid');
                return true;
            }
            
            // Toast de succès
            function showSuccessToast(message) {
                // Implémentation du toast de succès
                console.log('Succès:', message);
            }
            
            // Toast d'erreur
            function showErrorToast(message) {
                // Implémentation du toast d'erreur
                console.log('Erreur:', message);
            }
            
            // Bouton "Vider" pour les rôles
            $('#removeAllRoles').on('click', function() {
                $('#select2Multiple').val(null).trigger('change');
                $(this).addClass('btn-success').removeClass('btn-outline-danger');
                $(this).html('<i class="ti ti-check me-1"></i>Vidé');
                
                setTimeout(() => {
                    $(this).removeClass('btn-success').addClass('btn-outline-danger');
                    $(this).html('<i class="ti ti-trash me-1"></i>Vider');
                }, 1000);
            });
            
            
        });
    </script>
@endsection
