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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/2.10.377/pdf.min.js"></script>


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




    <div class="page-body">
        <div class="container-fluid">
            <div class="row justify-content-center">
                <!-- Start of the form for Service editing -->
                <form method="POST" action="{{ route('caregiver.service.update', $service->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT') <!-- Use PUT method for updates -->
                    <!-- Card for Service Information -->
                    <div class="col-md-12 mb-4">
                        <div class="card shadow border-0">
                            <div class="card-header">
                                <h4 class="card-title mb-0">Modifier un Service</h4>
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
                                                value="{{ old('nom', $service->nom) }}" required>
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
                                                        {{ old('categorie_id', $service->categorie_id) == $cat->id ? 'selected' : '' }}>
                                                        {{ $cat->nom }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" id="id"  value="{{ $service->id }}">
                                    <!-- Price -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Prix de base (€)</label>
                                            <input type="number" class="form-control" name="prix_base"
                                                value="{{ old('prix_base', $service->prix_base) }}" step="0.01" required>
                                        </div>
                                    </div>
                                    <!-- Estimated Duration -->
                                    <div class="col-md-6">
                                        <div class="mb-3">
                                            <label class="form-label">Durée estimée (min)</label>
                                            <input type="number" class="form-control" name="duree_estimee"
                                                value="{{ old('duree_estimee', $service->duree_estimee) }}">
                                        </div>
                                    </div>
                                    <!-- Description -->
                                    <div class="col-md-12">
                                        <div class="mb-3">
                                            <label class="form-label">Description</label>
                                            <textarea name="description" class="form-control" rows="3">{{ old('description', $service->description) }}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <!-- Approval and Active status Section -->
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-check form-switch">
                                            <input class="form-check-input" name="status" type="checkbox"
                                               {{ old('status', $service->status) ? 'checked' : '' }}>
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
                                    <input type="file" name="piece_jointe[]" multiple class="form-control"
                                        accept="image/*, video/mp4, video/webm, video/ogg, .mp4, .webm, .ogg, .mov, .avi, .pdf">
                                </div>
                                <p class="text-muted">Téléchargez une image ou un fichier associé à ce service.</p>
                            </div>
                        </div>
                    </div>
                    <!-- Submit Button -->
                    <div class="col-md-11 text-end mb-4">
                        <button type="submit" class="btn btn-primary">Mettre à jour le Service</button>
                    </div>
                </form>
                <!-- End of the form -->




                <!-- 🖼️ Card 2: Media Gallery -->
                {{-- <div class="col-12 mb-4">
                    <div class="card shadow border-0">
                        <div class="card-header bg-dark text-white">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-images me-2"></i>Médias Associés
                            </h5>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                @forelse($images as $image)
                                    <div class="col-6 col-md-3 mb-4">
                                        <div class="border rounded overflow-hidden shadow-sm position-relative">
                                            <!-- Lightbox image link -->
                                            <a href="{{ asset($image->image_path) }}" data-lightbox="service-gallery">
                                                <img src="{{ asset($image->image_path) }}" alt="Service Media"
                                                    class="img-fluid w-100" style="height: 180px; object-fit: cover;">
                                            </a>
                                            <!-- Delete button for this specific image -->
                                            <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                data-bs-toggle="modal" data-bs-target="#deleteModal{{ $image->id }}"
                                                aria-label="Delete image">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </div>

                                        <!-- Individual Delete Modal for each image -->
                                        <div class="modal fade" id="deleteModal{{ $image->id }}" tabindex="-1"
                                            aria-labelledby="deleteModalLabel{{ $image->id }}" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content border-danger">
                                                    <div class="modal-header bg-danger text-white">
                                                        <h5 class="modal-title" id="deleteModalLabel{{ $image->id }}">
                                                            Confirmer la suppression</h5>
                                                        <button type="button" class="btn-close btn-close-white"
                                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        Êtes-vous sûr de vouloir supprimer cette image ?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Annuler</button>
                                                        <form method="POST"
                                                            action="{{ route('caregiver.service.image.destroy', $image->id) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit"
                                                                class="btn btn-danger">Supprimer</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="col-12 text-center text-muted">
                                        Aucune image disponible pour ce service.
                                    </div>
                                @endforelse



                            </div>
                        </div>
                    </div>
                </div> --}}

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
                                                    <div
                                                        class="border rounded overflow-hidden shadow-sm position-relative">
                                                        <!-- Lightbox image link -->
                                                        <a href="{{ asset($image->image_path) }}"
                                                            data-lightbox="service-gallery">
                                                            <img src="{{ asset($image->image_path) }}"
                                                                alt="Service Media" class="img-fluid w-100"
                                                                style="height: 180px; object-fit: cover;">
                                                        </a>
                                                        <!-- Delete button for this specific image -->
                                                        <button type="button" class="btn btn-sm btn-danger delete-btn"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $image->id }}"
                                                            aria-label="Delete image">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>


                                                    <!-- Delete Modal -->
                                                    <div class="modal fade" id="deleteModal{{ $image->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="deleteModalLabel{{ $image->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-danger">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title"
                                                                        id="deleteModalLabel{{ $image->id }}">Confirmer
                                                                        la suppression</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    Êtes-vous sûr de vouloir supprimer cette image ?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Annuler</button>
                                                                    <form method="POST"
                                                                        action="{{ route('caregiver.service.image.destroy', $image->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Supprimer</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center text-muted">Aucune image disponible pour ce
                                                    service.</div>
                                            @endforelse
                                        </div>
                                    </div>

                                    <!-- Files Tab -->
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
                                                                <a href="{{ Storage::url($file->image_path) }}"
                                                                    download="{{ $fileName }}"
                                                                    class="btn btn-primary">
                                                                    <i class="fas fa-download"></i> Télécharger
                                                                </a>

                                                                <!-- Delete Button with Icon (Triggers Modal) -->
                                                                <button type="button" class="btn btn-danger"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#deleteModal{{ $file->id }}">
                                                                    <i class="fas fa-trash"></i> Supprimer
                                                                </button>
                                                            </td>
                                                        </tr>

                                                        <!-- Delete Modal for this file -->
                                                        <div class="modal fade" id="deleteModal{{ $file->id }}"
                                                            tabindex="-1"
                                                            aria-labelledby="deleteModalLabel{{ $file->id }}"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content border-danger">
                                                                    <div class="modal-header bg-danger text-white">
                                                                        <h5 class="modal-title"
                                                                            id="deleteModalLabel{{ $file->id }}">
                                                                            Confirmer la suppression</h5>
                                                                        <button type="button"
                                                                            class="btn-close btn-close-white"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        Êtes-vous sûr de vouloir supprimer ce fichier ?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Annuler</button>
                                                                        <form method="POST"
                                                                            action="{{ route('caregiver.service.image.destroy', $file->id) }}">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Supprimer</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
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

                                                        <video controls
                                                            style="width: 100%; height: 500px; border-radius: 5px;">
                                                            <source src="{{ asset(urlencode($video->image_path)) }}"
                                                                type="video/mp4">
                                                            Your browser does not support the video tag.
                                                        </video>


                                                        <button
                                                            class="btn btn-sm btn-danger position-absolute top-0 end-0 m-2"
                                                            data-bs-toggle="modal"
                                                            data-bs-target="#deleteModal{{ $video->id }}">
                                                            <i class="fa fa-trash"></i>
                                                        </button>
                                                    </div>

                                                    <!-- Delete Modal for this video -->
                                                    <div class="modal fade" id="deleteModal{{ $video->id }}"
                                                        tabindex="-1"
                                                        aria-labelledby="deleteModalLabel{{ $video->id }}"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content border-danger">
                                                                <div class="modal-header bg-danger text-white">
                                                                    <h5 class="modal-title"
                                                                        id="deleteModalLabel{{ $video->id }}">Confirmer
                                                                        la suppression</h5>
                                                                    <button type="button"
                                                                        class="btn-close btn-close-white"
                                                                        data-bs-dismiss="modal"
                                                                        aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">Êtes-vous sûr de vouloir supprimer
                                                                    cette vidéo ?</div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-bs-dismiss="modal">Annuler</button>
                                                                    <form method="POST"
                                                                        action="{{ route('caregiver.service.image.destroy', $video->id) }}">
                                                                        @csrf
                                                                        @method('DELETE')
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Supprimer</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            @empty
                                                <div class="col-12 text-center text-muted">Aucune vidéo disponible pour ce
                                                    service.</div>
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
