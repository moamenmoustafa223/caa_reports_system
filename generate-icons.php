<?php
/**
 * PWA Icon Generator
 * Run this script once to generate all PWA icons
 * Usage: php generate-icons.php
 */

$sizes = [72, 96, 128, 144, 152, 192, 384, 512];
$outputDir = __DIR__ . '/public/images/icons/';

// Create directory if not exists
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

foreach ($sizes as $size) {
    // Create image
    $image = imagecreatetruecolor($size, $size);

    // Colors
    $bgColor = imagecolorallocate($image, 38, 39, 97); // #262761
    $textColor = imagecolorallocate($image, 255, 255, 255); // white

    // Fill background
    imagefill($image, 0, 0, $bgColor);

    // Add text
    $text = 'CAA';
    $fontSize = $size / 4;

    // Calculate text position (center)
    $bbox = imagettfbbox($fontSize, 0, __DIR__ . '/public/backend/assets/fonts/Inter-Bold.ttf', $text);
    if ($bbox) {
        $textWidth = $bbox[2] - $bbox[0];
        $textHeight = $bbox[1] - $bbox[7];
        $x = ($size - $textWidth) / 2;
        $y = ($size + $textHeight) / 2;

        imagettftext($image, $fontSize, 0, $x, $y, $textColor, __DIR__ . '/public/backend/assets/fonts/Inter-Bold.ttf', $text);
    } else {
        // Fallback: use built-in font
        $fontWidth = imagefontwidth(5) * strlen($text);
        $fontHeight = imagefontheight(5);
        $x = ($size - $fontWidth) / 2;
        $y = ($size - $fontHeight) / 2;
        imagestring($image, 5, $x, $y, $text, $textColor);
    }

    // Save as PNG
    $filename = $outputDir . "icon-{$size}x{$size}.png";
    imagepng($image, $filename);
    imagedestroy($image);

    echo "Created: $filename\n";
}

echo "\nAll icons generated successfully!\n";
echo "You can now delete this script: generate-icons.php\n";
