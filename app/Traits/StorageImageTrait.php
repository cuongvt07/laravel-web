<?php

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Strorage;

trait StorageImageTrait
{

    public function StorageTraitUpload($request, $fieldName, $foderName)
    {
        if ($request->hasFile($fieldName)) {
            $file = $request->$fieldName;
            $fileNameOrigin = $file->getClientOriginalName();
            $fileNameHash = str::random(20) . '.' . $file->getClientOriginalName();
            $filePath = $request->file($fieldName)->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);
            $dataUploadTrait = [
                'file_name' => $fileNameOrigin,
                'file_path' => Storage::url($filePath)
            ];
            return $dataUploadTrait;
        }
        return null;
    }

    public function StorageTraitUploadMutiple($file, $foderName)
    {
        $fileNameOrigin = $file->getClientOriginalName();
        $fileNameHash = str::random(20) . '.' . $file->getClientOriginalName();
        $filePath = $file->storeAs('public/' . $foderName . '/' . auth()->id(), $fileNameHash);
        $dataUploadTrait = [
            'file_name' => $fileNameOrigin,
            'file_path' => Storage::url($filePath)
        ];
        return $dataUploadTrait;
    }
}
