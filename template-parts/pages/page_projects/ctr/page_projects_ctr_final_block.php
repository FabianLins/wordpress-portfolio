<?php
if ($finalBlock !== "") {
    preg_match("/<!-- wp:image {([\s\S]*)} -->/", $finalBlock, $matches);
    $finalImgData = ($matches[1]);
    $finalImgID   = -1;
    // Paragraph
    $finalParagraphsLen = substr_count($finalBlock, "<!-- wp:paragraph -->");
    $finalParagraphs    = [];
    $finalPStart        = 0;
    $finalPEnd          = 0;
    for ($j = 0; $j < $finalParagraphsLen; $j++) {
        if ($j === 0) {
            $finalPStart = strpos($finalBlock, "<!-- wp:paragraph -->", $finalPStart);
            $finalPEnd   = strpos($finalBlock, "<!-- /wp:paragraph -->", $finalPEnd);
        } else {
            $finalPStart = strpos($finalBlock, "<!-- wp:paragraph -->", $finalPStart + 1);
            $finalPEnd   = strpos($finalBlock, "<!-- /wp:paragraph -->", $finalPEnd + 1);
        }
        $finalPLen             = $finalPEnd - $finalPStart;
        $finalParagraphContent = getParagraphContent(substr($finalBlock, $finalPStart, $finalPLen));
        $finalParagraphs[$j]   = $finalParagraphContent[1];
    }
    // Image
    $finalCurrImgData = str_replace('"', '', $finalImgData); // Remove quotation marks (")
    $searchFor        = "id:";
    $searchForLen     = strlen($searchFor);
    if (substr($finalCurrImgData, 0, $searchForLen) === $searchFor) {
        $finalImgID = substr($finalCurrImgData, $searchForLen, (strlen($finalCurrImgData) - $searchForLen));
    }
    $finalHeadlineEnd     = strpos($finalBlock, "<!-- /wp:heading -->");
    $finalHeadline        = substr($finalBlock, 0, $finalHeadlineEnd);
    $finalHeadlineContent = getHeadlineContent($finalHeadline)[2];
    // Button
    $finalButtonsLen = substr_count($finalBlock, "<!-- wp:button -->");
    $finalButtons    = [];
    $finalBtnOffset  = 0;
    $finalBtnStart   = 0;
    $finalBtnEnd     = 0;
    for ($j = 0; $j < $finalButtonsLen; $j++) {
        if ($j === 0) {
            $finalBtnStart = strpos($finalBlock, "<!-- wp:button -->", $finalBtnStart);
            $finalBtnEnd   = strpos($finalBlock, "<!-- /wp:button -->", $finalBtnEnd);
        } else {
            $finalBtnStart = strpos($finalBlock, "<!-- wp:button -->", $finalBtnStart + 1);
            $finalBtnEnd   = strpos($finalBlock, "<!-- /wp:button -->", $finalBtnEnd + 1);
        }
        $finalBtnLen        = $finalBtnEnd - $finalBtnStart;
        $finalBtnStr        = substr($finalBlock, $finalBtnStart, $finalBtnLen);
        $finalButtonContent = getLinkContent($finalBtnStr);
        if ($finalButtonContent[3]) {
            $finalButtons[$j]["href"]    = $finalButtonContent[1];
            $finalButtons[$j]["content"] = $finalButtonContent[3];
        } else {
            $finalButtons[$j]["href"]    = false;
            $finalButtons[$j]["content"] = $finalButtonContent[1];
        }
        $finalButtons[$j]["new-tab"] = false;
        if (strpos($finalButtonContent[0], "target=\"_blank\"") !== false) {
            $finalButtons[$j]["new-tab"] = true;
        }
    }
}