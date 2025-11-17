<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="{{asset('/assets')}}"
  data-template="templateName"
  data-template="vertical-menu-template-starter">
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('layouts.head')
</head>

<body>
    <div class="layout-wrapper layout-content-navbar">
      <div class="layout-container">
            @include('layouts.sidebar')
            <div class="layout-page">
                @include('layouts.navbar')
                {{-- Insertion du fil d'Ariane --}}

                <div class="content-wrapper">
                    <div class="container-xxl flex-grow-1 container-p-y">
                        <h4 class="fw-bold py-3 mb-4">
                            @include('components.breadcrumbs', ['breadcrumbs' => generateBreadcrumbs()])
                        </h4>
                        @yield('content')
                    </div>
                    @include('layouts.footer')
                </div>
            </div>
        </div> 
        <div class="layout-overlay layout-menu-toggle"></div>
        <!-- Drag Target Area To SlideIn Menu On Small Screens -->
        <div class="drag-target"></div>
    </div>  
    @include('layouts.script')
        
    @yield('script')
</body>
</html>