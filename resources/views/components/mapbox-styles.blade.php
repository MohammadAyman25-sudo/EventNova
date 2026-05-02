{{-- Shared Mapbox CSS – include via <x-mapbox-styles /> in map pages --}}
<link href="https://api.mapbox.com/mapbox-gl-js/v3.3.0/mapbox-gl.css" rel="stylesheet">
<link rel="stylesheet" href="https://api.mapbox.com/mapbox-gl-js/plugins/mapbox-gl-geocoder/v5.0.0/mapbox-gl-geocoder.css" type="text/css">
<style>
    .eventnova-map { width: 100%; height: 380px; border-radius: 1rem; }
    .eventnova-map-readonly { width: 100%; height: 300px; border-radius: 1rem; }

    /* ── Geocoder – light ─────────────────────────────────────────── */
    .mapboxgl-ctrl-geocoder {
        width: 100% !important; max-width: none !important;
        border-radius: 0.75rem !important;
        border: 1px solid #d1d5db !important;
        background: #fff !important;
        box-shadow: 0 1px 4px rgba(0,0,0,.08) !important;
        font-family: inherit !important;
        margin-bottom: 1rem !important;
    }
    .mapboxgl-ctrl-geocoder--input {
        height: 44px !important; color: #111827 !important;
        font-size: .875rem !important;
        padding-left: 2.5rem !important;
    }
    .mapboxgl-ctrl-geocoder--iinput::placeholder { color: #9ca3af !important; }
    .mapboxgl-ctrl-geocoder--icon { fill: #6b7280 !important; }
    .mapboxgl-ctrl-geocoder--icon-close { fill: #6b7280 !important; }
    .mapboxgl-ctrl-geocoder .suggestions {
        background: #fff !important; border: 1px solid #e5e7eb !important;
        border-radius: .75rem !important; margin-top: .25rem !important;
        overflow: hidden !important; box-shadow: 0 8px 24px rgba(0,0,0,.12) !important;
    }
    .mapboxgl-ctrl-geocoder .suggestions > li > a {
        padding: .75rem 1rem !important; border-bottom: 1px solid #f3f4f6 !important;
        cursor: pointer !important;
    }
    .mapboxgl-ctrl-geocoder .suggestions > li > a:hover,
    .mapboxgl-ctrl-geocoder .suggestions > .active > a { background: #f3f4f6 !important; }
    .mapboxgl-ctrl-geocoder--suggestion-title {
        color: #111827 !important; font-weight: 600 !important; font-size: .875rem !important;
    }
    .mapboxgl-ctrl-geocoder--suggestion-address {
        color: #4b5563 !important; font-size: .75rem !important;
    }

    /* ── Geocoder – dark ──────────────────────────────────────────── */
    .dark .mapboxgl-ctrl-geocoder {
        background: #1f2937 !important; border-color: #374151 !important;
    }
    .dark .mapboxgl-ctrl-geocoder--input { color: #f9fafb !important; }
    .dark .mapboxgl-ctrl-geocoder--input::placeholder { color: #6b7280 !important; }
    .dark .mapboxgl-ctrl-geocoder--icon,
    .dark .mapboxgl-ctrl-geocoder--icon-close { fill: #9ca3af !important; }
    .dark .mapboxgl-ctrl-geocoder .suggestions {
        background: #1f2937 !important; border-color: #374151 !important;
    }
    .dark .mapboxgl-ctrl-geocoder .suggestions > li > a { border-bottom-color: #374151 !important; }
    .dark .mapboxgl-ctrl-geocoder .suggestions > li > a:hover,
    .dark .mapboxgl-ctrl-geocoder .suggestions > .active > a { background: #111827 !important; }
    .dark .mapboxgl-ctrl-geocoder--suggestion-title { color: #f9fafb !important; }
    .dark .mapboxgl-ctrl-geocoder--suggestion-address { color: #9ca3af !important; }

    /* ── Geocoder Icons fix ───────────────────────────────────────── */
    .mapboxgl-ctrl-geocoder--icon-search {
        top: 50% !important;
        transform: translateY(-50%) !important;
    }
    .mapboxgl-ctrl-geocoder--button {
        background: transparent !important;
        top: 50% !important;
        transform: translateY(-50%) !important;
    }
    .mapboxgl-ctrl-geocoder--icon-close {
        background: transparent !important;
        margin-top: 0 !important;
    }

    /* ── RTL geocoder overrides ───────────────────────────────────── */
    html[dir="rtl"] .mapboxgl-ctrl-geocoder--input {
        text-align: right !important;
        padding-right: 2.5rem !important;
        padding-left: 2.5rem !important;
    }
    html[dir="rtl"] .mapboxgl-ctrl-geocoder--icon-search {
        right: .75rem !important; left: auto !important;
    }
    html[dir="rtl"] .mapboxgl-ctrl-geocoder--button {
        left: .75rem !important; right: auto !important;
    }
</style>
