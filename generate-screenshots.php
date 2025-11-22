<?php
/**
 * PWA Screenshot Generator
 * Run this script once to generate placeholder PWA screenshots
 * Usage: php generate-screenshots.php
 */

$outputDir = __DIR__ . '/public/images/screenshots/';

// Create directory if not exists
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

// Screenshots to generate
$screenshots = [
    ['name' => 'screenshot-wide.png', 'width' => 1280, 'height' => 720],
    ['name' => 'screenshot-mobile.png', 'width' => 540, 'height' => 720],
];

foreach ($screenshots as $screenshot) {
    $width = $screenshot['width'];
    $height = $screenshot['height'];

    // Create image
    $image = imagecreatetruecolor($width, $height);

    // Colors
    $bgColor = imagecolorallocate($image, 38, 39, 97); // #262761
    $textColor = imagecolorallocate($image, 255, 255, 255); // white
    $accentColor = imagecolorallocate($image, 128, 135, 61); // #80873d

    // Fill background
    imagefill($image, 0, 0, $bgColor);

    // Draw a simple UI mockup
    // Header bar
    imagefilledrectangle($image, 0, 0, $width, 60, $accentColor);

    // Content area placeholder
    $contentColor = imagecolorallocate($image, 255, 255, 255);
    imagefilledrectangle($image, 20, 80, $width - 20, $height - 20, $contentColor);

    // Add text
    $text = 'CAA Reporting System';
    imagestring($image, 5, 20, 20, $text, $textColor);

    // Save as PNG
    $filename = $outputDir . $screenshot['name'];
    imagepng($image, $filename);
    imagedestroy($image);

    echo "Created: $filename\n";
}

echo "\nScreenshots generated successfully!\n";
echo "For better quality, replace these with actual app screenshots.\n";
