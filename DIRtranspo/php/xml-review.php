<?php

class File_Section {
    function upload_file($post) {
        if(isset($_POST['xmlreviewsubmit'])) {
            setcookie("WPTranspoFile", $_POST["xml-file"], time()+3600); // global naming event

            $xml = processXML($_POST["xml-file"]);

            //get posts
            $postsData = array();
            foreach ($xml->channel->item as $post) {
                //if its not a post, break
                $type = $post->children('wp',true)->post_type;

                if($type == "post"){
                    $p = parseContent((string)$post->title);
                    //echo $p."<br>";
                    if ( $p ) { $postsData[] = $p;}
                }
            }

            //get pages
            $pageData = array();
            foreach ($xml->channel->item as $post) {
                //if its not a post, break
                $type = $post->children('wp',true)->post_type;

                if($type == "page"){
                    $p = parseContent((string)$post->title);
                    //echo $p."<br>";
                    if ( $p ) { $pageData[] = $p;}
                }
            }

            /*get categories
            $cateData = array();
            foreach ($xml->channel as $post) {

                foreach ($post->children('wp',true)->category as $c){
                    $cn = parseContent((string)$c->cat_name);
                    if ( $cn ) { $cateData[] = $cn;}
                }


            }
            */

            $tnData = array();
            foreach ($xml->channel->item as $post) {

                //file name
                $thumbnail = parseContent((string)$post->image);
                if($thumbnail){ $tnData[] = $thumbnail;}

            }

            //return var_dump($tnData);
            return '<p><strong>Posts:</strong> '.count($postsData).' | <strong>Images:</strong> '.count($tnData).' | <strong>Pages:</strong> '.count($pageData).'</p>';


        }
    }
}
?>
