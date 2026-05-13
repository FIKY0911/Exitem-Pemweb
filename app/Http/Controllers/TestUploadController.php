<?php

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Features\SupportFileUploads\FileUploadConfiguration;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

echo "=== Livewire Upload Test ===\n\n";

// Create fake image file
$tmpPath = '/tmp/test_image_'.time().'.jpg';
file_put_contents($tmpPath, str_repeat('*', 5000));
echo "Created fake image: $tmpPath (".filesize($tmpPath)." bytes)\n";

// Simulate UploadedFile
$uploadedFile = new UploadedFile($tmpPath, 'brand-logo.jpg', 'image/jpeg', null, true);
echo 'UploadedFile created: '.$uploadedFile->getClientOriginalName()."\n";

// Generate hash name
$hashName = TemporaryUploadedFile::generateHashName($uploadedFile);
echo "Generated hash name: $hashName\n";

// Show configuration
$disk = config('livewire.temporary_file_upload.disk') ?: config('filesystems.default');
echo "Using disk: $disk\n";
$directory = FileUploadConfiguration::directory();
echo "Using directory: $directory\n";

// Store temporary file (Livewire method)
echo "\n=== Storing Temporary File ===\n";
try {
    $result = FileUploadConfiguration::storeTemporaryFile($uploadedFile, $disk);
    echo "storeTemporaryFile returned: $result\n";
} catch (Exception $e) {
    echo 'ERROR: '.$e->getMessage()."\n";
    echo $e->getTraceAsString()."\n";
}

// Check what got stored
echo "\n=== Checking storage ===\n";
$storage = Storage::disk($disk);
$allFiles = $storage->allFiles(FileUploadConfiguration::directory());
echo 'All files in '.FileUploadConfiguration::directory().":\n";
foreach ($allFiles as $file) {
    $size = $storage->size($file);
    echo " - $file (".$size." bytes)\n";
}

// Specifically check binary file
$expectedBinary = FileUploadConfiguration::path($hashName, false);
echo "\nBinary file expected at: $expectedBinary\n";
echo 'Exists? '.($storage->exists($expectedBinary) ? 'YES' : 'NO')."\n";
if ($storage->exists($expectedBinary)) {
    echo 'Size: '.$storage->size($expectedBinary)." bytes\n";
}

// Check metadata
$expectedMeta = $expectedBinary.'.json';
echo "\nMetadata expected at: $expectedMeta\n";
echo 'Exists? '.($storage->exists($expectedMeta) ? 'YES' : 'NO')."\n";
if ($storage->exists($expectedMeta)) {
    echo 'Content: '.$storage->get($expectedMeta)."\n";
}

// Cleanup test files
echo "\n=== Cleaning up test files ===\n";
$storage->delete($expectedBinary);
$storage->delete($expectedMeta);
unlink($tmpPath);
echo "Done.\n";
