<?php
/**
 * PWA Icon Generator from SVG Logo
 * Uses public/logo.svg to generate all PWA icons
 * Usage: php generate-icons-from-svg.php
 */

$svgPath = __DIR__ . '/public/logo.svg';
$outputDir = __DIR__ . '/public/images/icons/';

if (!file_exists($svgPath)) {
    die("Error: SVG logo not found at {$svgPath}\n");
}

// Create directory if not exists
if (!is_dir($outputDir)) {
    mkdir($outputDir, 0755, true);
}

$sizes = [72, 96, 128, 144, 152, 192, 384, 512];

// Read SVG content
$svgContent = file_get_contents($svgPath);

foreach ($sizes as $size) {
    echo "Generating icon-{$size}x{$size}.png...\n";

    // Try using ImageMagick first
    $imagickAvailable = extension_loaded('imagick');

    if ($imagickAvailable) {
        try {
            $imagick = new Imagick();
            $imagick->readImageBlob($svgContent);
            $imagick->setImageFormat('png');
            $imagick->resizeImage($size, $size, Imagick::FILTER_LANCZOS, 1);
            $imagick->setImageBackgroundColor('transparent');
            $imagick->setImageAlphaChannel(Imagick::ALPHACHANNEL_ACTIVATE);

            $filename = $outputDir . "icon-{$size}x{$size}.png";
            $imagick->writeImage($filename);
            $imagick->clear();

            echo "  ✓ Created: $filename (using Imagick)\n";
            continue;
        } catch (Exception $e) {
            echo "  ✗ Imagick failed: " . $e->getMessage() . "\n";
        }
    }

    // Fallback: Use Inkscape command line
    $filename = $outputDir . "icon-{$size}x{$size}.png";
    $command = "inkscape \"$svgPath\" --export-filename=\"$filename\" --export-width=$size --export-height=$size 2>&1";
    exec($command, $output, $returnCode);

    if ($returnCode === 0 && file_exists($filename)) {
        echo "  ✓ Created: $filename (using Inkscape)\n";
        continue;
    }

    // Fallback: Use rsvg-convert
    $command = "rsvg-convert -w $size -h $size \"$svgPath\" -o \"$filename\" 2>&1";
    exec($command, $output, $returnCode);

    if ($returnCode === 0 && file_exists($filename)) {
        echo "  ✓ Created: $filename (using rsvg-convert)\n";
        continue;
    }

    echo "  ✗ Failed to generate icon-{$size}x{$size}.png\n";
    echo "     Please install Imagick extension or Inkscape/rsvg-convert\n";
}

echo "\n";
echo "================================================\n";
echo "Icon generation process completed!\n";
echo "================================================\n";
echo "\nIf some icons failed to generate, you can:\n";
echo "1. Install PHP Imagick extension: https://www.php.net/manual/en/book.imagick.php\n";
echo "2. Or install Inkscape: https://inkscape.org/\n";
echo "3. Or use an online converter: https://convertio.co/svg-png/\n";
echo "\nYou can now delete this script: generate-icons-from-svg.php\n";
