<?php
echo ("<div class='right-content'>");
    if($projectState === "{#finished}"){
        echo ("<div class='project-state finished'>");
            echo ("<div class='icon animation-draw-tick'>");
                $src = get_template_directory_uri() . "/svg/tick.svg";
                $svg = wp_remote_get($src);
                $svg = wp_remote_retrieve_body($svg);
                echo ($svg);    
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
    echo ("<div class='bg'></div>");
    echo ("<img src=" . wp_get_attachment_image_src($imgID,[1000, 1000])[0] . " alt='' />");
echo ("</div>"); // right-content