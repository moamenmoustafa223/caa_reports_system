<?php
/**
 * PWA Icon Generator from Logo
 * Place your logo at public/logo.png (512x512 recommended)
 * Usage: php generate-icons-from-logo.php
 */

$logoPath = __DIR__ . '/public/logo.png';
$outputDir = __DIR__ . '/public/images/icons/';

if (!file_exists($logoPath)) {
    die("Error: Logo not found at {$logoPath}\nPlease place your logo at public/logo.png\n");
}

// Create directory if not exists
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

$sizes = [72, 96, 128, 144, 152, 192, 384, 512];

// Load the original logo
$logoInfo = getimagesize($logoPath);
$logoMime = $logoInfo['mime'];

switch ($logoMime) {
    case 'image/png':
        $sourceLogo = imagecreatefrompng($logoPath);
        break;
    case 'image/jpeg':
        $sourceLogo = imagecreatefromjpeg($logoPath);
        break;
    case 'image/gif':
        $sourceLogo = imagecreatefromgif($logoPath);
        break;
    default:
        die("Error: Unsupported image format. Please use PNG, JPEG, or GIF.\n");
}

if (!$sourceLogo) {
    die("Error: Could not load logo image.\n");
}

$sourceWidth = imagesx($sourceLogo);
$sourceHeight = imagesy($sourceLogo);

foreach ($sizes as $size) {
    // Create new image with transparency
    $image = imagecreatetruecolor($size, $size);

    // Enable transparency
    imagealphablending($image, false);
    imagesavealpha($image, true);
    $transparent = imagecolorallocatealpha($image, 0, 0, 0, 127);
    imagefill($image, 0, 0, $transparent);
    imagealphablending($image, true);

    // Resize and copy logo to new image
    imagecopyresampled(
        $image, $sourceLogo,
        0, 0, 0, 0,
        $size, $size,
        $sourceWidth, $sourceHeight
    );

    // Save as PNG
    $filename = $outputDir . "icon-{$size}x{$size}.png";
    imagepng($image, $filename, 9);
    imagedestroy($image);

    echo "Created: $filename\n";
}

imagedestroy($sourceLogo);

echo "\nAll icons generated successfully!\n";
echo "You can now delete this script: generate-icons-from-logo.php\n";
