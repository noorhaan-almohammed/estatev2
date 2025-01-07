<?php

namespace App\Http\Services;

use Exception;
use App\Models\Attachment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\File\Exception\FileException;

class AssetsService
{
    public function storeAttachment($file, $transactionId)
    {
        $message = '';
        $originalName = $file->getClientOriginalName();
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);

        if (!$extension || strpos($originalName, '..') !== false || strpos($originalName, '/') !== false || strpos($originalName, '\\') !== false) {
            throw new Exception(trans('general.notAllowedAction'), 403);
        }

        $allowedMimeTypes = [
            'image/jpeg',
            'image/jpg',
            'image/png',
            'image/gif',
            'image/webp',
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
        ];

        $mime_type = $file->getClientMimeType();
        if (!in_array($mime_type, $allowedMimeTypes)) {
            throw new FileException("الملف غير مدعوم '{$originalName}' ", 403);
        }

        $fileName = Str::random(32);
        $filePath = "attachments/{$fileName}.{$extension}";
        $fileContent = file_get_contents($file);

        if ($fileContent === false || !Storage::disk('local')->put($filePath, $fileContent)) {
            throw new Exception("حدث خطأ أثناء تخزين الملف '{$originalName}'. الرجاء المحاولة مرة أخرى.", 500);
        }

        $attachment = Attachment::create([
            'name' => $originalName,
            'path' => $filePath,
            'transaction_id' => $transactionId,
        ]);

        return ['attachment' => $attachment, 'message' => $message];
    }
}
