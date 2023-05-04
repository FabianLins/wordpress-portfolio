<?php
function getHeadlineContent($headline)
{
    $matches = [];
    preg_match("/<h(1|2|3|4|5|6).*?>([\s\S]*)<\/h.*?>/", $headline, $matches);
    return $matches;
}

function getParagraphContent($paragraph)
{
    $matches = [];
    preg_match("/<p.*?>([\s\S]*)<\/p>/", $paragraph, $matches);
    return $matches;
}

function getLinkContent($link)
{
    $matches = [];
    if (strpos($link, "href") !== false) {
        preg_match("/<a.* href=\"(.*?)\"(.*?)>([\s\S]*)<\/a>/", $link, $matches);
    } else {
        preg_match("/<a.*>([\s\S]*)<\/a>/", $link, $matches);
    }
    return $matches;
}

function sanitizeMarkup($input)
{
    return preg_replace("/<!--(.*)-->/Uis", "", $input);
}