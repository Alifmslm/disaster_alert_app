<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SafetyGuideResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'             => $this->id,
            'judul'          => $this->title,
            'deskripsi'      => $this->description,
            'konten_edukasi' => $this->content,
            'tipe_bencana'   => $this->disaster_type,
            'gambar_panduan' => $this->image_url,
            'video_url'      => $this->video_url, 
        ];
    }
}