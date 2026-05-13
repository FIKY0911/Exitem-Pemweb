<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;

Route::post('/test-upload', function (Request $request) {
    try {
        Log::info('Test upload hit', ['hasFiles' => $request->hasFile('file'), 'all' => $request->all()]);

        if (! $request->hasFile('file')) {
            return response()->json(['error' => 'No file uploaded', 'input' => $request->input()], 400);
        }

        $file = $request->file('file');
        Log::info('File info', [
            'original' => $file->getClientOriginalName(),
            'size' => $file->getSize(),
            'mime' => $file->getMimeType(),
            'error' => $file->getError(),
            'tmp' => $file->getRealPath(),
        ]);

        $disk = config('filesystems.default');
        $result = FileUploadConfiguration::storeTemporaryFile($file, $disk);

        Log::info('Store result', ['result' => $result]);

        // List files
        $files = Storage::disk($disk)->allFiles(FileUploadConfiguration::directory());

        return response()->json([
            'success' => true,
            'path' => $result,
            'files' => $files,
        ]);
    } catch (Throwable $e) {
        Log::error('Upload error: '.$e->getMessage(), ['trace' => $e->getTraceAsString()]);

        return response()->json(['error' => $e->getMessage(), 'trace' => $e->getTraceAsString()], 500);
    }
});
