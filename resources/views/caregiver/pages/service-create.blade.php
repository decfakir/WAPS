@extends('caregiver.layouts.app')

@section('title', 'Admin - Add New Care Giver')


@push('styles')
    <!-- Google font-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100;200;300;400;500;600;700;800;900&amp;display=swap"
        rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/font-awesome.css">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/icofont.css">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/themify.css">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/flag-icon.css">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/feather-icon.css">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/slick.css">
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/scrollbar.css">
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/animate.css">
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/prism.css">
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/vendors/bootstrap.css">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/style.css">
    <link id="color" rel="stylesheet" href="/dashboard-assets/css/color-1.css" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="/dashboard-assets/css/responsive.css">
@endpush


@push('scripts')
    <!-- latest jquery-->
    <script src="/dashboard-assets/js/jquery.min.js"></script>
    <!-- Bootstrap js-->
    <script src="/dashboard-assets/js/bootstrap/bootstrap.bundle.min.js"></script>
    <!-- feather icon js-->
    <script src="/dashboard-assets/js/icons/feather-icon/feather.min.js"></script>
    <script src="/dashboard-assets/js/icons/feather-icon/feather-icon.js"></script>
    <!-- scrollbar js-->
    <script src="/dashboard-assets/js/scrollbar/simplebar.js"></script>
    <script src="/dashboard-assets/js/scrollbar/custom.js"></script>
    <!-- Sidebar jquery-->
    <script src="/dashboard-assets/js/config.js"></script>
    <!-- Plugins JS start-->
    <script src="/dashboard-assets/js/sidebar-menu.js"></script>
    <script src="/dashboard-assets/js/sidebar-pin.js"></script>
    <script src="/dashboard-assets/js/slick/slick.min.js"></script>
    <script src="/dashboard-assets/js/slick/slick.js"></script>
    <script src="/dashboard-assets/js/header-slick.js"></script>
    <script src="/dashboard-assets/js/prism/prism.min.js"></script>
    <script src="/dashboard-assets/js/clipboard/clipboard.min.js"></script>
    <script src="/dashboard-assets/js/custom-card/custom-card.js"></script>
    <!-- calendar js-->
    <script src="/dashboard-assets/js/typeahead/handlebars.js"></script>
    <script src="/dashboard-assets/js/typeahead/typeahead.bundle.js"></script>
    <script src="/dashboard-assets/js/typeahead/typeahead.custom.js"></script>
    <script src="/dashboard-assets/js/typeahead-search/handlebars.js"></script>
    <script src="/dashboard-assets/js/typeahead-search/typeahead-custom.js"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="/dashboard-assets/js/script.js"></script>
    <script src="/dashboard-assets/js/script1.js"></script>
    <script src="/dashboard-assets/js/theme-customizer/customizer.js"></script>
    <!-- Plugin used-->
@endpush

@section('page-header')
    <h4>Ajouter une nouvelle catégorie</h4>
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item f-w-400">Panneau 'aidant </li>
            <li class="breadcrumb-item f-w-400">Service</li>
            <li class="breadcrumb-item f-w-400 active">Ajouter une nouvelle</li>
        </ol>
    </nav>
@endsection

@section('content')
    {{-- <div class="page-body">
    <div class="container-fluid">
        <div class="edit-profile">
            <div class="row">
                <div class="col-xl-11 mx-auto">
                    <form class="card" method="POST" action="{{ route('caregiver.service.store') }}">
                        @csrf
                        <div class="card-header">
                            <h4 class="card-title mb-0">Ajouter un nouveau Service</h4>
                        </div>
                        <div class="card-body">
                            @include('partials._dashboard_message')
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Nom du service</label>
                                        <input class="form-control" type="text" name="nom" value="{{ old('nom') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Catégorie</label>
                                        <select class="form-control" name="categorie_id" required>
                                            <option value="">-- Choisir --</option>
                                            @foreach ($categories as $cat)
                                                <option value="{{ $cat->id }}" {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                                                    {{ $cat->nom }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Prix de base (€)</label>
                                        <input class="form-control" type="number" name="prix_base" step="0.01" value="{{ old('prix_base') }}" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label">Durée estimée (min)</label>
                                        <input class="form-control" type="number" name="duree_estimee" value="{{ old('duree_estimee') }}">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="mb-3">
                                        <label class="form-label">Description</label>
                                        <textarea class="form-control" name="description" rows="3">{{ old('description') }}</textarea>
                                    </div>
                                </div>



                                <div class="col-md-6">
                                    <div class="form-check form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="actif" value="1" {{ old('actif', true) ? 'checked' : '' }}>
                                        <label class="form-check-label">Actif ?</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Créer le Service</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div> --}}

    <div class="page-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Start of the form for Service creation -->
                <form method="POST" action="{{ route('caregiver.service.store') }}" enctype="multipart/form-data">
                    @csrf

                    <!-- Card for Service Information -->
                    <div class="col-md-12 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Créer un Service</h4>
                            </div>
                            <div class="card-body">
                                @include('partials._dashboard_message')

                                <!-- Service Info Section -->
                                <div class="row mb-4">
                                    <!-- Service Name -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Nom du service</label>
                                            <input class="form-control" type="text" name="nom"
                                                value="{{ old('nom') }}" required>
                                        </div>
                                    </div>
                                    <!-- Category -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Catégorie</label>
                                            <select class="form-control" name="categorie_id" required>
                                                <option value="">-- Choisir --</option>
                                                @foreach ($categories as $cat)
                                                    <option value="{{ $cat->id }}"
                                                        {{ old('categorie_id') == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <!-- Price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Prix de base (€)</label>
                                            <input type="number" class="form-control" name="prix_base"
                                                value="{{ old('prix_base') }}" step="0.01" required>
                                        </div>
                                    </div>
                                    <!-- Estimated Duration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Durée estimée (min)</label>
                                            <input type="number" class="form-control" name="duree_estimee"
                                                value="{{ old('duree_estimee') }}">
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                        </div>
                                    </div>
                                </div>

                                <!-- Approval and Active status Section -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="status" type="checkbox"
                                                value="1" checked>
                                            <label class="form-check-label">Actif ?</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Card for Media Upload -->
                    <div class="col-md-12">
                        <div class="card shadow border-0">
                            <div class="card-header">
                                <h5 class="card-title">Télécharger une Image / Médias</h5>
                            </div>
                            <div class="card-body text-center">
                                <div class="mb-3">
                                    <!-- Media upload input field -->
                                    {{-- <input type="file" name="piece_jointe[]" multiple class="form-control" accept="image/*, .pdf"> --}}
                                    <input type="file" name="piece_jointe[]" multiple class="form-control"
                                        accept="image/*, video/mp4, video/webm, video/ogg, .mp4, .webm, .ogg, .mov, .avi, .pdf">
                                </div>
                                <p class="text-muted">Téléchargez une image ou un fichier associé à ce service.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Submit Button -->
                    <div class="col-md-11 text-end mb-4">
                        <button type="submit" class="btn btn-primary">Créer le Service</button>
                    </div>
                </form>
                <!-- End of the form -->
            </div>
        </div>
    </div>







@endsection
