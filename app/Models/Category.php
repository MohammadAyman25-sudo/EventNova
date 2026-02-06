<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    protected $fillable = [
        'name',
        'slug',
        'color',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function getGradientAttribute(): string
    {
        return match($this->color) {
            '#A855F7' => '#EC4899',
            '#3B82F6' => '#06B6D4',
            '#22C55E' => '#10B981',
            '#F97316' => '#EF4444',
            '#EAB308' => '#F97316',
            '#6366F1' => '#A855F7',
            '#14B8a6' => '#22C55E',
            '#EC4899' => '#F43F5E',
            '#8B5CF6' => '#A855F7',
            '#0EA5E9' => '#3B82F6',
            '#D946EF' => '#EC4899',
            '#06B6D4' => '#3B82F6',
            default => $this->generateDynamicGradient($this->color),
        };
    }

    private function generateDynamicGradient(string $baseColor): string
    {
        // Convert hex to HSL
        $hsl = $this->hexToHsl($baseColor);
        
        // Create harmonious end color (same hue, different saturation/lightness)
        $endHsl = [
            $hsl[0], // Same hue
            min(100, $hsl[1] + 20), // Slightly more saturated
            max(0, $hsl[2] - 20) // Slightly darker
        ];
        
        $endColor = $this->hslToHex($endHsl);
        
        return $endColor;
    }

    private function hexToHsl(string $hex): array
    {
        // Remove #
        $hex = ltrim($hex, '#');
        
        // Expand shorthand
        if (strlen($hex) === 3) {
            $hex = $hex[0].$hex[0].$hex[1].$hex[1].$hex[2].$hex[2];
        }
        
        // Convert to RGB
        $r = hexdec(substr($hex, 0, 2)) / 255;
        $g = hexdec(substr($hex, 2, 2)) / 255;
        $b = hexdec(substr($hex, 4, 2)) / 255;
        
        $max = max($r, $g, $b);
        $min = min($r, $g, $b);
        
        // Calculate Lightness
        $l = ($max + $min) / 2;
        
        if ($max == $min) {
            $h = $s = 0; // Achromatic
        } else {
            $d = $max - $min;
            $s = $l > 0.5 ? $d / (2 - $max - $min) : $d / ($max + $min);
            
            switch ($max) {
                case $r: $h = ($g - $b) / $d + ($g < $b ? 6 : 0); break;
                case $g: $h = ($b - $r) / $d + 2; break;
                case $b: $h = ($r - $g) / $d + 4; break;
            }
            
            $h /= 6;
        }
        
        return [
            'h' => round($h * 360, 2),
            's' => round($s * 100, 2),
            'l' => round($l * 100, 2),
        ];
    }

    private function hslToHex(array $hsl): string
    {
        // Extract and normalize values
        $h = fmod($hsl['h'], 360); // Keep hue within 0-360
        $s = max(0, min(100, $hsl['s'])) / 100;
        $l = max(0, min(100, $hsl['l'])) / 100;

        // Calculate chroma and intermediate values
        $c = (1 - abs(2 * $l - 1)) * $s;
        $x = $c * (1 - abs(fmod($h / 60, 2) - 1));
        $m = $l - ($c / 2);

        // Determine RGB primes based on hue sector
        if ($h < 60) {
            [$r1, $g1, $b1] = [$c, $x, 0];
        } elseif ($h < 120) {
            [$r1, $g1, $b1] = [$x, $c, 0];
        } elseif ($h < 180) {
            [$r1, $g1, $b1] = [0, $c, $x];
        } elseif ($h < 240) {
            [$r1, $g1, $b1] = [0, $x, $c];
        } elseif ($h < 300) {
            [$r1, $g1, $b1] = [$x, 0, $c];
        } else {
            [$r1, $g1, $b1] = [$c, 0, $x];
        }

        // Convert to 0-255 RGB and then to HEX
        $r = round(($r1 + $m) * 255);
        $g = round(($g1 + $m) * 255);
        $b = round(($b1 + $m) * 255);

        return sprintf('#%02x%02x%02x', $r, $g, $b);
    }
}
