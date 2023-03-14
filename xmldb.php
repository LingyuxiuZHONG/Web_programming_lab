<?php
function load_persons() {
    $xml = simplexml_load_file('profiles.xml');
    if ($xml === false) {
        echo "Failed to load XML: ";
        foreach (libxml_get_errors() as $error) {
            echo "<br />", $error->message;
        }
        return;
    }

    return $xml->children();
}
function load_person_by_id($id){
    $xml = simplexml_load_file('profiles.xml');
    if($xml === false){
        echo"Failed to load XML: ";
        foreach(libxml_get_errors() as $error){
            echo "<br />" , $error->message;
        }
        return;
    }
    foreach($xml->children() as $person){
        if(intval($person['id']) === $id){
            return $person;
        }
    }
}
function load_posts($id) {
    $xml = simplexml_load_file('posts.xml');
    if ($xml === false) {
        echo "Failed to load XML: ";
        foreach (libxml_get_errors() as $error) {
            echo "<br />", $error->message;
        }
        return;
    }

    $results = array();

    foreach ($xml->children() as $post) {
        if (intval($post['personId']) === $id) {
            array_push($results, $post);
        }
    }

    return $results;
}
?>