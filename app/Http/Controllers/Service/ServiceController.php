<?php

namespace App\Http\Controllers\Service;

use App\Http\Controllers\Controller;
use App\Models\Categorie;
use App\Models\ImageService;
use App\Models\Service;
use App\Traits\AuthUserViewSharedDataTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class ServiceController extends Controller
{
    use AuthUserViewSharedDataTrait;

    public function __construct()
    {
        // Call the shareViewData method
        $this->shareViewData();
    }

    public function index()
    {

        $services = Service::where('professional_id', auth()->id())->get();

        return view('caregiver.pages.service-index', compact('services'));
    }

    public function  servicAadmin(){

        $services = Service::all();
        return view('admin.pages.service-index', compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Categorie::all();
        return view('caregiver.pages.service-create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if ($request) {

            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'description' => 'required|string',
                'prix_base' => 'required|numeric',
                'duree_estimee' => 'required',
                'categorie_id' => 'required|exists:categories,id',
                'status' => 'nullable|boolean',
                'piece_jointe' => 'nullable|array',
                'piece_jointe.*' => 'file|mimes:pdf,jpg,jpeg,png,mp4,webm,ogg,mov,avi|max:20480',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // save service
            $service = new Service();
            $service->nom = $request->nom;
            $service->description = $request->description;
            $service->prix_base = $request->prix_base;
            $service->duree_estimee = $request->duree_estimee;
            $service->categorie_id = $request->categorie_id;
            $service->status = $request->has('status') ? true : false;
            $service->professional_id = auth()->id();
            $service->save();

            // save image service
            if ($request->hasFile('piece_jointe')) {
                foreach ($request->file('piece_jointe') as $file) {
                    $file_name = time() . '_' . $file->getClientOriginalName();
                    $file_path = $file->storeAs($service->id, $file_name, 'upload_PieceDejointe');

                    // Get file extension to determine type
                    $extension = strtolower($file->getClientOriginalExtension());

                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $type = 'image';
                    } elseif ($extension === 'pdf') {
                        $type = 'pdf';
                    } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
                        $type = 'video';
                    } else {
                        $type = 'unknown';
                    }

                    // Save to DB
                    $imgaService = new ImageService();
                    $imgaService->service_id = $service->id;
                    $imgaService->image_path = 'uploads/service/' . $file_path;
                    $imgaService->type = $type;
                    $imgaService->save();
                }
            }


            return redirect()->route('caregiver.service.index')->with('success', 'Service créé avec succès.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $service = Service::find($id);


        $images = ImageService::where('service_id', $id)->where('type', 'image')->get();
        $files = ImageService::where('service_id', $id)->where('type', 'pdf')->get();
        $videos = ImageService::where('service_id', $id)->where('type', 'video')->get();

        // dd($images);


        return view('caregiver.pages.service-show', compact('service', 'images', 'files', 'videos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


        $images = ImageService::where('service_id', $id)->where('type', 'image')->get();
        $files = ImageService::where('service_id', $id)->where('type', 'pdf')->get();
        $videos = ImageService::where('service_id', $id)->where('type', 'video')->get();
        $categories = Categorie::all();
        $service = Service::find($id);
        return view('caregiver.pages.service-edit', compact('service', 'categories', 'images', 'files', 'videos'));
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $service)
    {


        if ($request) {

            $validator = Validator::make($request->all(), [
                'nom' => 'required|string|max:255',
                'description' => 'required|string',
                'prix_base' => 'required|numeric',
                'duree_estimee' => 'required',
                'categorie_id' => 'required|exists:categories,id',
                'status' => 'nullable|boolean',
                'piece_jointe' => 'nullable|array',
                'piece_jointe.*' => 'file|mimes:pdf,jpg,jpeg,png,mp4,webm,ogg,mov,avi|max:20480',
            ]);

            if ($validator->fails()) {
                return redirect()
                    ->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            if (!$request->status == 1) {
                $status = 0;
            } else {
                $status = 1;
            }

            // save service
            $service =  Service::where('id', $request->id)->first();
            $service->nom = $request->nom;
            $service->description = $request->description;
            $service->prix_base = $request->prix_base;
            $service->duree_estimee = $request->duree_estimee;
            $service->categorie_id = $request->categorie_id;
            $service->status = $status;
            $service->professional_id = auth()->id();
            $service->save();

            // save image service
            if ($request->hasFile('piece_jointe')) {
                foreach ($request->file('piece_jointe') as $file) {
                    $file_name = time() . '_' . $file->getClientOriginalName();
                    $file_path = $file->storeAs($service->id, $file_name, 'upload_PieceDejointe');

                    // Get file extension to determine type
                    $extension = strtolower($file->getClientOriginalExtension());

                    if (in_array($extension, ['jpg', 'jpeg', 'png', 'gif', 'webp'])) {
                        $type = 'image';
                    } elseif ($extension === 'pdf') {
                        $type = 'pdf';
                    } elseif (in_array($extension, ['mp4', 'webm', 'ogg'])) {
                        $type = 'video';
                    } else {
                        $type = 'unknown';
                    }

                    // Save to DB
                    $imgaService = new ImageService();
                    $imgaService->service_id = $service->id;
                    $imgaService->image_path = 'uploads/service/' . $file_path;
                    $imgaService->type = $type;
                    $imgaService->save();
                }
            }


            return redirect()->route('caregiver.service.index')->with('success', 'Service Modifer avec succès.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {


        $service = Service::find($request->id);

        if ($service) {
            // Delete folder even if just soft deleting
            Storage::disk('upload_PieceDejointe')->deleteDirectory($service->id);
            // Soft delete
            $service->delete();

            return redirect()->route('caregiver.service.index')->with('success', 'Catégorie supprimer avec succès.');
        }
    }

    public function deleteImage(Request $request, $id)
    {


        $image = ImageService::findOrFail($id);
        // dd($image);

        $path = public_path($image->image_path);
        if (file_exists($path)) {
            unlink($path);
        }

        $image->delete();

        // Redirect back to service edit page
        return redirect()
            ->back()
            ->with('success', 'Image supprimée avec succès.');
    }
}
