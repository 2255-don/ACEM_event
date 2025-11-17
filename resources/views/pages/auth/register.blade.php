<!DOCTYPE html>
<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('assets/')}}"
  data-template="vertical-menu-template-starter">
<head>
  @include('layouts.head')
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/node-waves/node-waves.css')}}" />
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/typeahead-js/typeahead.css')}}" />
    <!-- Vendor -->
    <link rel="stylesheet" href="{{asset('assets/vendor/libs/formvalidation/dist/css/formValidation.min.css')}}" />

    <!-- Page CSS -->
    <!-- Page -->
    <link rel="stylesheet" href="{{asset('assets/vendor/css/pages/page-auth.css')}}" />
    <!-- Helpers -->

  @section('title', 'Register')
</head>

<body>
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
          <img
            src="{{asset('assets/img/illustrations/auth-login-illustration-light.png')}}"
            alt="auth-login-cover"
            class="img-fluid my-5 auth-illustration"
            />

          <img
            src="{{asset('assets/img/illustrations/bg-shape-image-light.png')}}"
            alt="auth-login-cover"
            class="platform-bg"
            />
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4">
            <img src="{{ asset('assets/img/logo/Copilot_20250913_130221.png') }}" alt="Logo Jouan-Stock" class="img-fluid mx-auto d-block" style="max-width: 200px;">

          </div>
          <!-- /Logo -->
          <h3 class="mb-1 fw-bold">Bienvenue sur Jouan-Stock👋</h3>
          <p class="mb-4">Please sign-in to your account and start the adventure</p>

          <form id="formAuthentication" class="mb-3" enctype="multipart/form-data" action="{{route('entreprise.store')}}" method="POST">
            @csrf
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
            <div class="mb-3">
              <label for="email" class="form-label">Nom de l'entreprise</label>
              <input
                type="text"
                class="form-control"
                id="name"
                name="nom"
                placeholder="Enter your enterprise name"
                autofocus />
            </div>
            <div class="mb-3 form-email-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="email">email</label>
                {{--<!-- <a href="{{route('auth.resetPasswordForm')}}">
                  <small>Forgot Password?</small>
                </a> -->--}}
              </div>
              <div class="input-group input-group-merge">
                <input
                  type="email"
                  id="mail"
                  class="form-control"
                  name="email"
                  placeholder="veuillez saisir votre mail"
                  />
                <span class="input-group-text cursor-pointer"><i class="ti ti-mail"></i></span>
              </div>
            </div>
            <div class="mb-3 form-telephone-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="telephone">telephone</label>
                {{--<!-- <a href="{{route('auth.resetPasswordForm')}}">
                  <small>Forgot Password?</small>
                </a> -->--}}
              </div>
              <div class="input-group input-group-merge">
                <input
                  type="text"
                  id="te"
                  class="form-control"
                  name="telephone"
                  placeholder="veuillez saisir votre telephone"
                  />
                <span class="input-group-text cursor-pointer"><i class="ti ti-phone"></i></span>
              </div>
            </div>
            <div class="mb-3 form-addresse-toggle">
              <div class="d-flex justify-content-between">
                <label class="form-label" for="addresse">adresse</label>
                {{--<!-- <a href="{{route('auth.resetPasswordForm')}}">
                  <small>Forgot Password?</small>
                </a> -->--}}
              </div>
              <div class="input-group input-group-merge">
                <input
                  type="text"
                  id="mobile"
                  class="form-control"
                  name="adresse"
                  placeholder="veuillez saisir votre addresse"
                  />
                <span class="input-group-text cursor-pointer"><i class="ti ti-map-pin"></i></span>
              </div>
            </div>

            <div class="card-body">
                <div class="mb-3">
                    <label for="formFile" class="form-label">Lgog</label>
                    <input class="form-control" name="logo"  type="file" id="formFile" />
                </div>
            </di>
            <button type="submit" class="btn btn-primary d-grid w-100">Sign up</button>
          </form>

          

          <div class="divider my-4">
            <div class="divider-text">or</div>
          </div>

          <div class="d-flex justify-content-center">
            <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
              <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
              <i class="tf-icons fa-brands fa-google fs-5"></i>
            </a>

            <a href="javascript:;" class="btn btn-icon btn-label-twitter">
              <i class="tf-icons fa-brands fa-twitter fs-5"></i>
            </a>
          </div>
        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>

  @include('layouts.script')
  <script src="{{asset('assets/vendor/libs/i18n/i18n.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/typeahead-js/typeahead.js')}}"></script>

  <!-- endbuild -->

  <!-- Vendors JS -->
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/FormValidation.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/Bootstrap5.min.js')}}"></script>
  <script src="{{asset('assets/vendor/libs/formvalidation/dist/js/plugins/AutoFocus.min.js')}}"></script>

  <!-- Main JS -->

  <!-- Page JS -->
    <script src="{{asset('assets/js/pages-auth.js')}}"></script>
</body>
</html>