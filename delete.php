<?php
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
}

$xml = simplexml_load_file('profiles.xml');
$i = 0;
foreach ($xml->person as $person) {
    if ($person['id'] == $id) {
        unset($xml->person[$i]);
        break;
    }

    $i++;
}

$xml->saveXML('profiles.xml');
header('location:list.php');
?>
