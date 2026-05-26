<!DOCTYPE html>
<html lang="sq">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1">
<base href="/UEB2_Projekti_Grupi36/">
<title>NetWave - Operator Telekomunikacioni</title>

<?php
$mainCssPath = $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/assets/css/telecomoperator.css';
$mainCssVersion = file_exists($mainCssPath) ? filemtime($mainCssPath) : time();
?>
<link rel="stylesheet" href="/UEB2_Projekti_Grupi36/assets/css/telecomoperator.css?v=<?php echo $mainCssVersion; ?>">

<?php
if(isset($pageCSS)){
    $pageCssPath = $_SERVER['DOCUMENT_ROOT'] . '/UEB2_Projekti_Grupi36/assets/css/' . $pageCSS;
    $pageCssVersion = file_exists($pageCssPath) ? filemtime($pageCssPath) : time();
    echo '<link rel="stylesheet" href="/UEB2_Projekti_Grupi36/assets/css/' . $pageCSS . '?v=' . $pageCssVersion . '">';
}
?>
</head>
<body>
