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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/css/lightbox.min.css" rel="stylesheet">
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.4/js/lightbox.min.js"></script>



    <!-- Plugin used-->
@endpush

@section('page-header')
    <h4>Ajouter une nouvelle catégorie</h4>
    <nav>
        <ol class="breadcrumb justify-content-sm-start align-items-center mb-0">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}"><i data-feather="home"></i></a></li>
            <li class="breadcrumb-item f-w-400">Panneau d'administration</li>
            <li class="breadcrumb-item f-w-400">Service</li>
            <li class="breadcrumb-item f-w-400 active">Ajouter une nouvelle</li>
        </ol>
    </nav>
@endsection

@section('content')


    <div class="page-body">
        <div class="container-fluid">
            <div class="row justify-content-center">

                <div class="col-12 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-header bg-dark text-white">
                            <h4 class="card-title mb-0">
                                Détails du Service
                            </h4>
                        </div>
                        <div class="card-body">
                            <div class="row mb-3">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>Nom du service</strong></label>
                                    <p class="text-muted">{{ $service->nom }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>Catégorie</strong></label>
                                    <p class="text-muted">{{ $service->categorie->nom }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>Prix de base (€)</strong></label>
                                    <p class="text-muted">{{ number_format($service->prix_base, 2) }} €</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>Durée estimée</strong></label>
                                    <p class="text-muted">{{ $service->duree_estimee }} min</p>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label"><strong>Description</strong></label>
                                    <p class="text-muted">{{ $service->description }}</p>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label"><strong>Statut</strong></label>
                                    <p class="text-muted">
                                        <span
                                            class="badge {{ $service->status == 'actif' ? 'bg-success' : 'bg-secondary' }}">
                                            {{ ucfirst($service->status) }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <!-- Action Buttons -->
                            <div class="text-end mt-3">
                                <a href="{{ route('caregiver.service.edit', $service->id) }}"
                                    class="btn btn-warning btn-sm me-2">
                                    <i class="fa fa-pencil"></i> Modifier
                                </a>



                                <a class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#deleteModal{{ $service->id }}">
                                    <i class="fa fa-trash"></i> Supprimer
                                </a>

                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal{{ $service->id }}" tabindex="-1"
                                    aria-labelledby="deleteModalLabel{{ $service->id }}" aria-hidden="true">
                                    <form action="{{ route('caregiver.service.destroy', $service->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content border-danger">
                                                <!-- Modal Header -->
                                                <div class="modal-header bg-danger text-white">
                                                    <h5 class="modal-title" id="deleteModalLabel{{ $service->id }}">
                                                        Confirmer la suppression du service
                                                    </h5>
                                                    <button type="button" class="btn-close btn-close-white"
                                                        data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="modal-body">
                                                    <p class="mb-0">
                                                        Êtes-vous certain de vouloir supprimer le service :
                                                        <strong>{{ $service->nom }}</strong> ?
                                                    </p>
                                                </div>

                                                <!-- Modal Footer -->
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">
                                                        Annuler
                                                    </button>
                                                    <button type="submit" class="btn btn-danger">
                                                        Supprimer définitivement
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



                <div class="container">
                    <div class="col-12 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-header bg-dark text-white">
                                <h5 class="card-title mb-0">
                                    <i class="fas fa-images me-2"></i>Médias Associés
                                </h5>
                            </div>

                            <div class="card-body">
                                <!-- Nav tabs -->
                                <ul class="nav nav-tabs" id="mediaTab" role="tablist">
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link active" id="images-tab" data-bs-toggle="tab"
                                                data-bs-target="#images" type="button" role="tab">Images</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="files-tab" data-bs-toggle="tab"
                                                data-bs-target="#files" type="button" role="tab">Fichiers</button>
                                    </li>
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link" id="videos-tab" data-bs-toggle="tab"
                                                data-bs-target="#videos" type="button" role="tab">Vidéos</button>
                                    </li>
                                </ul>

                                <!-- Tab content -->
                                <div class="tab-content pt-4">
                                    <!-- Images Tab -->
                                    <div class="tab-pane fade show active" id="images" role="tabpanel">
                                        <div class="row">
                                            @forelse($images as $image)
                                                <div class="col-6 col-md-3 mb-4">
                                                    <div class="border rounded overflow-hidden shadow-sm position-relative">
                                                        <!-- Lightbox image link -->
                                                        <a href="{{ asset($image->image_path) }}" data-lightbox="service-gallery">
                                                            <img src="{{ asset($image->image_path) }}" alt="Service Media" class="img-fluid w-100"
                                                                 style="height: 180px; object-fit: cover;">
                                                        </a>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center text-muted">Aucune image disponible pour ce service.</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Files Tab -->
                                    <div class="tab-pane fade" id="files" role="tabpanel">
                                        <div class="row">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Nom du fichier</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($files as $file)
                                                        @php
                                                            // Extract the filename from the image path
                                                            $fileName = basename($file->image_path);
                                                        @endphp
                                                        <tr>
                                                            <td>{{ $fileName }}</td>
                                                            <td>
                                                                <!-- Download Button with Icon -->
                                                                <a href="{{ Storage::url($file->image_path) }}" download="{{ $fileName }}"
                                                                   class="btn btn-primary">
                                                                    <i class="fas fa-download"></i> Télécharger
                                                                </a>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                    <!-- Videos Tab -->
                                    <div class="tab-pane fade" id="videos" role="tabpanel">
                                        <div class="row">
                                            @forelse($videos as $video)
                                                <div class="col-12 col-md-6 mb-4">
                                                    <div class="position-relative">
                                                        <video controls style="width: 100%; height: 500px; border-radius: 5px;">
                                                            <source src="{{ asset( urlencode($video->image_path) ) }}" type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center text-muted">Aucune vidéo disponible pour ce service.</div>
                                            @endforelse
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>








@endsection
