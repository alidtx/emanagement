<?php

namespace App\Services;

use App\Models\File;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class FileUploadService
{

    static function uploadOne($request_file, $file_dir, $folderLocation, $oldFile = null, $disk = "public")
    {

        try {

            if ($oldFile != null) {
                self::deleteOne($oldFile, $disk);
            }

            Storage::putFile($file_dir, $request_file, $disk);

            $file_path = $folderLocation . '/' . $request_file->hashName();

          return $file_path;
        } catch (Exception $exception) {
            Log::error("FileUploadService::uploadOne()" . $exception);
          return false;
        }
    }

    static function deleteOne($file_path, $disk)
    {
        if (Storage::exists($disk . '/' . $file_path)) {
            Storage::delete($disk . '/' . $file_path);
        }
    }

    static function multipleFileStore($data)
    {
        foreach ($data["files"] as $file) {
            File::create([
                'model' => $data["model"],
                'model_id' => $data["model_id"],
                'type' => $data["type"],
                "file_path" => (new FileUploadService())->uploadOne($file, "public/{$data["type"]}", $data["type"])
            ]);
        }
    }
    static function multipleFileDelete($files)
    {
        foreach ($files as $file) {
            (new FileUploadService())->deleteOne($file->file_path, "public");
        }
    }
}
