<?php
// Fichiers autorisés avec leur URL raw sur GitHub
$allowedFiles = [
    'cv' => [
        'url' => "https://github.com/MirokaZAER/siteweb/raw/main/CV_LM.pdf",
        'filename' => "CV_LM.pdf"
    ],
    'referencement' => [
        'url' => "https://github.com/MirokaZAER/siteweb/raw/main/referencement.pdf",
        'filename' => "referencement.pdf"
    ]
];

if (!isset($_GET['file']) || !array_key_exists($_GET['file'], $allowedFiles)) {
    die("Fichier non autorisé.");
}

$fileInfo = $allowedFiles[$_GET['file']];
$fileUrl = $fileInfo['url'];
$filename = $fileInfo['filename'];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $fileUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$data = curl_exec($ch);
if (curl_errno($ch)) {
    die("Erreur lors du téléchargement : " . curl_error($ch));
}
curl_close($ch);

header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
header('Content-Length: ' . strlen($data));

echo $data;
exit;
?>
