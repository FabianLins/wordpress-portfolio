<?php
/* Template Name: Projects Page */
get_header();
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
    if(strpos($link, "href") !== false){
        preg_match("/<a.* href=\"(.*?)\"(.*?)>([\s\S]*)<\/a>/", $link, $matches);
    }
    else{
        preg_match("/<a.*>([\s\S]*)<\/a>/", $link, $matches);
    }
    return $matches;
}

function sanitizeMarkup($input){
    return preg_replace("/<!--(.*)-->/Uis", "", $input);
}
?>

<section class="projects">
    <input type="radio" id="unset-modal" name="modalboxes2" checked>
    <h2 class="h2 mt-header h-pl animation-slide-in-right">
        <?php the_title() ?>
    </h2>
    <div class="all-projects">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                $content  = get_the_content();
                $content = str_replace("<strong>", "", $content);
                $content = str_replace("</strong>", "", $content);
                $projects = explode("<!-- wp:heading -->", $content);
                unset($projects[0]);
                $projects = array_values($projects);
                $projectsLen = count($projects);
                $modalBoxes = get_pages( array(
                    'child_of' => $post->ID,
                    'post_status' => array( 'publish', 'private' )
                ) );
                for ($i = 0; $i < $projectsLen - 1; $i++) {
                    $currProject = $projects[$i];
                    // Headline
                    $headlineEnd = strpos($currProject, "<!-- /wp:heading -->");
                    $headline = substr($currProject,0,$headlineEnd);
                    $headlineContent = getHeadlineContent($headline)[2];
                    // Paragraphs
                    $paragraphsLen = substr_count($currProject, "<!-- wp:paragraph -->");
                    $paragraphs = [];
                    $pStart = 0;
                    $pEnd = 0;
                    for ($j = 0; $j < $paragraphsLen; $j++) {
                        if($j === 0){
                            $pStart = strpos($currProject, "<!-- wp:paragraph -->", $pStart);
                            $pEnd = strpos($currProject, "<!-- /wp:paragraph -->", $pEnd);    
                        }
                        else{
                            $pStart = strpos($currProject, "<!-- wp:paragraph -->", $pStart + 1);
                            $pEnd = strpos($currProject, "<!-- /wp:paragraph -->", $pEnd + 1);    
                        }
                        $pLen = $pEnd - $pStart;
                        $paragraphContent = getParagraphContent(substr($currProject, $pStart, $pLen));
                        $paragraphs[$j] = $paragraphContent[1];
                    }
                    $projectInfo = [$paragraphs[0], $paragraphs[1]];
                    $projectInfo[0] = str_replace("{#made with}", "", $projectInfo[0]);
                    $madeWithArr = explode(',', $projectInfo[0]);
                    $madeWithArrLen = count($madeWithArr);
                    $projectInfo[0] = "<strong>";
                    if($madeWithArrLen > 1){
                        for ($j = 0; $j < ($madeWithArrLen - 1); $j++){
                            $projectInfo[0] .= $madeWithArr[$j] . ",";
                        }
                        $projectInfo[0] = substr($projectInfo[0], 0, strlen($projectInfo[0]) - 1);
                        $projectInfo[0] .= "</strong> and <strong>" . $madeWithArr[$madeWithArrLen - 1] . "</strong>";
                    }
                    else{
                        $projectInfo[0] = $madeWithArr[0];
                    }
                    $projectInfo[0] = "made with " . $projectInfo[0];
                    if(strpos($projectInfo[1], "{#created in}") === 0){
                        $projectInfo[1] = str_replace("{#created in}", "", $projectInfo[1]);
                        $projectInfo[1] = "created in <strong>" . $projectInfo[1] . "</strong>";
                    }
                    elseif(strpos($projectInfo[1], "{#created from}")  === 0){
                        $currProjectInfo = $projectInfo[1];
                        preg_match("/{#created from} ([\s\S]*) {#to}/", $projectInfo[1], $matches);
                        $projectInfo[1] = "created from <strong>" . $matches[1] . "</strong>";
                        $toDateStartPos = strpos($currProjectInfo, "{#to}") + strlen("{#to}") + 1;
                        $toDateLength = strlen($currProjectInfo) - $toDateStartPos;
                        $toDate = substr($currProjectInfo, $toDateStartPos, $toDateLength);
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
                    $buttons = [];
                    $btnOffset = 0;
                    $btnStart = 0;
                    $btnEnd = 0;
                    for ($j = 0; $j < $buttonsLen; $j++) {
                        if($j === 0){
                            $btnStart = strpos($currProject, "<!-- wp:button -->", $btnStart);
                            $btnEnd = strpos($currProject, "<!-- /wp:button -->", $btnEnd);    
                        }
                        else{
                            $btnStart = strpos($currProject, "<!-- wp:button -->", $btnStart + 1);
                            $btnEnd = strpos($currProject, "<!-- /wp:button -->", $btnEnd + 1);    
                        }
                        $btnLen = $btnEnd - $btnStart;
                        $btnStr = substr($currProject, $btnStart, $btnLen);
                        $buttonContent = getLinkContent($btnStr);
                        if($buttonContent[3]){
                            $buttons[$j]["href"] = $buttonContent[1];
                            $buttons[$j]["content"] = $buttonContent[3];
                        }
                        else{
                            $buttons[$j]["href"] = false;
                            $buttons[$j]["content"] = $buttonContent[1];
                        }
                        $buttons[$j]["new-tab"] = false;
                        if(strpos($buttonContent[0], "target=\"_blank\"") !== false){
                            $buttons[$j]["new-tab"] = true;
                        }    
                    }            
                    // Image
                    preg_match("/<!-- wp:image {([\s\S]*)} -->/", $currProject, $matches);
                    $imgData = ($matches[1]);
                    $imgData = explode(',', $imgData);
                    $imgID = -1;
                    for ($j = 0; $j < count($imgData); $j++){
                        $currImgData = str_replace('"', '', $imgData[$j]); // Remove quotation marks (")
                        $searchFor =  "id:";
                        $searchForLen = strlen($searchFor);
                        if(substr($currImgData, 0, $searchForLen) === $searchFor){
                            $imgID = substr($currImgData, $searchForLen, (strlen($currImgData) - $searchForLen));
                            break;
                        }
                    }
                    // HTML output
                    echo ("<div class='project'>");
                        echo ("<div class='container grid'>");
                            echo ("<div class='left'>");
                                echo ("<h3 class='h3'>" . $headlineContent . "</h3>");
                                echo ("<div class='project-info'>");
                                    echo ("<div class='made-with'>");
                                        echo ("<div class='wheel animation-wheel-icon'>");
                                            $src = get_template_directory_uri() . "/svg/wheel.svg";
                                            echo file_get_contents( $src );
                                        echo ("</div>"); // wheel
                                        echo ("<div class='text'>");
                                            echo ($projectInfo[0]);
                                        echo ("</div>"); // text
                                    echo ("</div>"); // made with
                                    echo ("<div class='created-in'>");
                                        echo ("<div class='calender'>");
                                            echo ("<div class='circle-container animation-clock animation-slower'>");
                                                echo ("<div class='circle'>");
                                                    echo ("<div class='dot'>");
                                                    echo ("</div>"); // dot
                                                    echo ("<div class='sm-pointer'>");
                                                    echo ("</div>"); // sm-pointer
                                                    echo ("<div class='lg-pointer'>");
                                                    echo ("</div>"); // lg-pointer
                                                echo ("</div>"); // circle
                                            echo ("</div>"); // circle-container
                                            $src = get_template_directory_uri() . "/svg/calender.svg";
                                            echo file_get_contents( $src );
                                        echo ("</div>"); // calender
                                        echo ("<div class='text'>");
                                            echo ($projectInfo[1]);
                                        echo ("</div>"); // text
                                    echo ("</div>"); // created in
                                echo ("</div>"); // project-info
                                echo ("<div class='buttons grid'>");
                                    foreach($buttons as $currButton){
                                        $target = "";
                                        $currStr = strtolower($currButton["content"]);
                                        $addClass = "";
                                        $icon = "";
                                        $animation = "animation-button-blink";
                                        if (strpos($currStr, "github") !== false){
                                            $addClass = "github " . $animation . "-github";
                                            $src = get_template_directory_uri() . "/svg/github.svg";
                                            $icon = file_get_contents( $src );
                                        }
                                        elseif (strpos($currStr, "show more") !== false){
                                            $addClass = "more " . $animation . "-more";
                                            $src = get_template_directory_uri() . "/svg/show-more.svg";
                                            $icon = file_get_contents( $src );
                                        }
                                        elseif (strpos($currStr, "demo") !== false){
                                            $addClass = "demo " . $animation . "-demo";
                                            $src = get_template_directory_uri() . "/svg/world.svg";
                                            $icon = file_get_contents( $src );
                                        }
                                        if (strpos($currStr, "show more") !== false) {
                                            echo("<label class='button-container " . $addClass . "' for='" . $modal . "'>");
                                                echo $icon;
                                                echo("<span>" . $currButton["content"] . "</span>");
                                            echo("</label>"); // button-container
                                        }
                                        else{
                                            echo("<div class='button-container " . $addClass . "'>");
                                            echo $icon;
                                            if($currButton["new-tab"]) {
                                                $target = " target='_blank'";
                                            }
                                            if($currButton["href"]) {
                                                echo("<a href=" . $currButton["href"] . $target . ">" . $currButton["content"] . "</a>");
                                            } else {
                                                echo("<a href='#'" . ">" . $currButton["content"] . "</a>");
                                            }
                                            echo("</div>"); // button-container

                                        }
                                    }
                                echo ("</div>"); // buttons
                            echo ("</div>"); // left
                            echo ("<div class='right'>");
                                echo ("<div class='right-content'>");
                                    if($projectState === "{#finished}"){
                                        echo ("<div class='project-state finished'>");
                                            echo ("<div class='icon animation-draw-tick'>");
                                                $src = get_template_directory_uri() . "/svg/tick.svg";
                                                echo file_get_contents( $src );
                                            echo ("</div>"); // icon
                                            echo ("<div class='project-state-text'>");
                                                echo ("Finished");
                                            echo ("</div>"); // project-state-text 
                                        echo ("</div>"); // project-state
                                    }
                                    elseif($projectState === "{#in progress}"){
                                        echo ("<div class='project-state in-progress animation-clock'>");
                                            echo ("<div class='circle'>");
                                                echo ("<div class='lg-pointer'>");
                                                echo ("</div>"); // lg-pointer
                                                echo ("<div class='sm-pointer'>");
                                                echo ("</div>"); // sm-pointer
                                                echo ("<div class='dot'>");
                                                echo ("</div>"); // dot
                                            echo ("</div>"); // circle
                                            echo ("<div class='project-state-text'>");
                                                echo ("In Progress");
                                            echo ("</div>"); // project-state-text 
                                        echo ("</div>"); // project-state
                                    }
                                    echo ("<img src=" . wp_get_attachment_image_src($imgID,[1000, 1000])[0] . " alt='' />");
                                echo ("</div>"); // right-content  
                            echo ("</div>"); // right
                        echo ("</div>"); // container
                        foreach($modalBoxes as $currBox){
                            if($currBox->post_name === $modal){
                                echo ("<input type='checkbox' id='" . $modal ."' name='modalboxes'>");
                                echo ("<div class='modal-container'>");
                                    echo ("<input type='radio' id='" . $modal ."-min' name='". $modal ."-min-max'>");
                                    echo ("<input type='radio' id='" . $modal ."-max' name='". $modal ."-min-max'>");
                                    echo ("<div class='modal animation-modal-fade-in'>");
                                        echo ("<div class='modal-top'>");
                                            echo ("<div class='mac-buttons'>");
                                                echo ("<label class='red animation-mac-red-blink' for='" . $modal . "'></label>");
                                                echo ("<label class='yellow animation-mac-yellow-blink' for='" . $modal . "-min'></label>");
                                                echo ("<label class='green animation-mac-green-blink' for='" . $modal . "-max'></label>");
                                            echo ("</div>"); // mac-buttons
                                        echo ("</div>"); // modal-top
                                        echo ("<div class='modal-content'>");
                                            echo (sanitizeMarkup($currBox->post_content));
                                        echo ("</div>"); // modal-content
                                    echo ("</div>"); // modal
                                    echo ("<label class='modal-shadow animation-shadow-fade-in' for='" . $modal ."'>");
                                    echo ("</label>"); // modal-shadow    
                                echo ("</div>"); // modal-container
                                break;
                            }
                        }
                    echo ("</div>"); // project
                }
            }
        }
        ?>
    </div>
</section>
<?php
get_footer();
?>
</body>