<?php
/* Template Name: Projects Page */
get_header();
?>

<section class="projects">
    <h2 class="h2 mt-header h-pl animation-slide-in-right">
        <?php the_title() ?>
    </h2>
    <div class="container">
        <?php

        function getHeadlineContent($headline){
            $matches = [];
            preg_match("/<h(1|2|3|4|5|6).*?>([\s\S]*)<\/h.*?>/", $headline, $matches);
            return $matches;
        }

        function getParagraphContent($paragraph){
            $matches = [];
            preg_match("/<p.*?>([\s\S]*)<\/p>/", $paragraph, $matches);
            return $matches;
        }

        function getLinkContent($link){
            $matches = [];
            if(strpos($link, "href")){
                preg_match("/<a.* href=\"(.*?)\"(.*?)>([\s\S]*)<\/a>/", $link, $matches);
            }
            else{
                preg_match("/<a.*>([\s\S]*)<\/a>/", $link, $matches);
            }
            return $matches;
        }

        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $content  = get_the_content();
                $projects = explode("<!-- wp:heading -->", $content);
                unset($projects[0]);
                $projects = array_values($projects);
                $projectsLen = count($projects);
                for ($i = 0; $i < $projectsLen; $i++) {
                    $currProject = $projects[$i];
                    // Headline
                    $headlineEnd = strpos($currProject, "<!-- /wp:heading -->");
                    $headline = substr($currProject,0,$headlineEnd);
                    $headlineContent = getHeadlineContent($headline)[2];
                    // Paragraphs
                    $paragraphsLen = substr_count($currProject, "<!-- wp:paragraph -->");
                    $paragraphs = [];
                    $pOffset = 0;
                    for ($j = 0; $j < $paragraphsLen; $j++) {
                        $pStart = strpos($currProject, "<!-- wp:paragraph -->", $pOffset);
                        $pEnd = strpos($currProject, "<!-- /wp:paragraph -->", $pOffset + 1);
                        $pOffset += $pEnd;
                        $pLen = $pEnd - $pStart;
                        $paragraphContent = getParagraphContent(substr($currProject, $pStart, $pLen));
                        $paragraphs[$j] = $paragraphContent[1];
                    }
                    $projectInfo = [$paragraphs[0], $paragraphs[1]];
                    $projectState = $paragraphs[2];
                    // Buttons
                    $buttonsLen = substr_count($currProject, "<!-- wp:button -->");
                    $buttons = [];
                    $btnOffset = 0;
                    for ($j = 0; $j < $buttonsLen; $j++) {
                        $btnStart = strpos($currProject, "<!-- wp:button -->", $btnOffset);
                        $btnEnd = strpos($currProject, "<!-- /wp:button -->", $btnOffset + 1);
                        $btnOffset += $btnEnd;
                        $btnLen = $btnEnd - $btnStart;
                        $buttonContent = getLinkContent(substr($currProject, $btnStart, $btnLen));
                        $buttons[$j]["new-tab"] = false;
                        if($buttonContent[3]){
                            $buttons[$j]["href"] = $buttonContent[1];
                            $buttons[$j]["content"] = $buttonContent[3];
                        }
                        else{
                            $buttons[$j]["href"] = false;
                            $buttons[$j]["content"] = $buttonContent[1];
                        }
                        if(strpos($buttonContent[0], "target=\"_blank\"")){
                            $buttons[$j]["new-tab"] = true;
                        }    
                    }
                    echo ("<div class='project'>");
                        echo ("<div class='left'");
                            echo ("<h3>" . $headlineContent . "</h3>");
                            echo ("<div class='project-info'>");
                                echo ("<p>" . $projectInfo[0 ] . "</p>");
                                echo ("<p>" . $projectInfo[1] . "</p>");
                            echo ("</div>"); //project-info
                            echo ("<div class='buttons'>");
                                foreach($buttons as $currButton){
                                    $target = "";
                                    if($currButton["new-tab"]){
                                        $target = " target='_blank'";
                                    }
                                    if($currButton["href"]){
                                        echo ("<a href=" . $currButton["href"] . $target . ">" . $currButton["content"] . "</a>");
                                    }
                                    else{
                                        echo ("<a href='#'>" . $currButton["content"] . "</a>");
                                    }
                                }
                            echo ("</div>"); //buttons
                        echo ("</div>"); //left
                        echo ("<div class='right'>");
                            echo $projectState;
                        echo ("</div>"); //right
                    echo ("</div>"); //project
                }
                //
            }
        }
        ?>
    </div>
</section>
<?php
get_footer();
?>
</body>