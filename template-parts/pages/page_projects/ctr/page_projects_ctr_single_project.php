<?php
// Headline
$headlineEnd     = strpos($currProject, "<!-- /wp:heading -->");
$headline        = substr($currProject, 0, $headlineEnd);
$headlineContent = getHeadlineContent($headline)[2];
// Paragraphs
$paragraphsLen = substr_count($currProject, "<!-- wp:paragraph -->");
$paragraphs    = [];
$pStart        = 0;
$pEnd          = 0;
for ($j = 0; $j < $paragraphsLen; $j++) {
    if ($j === 0) {
        $pStart = strpos($currProject, "<!-- wp:paragraph -->", $pStart);
        $pEnd   = strpos($currProject, "<!-- /wp:paragraph -->", $pEnd);
    } else {
        $pStart = strpos($currProject, "<!-- wp:paragraph -->", $pStart + 1);
        $pEnd   = strpos($currProject, "<!-- /wp:paragraph -->", $pEnd + 1);
    }
    $pLen             = $pEnd - $pStart;
    $paragraphContent = getParagraphContent(substr($currProject, $pStart, $pLen));
    $paragraphs[$j]   = $paragraphContent[1];
}
$projectInfo    = [$paragraphs[0], $paragraphs[1]];
$projectInfo[0] = str_replace("{#made with}", "", $projectInfo[0]);
$madeWithArr    = explode(',', $projectInfo[0]);
$madeWithArrLen = count($madeWithArr);
$projectInfo[0] = "<strong>";
if ($madeWithArrLen > 1) {
    for ($j = 0; $j < ($madeWithArrLen - 1); $j++) {
        $projectInfo[0] .= $madeWithArr[$j] . ",";
    }
    $projectInfo[0] = substr($projectInfo[0], 0, strlen($projectInfo[0]) - 1);
    $projectInfo[0] .= "</strong> and <strong>" . $madeWithArr[$madeWithArrLen - 1] . "</strong>";
} else {
    $projectInfo[0] = $madeWithArr[0];
}
$projectInfo[0] = "made with " . $projectInfo[0];
if (strpos($projectInfo[1], "{#created in}") === 0) {
    $projectInfo[1] = str_replace("{#created in}", "", $projectInfo[1]);
    $projectInfo[1] = "created in <strong>" . $projectInfo[1] . "</strong>";
} elseif (strpos($projectInfo[1], "{#created from}") === 0) {
    $currProjectInfo = $projectInfo[1];
    preg_match("/{#created from} ([\s\S]*) {#to}/", $projectInfo[1], $matches);
    $projectInfo[1] = "created from <strong>" . $matches[1] . "</strong>";
    $toDateStartPos = strpos($currProjectInfo, "{#to}") + strlen("{#to}") + 1;
    $toDateLength   = strlen($currProjectInfo) - $toDateStartPos;
    $toDate         = substr($currProjectInfo, $toDateStartPos, $toDateLength);
    $projectInfo[1] .= " to <strong>" . $toDate . "</strong>";
}
$projectState = $paragraphs[2];
// Modal
$modal = $paragraphs[3];
$modal = strtolower($modal);
preg_match("/{#modal([\s\S]*)}/", $modal, $matches);
$modal = "modal" . $matches[1];
// Buttons
$buttonsLen = substr_count($currProject, "<!-- wp:button -->");
$buttons    = [];
$btnOffset  = 0;
$btnStart   = 0;
$btnEnd     = 0;
for ($j = 0; $j < $buttonsLen; $j++) {
    if ($j === 0) {
        $btnStart = strpos($currProject, "<!-- wp:button -->", $btnStart);
        $btnEnd   = strpos($currProject, "<!-- /wp:button -->", $btnEnd);
    } else {
        $btnStart = strpos($currProject, "<!-- wp:button -->", $btnStart + 1);
        $btnEnd   = strpos($currProject, "<!-- /wp:button -->", $btnEnd + 1);
    }
    $btnLen        = $btnEnd - $btnStart;
    $btnStr        = substr($currProject, $btnStart, $btnLen);
    $buttonContent = getLinkContent($btnStr);
    if ($buttonContent[3]) {
        $buttons[$j]["href"]    = $buttonContent[1];
        $buttons[$j]["content"] = $buttonContent[3];
    } else {
        $buttons[$j]["href"]    = false;
        $buttons[$j]["content"] = $buttonContent[1];
    }
    $buttons[$j]["new-tab"] = false;
    if (strpos($buttonContent[0], "target=\"_blank\"") !== false) {
        $buttons[$j]["new-tab"] = true;
    }
}
// Image
preg_match("/<!-- wp:image {([\s\S]*)} -->/", $currProject, $matches);
$imgData = ($matches[1]);
$imgData = explode(',', $imgData);
$imgID   = -1;
for ($j = 0; $j < count($imgData); $j++) {
    $currImgData  = str_replace('"', '', $imgData[$j]); // Remove quotation marks (")
    $searchFor    = "id:";
    $searchForLen = strlen($searchFor);
    if (substr($currImgData, 0, $searchForLen) === $searchFor) {
        $imgID = substr($currImgData, $searchForLen, (strlen($currImgData) - $searchForLen));
        break;
    }
}