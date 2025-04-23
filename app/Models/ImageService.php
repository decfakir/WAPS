<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImageService extends Model
{
    use HasFactory, SoftDeletes; // Add SoftDeletes here

    protected $fillable = ['service_id', 'image_path'];

    public static function filterByType($medias, $type)
    {
        $extensions = [
            'image' => ['jpg', 'jpeg', 'png', 'gif'],
            'video' => ['mp4', 'webm', 'ogg', 'mov', 'avi'],
            'pdf' => ['pdf'],
        ];

        return $medias->filter(function ($media) use ($extensions, $type) {
            return in_array(
                strtolower(pathinfo($media->file_path, PATHINFO_EXTENSION)),
                $extensions[$type] ?? []
            );
        });
    }
    public function service()
    {
        return $this->belongsTo(Service::class);
    }
}
