<?php
declare(strict_types=1);

header('Content-Type: application/json; charset=utf-8');

$action = $_GET['action'] ?? '';

$data = [
    'brands' => [
        ['id' => 'toyota', 'name' => 'Toyota', 'country' => 'Japan'],
        ['id' => 'honda', 'name' => 'Honda', 'country' => 'Japan'],
        ['id' => 'mazda', 'name' => 'Mazda', 'country' => 'Japan'],
        ['id' => 'nissan', 'name' => 'Nissan', 'country' => 'Japan'],
        ['id' => 'subaru', 'name' => 'Subaru', 'country' => 'Japan'],
        ['id' => 'mitsubishi', 'name' => 'Mitsubishi', 'country' => 'Japan'],
    ],
    'featured' => [
        ['brand' => 'Toyota', 'model' => 'Supra'],
        ['brand' => 'Honda', 'model' => 'NSX'],
        ['brand' => 'Nissan', 'model' => 'Skyline GT-R'],
    ],
];

if ($action === 'brands') {
    echo json_encode(['ok' => true, 'action' => 'brands', 'data' => $data['brands']], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($action === 'featured') {
    echo json_encode(['ok' => true, 'action' => 'featured', 'data' => $data['featured']], JSON_UNESCAPED_UNICODE);
    exit;
}

http_response_code(400);
echo json_encode(
    [
        'ok' => false,
        'error' => 'Unknown action',
        'allowed_actions' => ['brands', 'featured'],
    ],
    JSON_UNESCAPED_UNICODE
);
