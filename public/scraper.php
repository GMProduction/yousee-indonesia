<?php
header("Content-Type: application/json");

function ambilLinkGambar($slug) {
    $DETAIL_BASE_URL = "https://www.yousee-indonesia.com/id/listing/";
    $url = $DETAIL_BASE_URL . $slug;

    $html = @file_get_contents($url);
    if (!$html) {
        return ["url" => $url, "images" => []];
    }

    // Cari <img> di dalam <div class="detailtitik-wrapper">
    preg_match_all(
        '/<div class="detailtitik-wrapper">.*?<img[^>]+src="([^">]+)".*?<\/div>/is',
        $html,
        $matches
    );

    return [
        "url" => $url,
        "images" => $matches[1] ?? []
    ];
}

$slug = $_GET['slug'] ?? null;
if ($slug) {
    $data = ambilLinkGambar($slug);
    $imgUrl = $data['images'][0] ?? null;
    echo json_encode(["imgUrl" => $imgUrl, "url" => $data['url']]);
} else {
    echo json_encode(["error" => "Slug tidak diberikan"]);
}
