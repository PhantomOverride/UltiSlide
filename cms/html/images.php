<?php
    require_once("php/config.php");

    chdir("html"); //Must be two level ups to get the IMAGE_DIRECTORY to work. (Ugly work around)

    $images = GetImagesInFolder(IMAGE_DIRECTORY);

    foreach ($images as $image) {
        PrintImage($image);
    }

    function GetImagesInFolder($dir){
        $dir_contents = scandir($dir);
        $i = 0;
        foreach ($dir_contents as $file) {
            if($file != ".." && $file != "."){
                $arr[$i++] = $file;
            }
        }
        return $arr;
    }
    function PrintImage($image){
        $url = IMAGES;
        echo<<<HTML
<div class="image_data">
    <a href="http://$url$image" target="_blank"> <img class="images_cms" src="http://$url$image" alt="{$image}" /> </a>
    <span>http://{$url}{$image}</span>
</div>
HTML;

    }

?>
