<?php
require_once('xmldb.php');
$id = 0;
$name = '';
$city = '';
$bday = '';
$ocparr = [];
$ocp = '';
$worksarr = [];
$works = '';
$photoarr = [];
if(isset($_GET['id'])){
    $id = intval($_GET['id']);
}

if($id === 0){
    die('Wrong id!');
}
$person = load_person_by_id($id);
$name = $person->Name;
$city = $person->City;
$bday = $person->Birthday;
$ocparr = explode(',',$person->Occupation);
$worksarr = explode(',',$person->Works);
$photoarr = explode(',',$person->Photo);
foreach($ocparr as $item){
    $ocp .= $item . '<br>';
}
foreach($worksarr as $item){
    $works .= $item . '<br>';
}
$posts = load_posts($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css"> 
    <title>My personal page</title>
    
</head>
<body>
    <div class="main">
        <div class="top-nav">
            <a class="text-a" href=<?="index.php?id=". $id?>>Home</a>
            <a class="text-a" href=<?="list.php?id=".$id?>>Friends</a>
            <a class="text-a" href="javascript:change_settings();">Settings</a>
            <div class="search">
                <input type="text" placeholder="Search" />
                <a class="search-btn" >
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
            <a class="right-text-a" href="register.php">Logout</a>
            <a class="add-post"  id="post" href="javascript:add_post();" >+</a><br />
        </div>
        <div class="info">
            <div class="left">
                <div class="box">
                    <img class="photo" src=<?= $photoarr[0] ?> />
                </div>
                <div class="box">
                    <img class="photo" src=<?= $photoarr[1] ?>  />
                </div>
                <div class="box">
                    <img class="photo" src=<?= $photoarr[2] ?> />
                </div>
            
            </div>
            <div class="right">
                <h2 ><?= $name ?></h2>
                <div class="info-text-item">
                    <div class="info-text-item-label">City:</div>
                    <div class="info-text-item-value"><?= $city ?></div>
                </div>
                <div class="info-text-item">
                    <div class="info-text-item-label">Birthday:</div>
                    <div class="info-text-item-value"><?= $bday ?></div>
                </div>
                <div class="info-text-item">
                    <div class="info-text-item-label">Occupation:</div>
                    <div class="info-text-item-value"><?= $ocp ?></div>
                </div>
                <div class="info-text-item">
                    <div class="info-text-item-label">Works:</div>
                    <div class="info-text-item-value"><?= $works ?></div>
                </div>
                
            </div>
        </div>
        <div class="post">
            
            <?php
            foreach($posts as $post){
                // $arr = explode('(br)',$person->detail);
                //             $detail = '';
                //             foreach($arr as $item){
                //                 $detail .= $item . '<br>';
                // }
                // print_r($detail)
            ?>
            <div class="post-item">
                <h2 class="head">&nbsp&nbsp&nbsp<?= $post->head?></h2>
                <div class="post-item-detail">
                    <img class="post-item-detail-img" src=<?= $post->image ?> >
                    <div class="post-item-detail-text"><?= $post->detail ?></div>
                </div>
            </div>
            <?php
            }
            ?>
        </div>
    </div>
    
    <div class="cute-flash">
        <div class="bubble"></div>
        <div class="shadow"></div>
    </div>
    <div class="bound-box" id="bound_box" style="display: none;">
        <h3 class="post-title">ADD POST</h3>
        <button class="close-btn" onclick="close_box()">X</button>
        <form>
            <span class="post-label">Head:</span><br/>
            <input type="text" class="post-head" id="post_head"/><br/>
            <span class="post-label">Detail:</span><br/>
            <textarea class="post-detail" ></textarea><br/>
            <input type="submit" class="post-btn" value="Add"/>
        </form>
        
    </div>
    <div class="bound-box" id="up_photo"  style="display: none;">
        <h3 class="post-title">Settings</h3>
        <button class="close-btn" onclick="close_box()">X</button>
        <form >
            <span class="post-label">Please upload your photos:</span>
            <input type="file" accept="image/png,image/jpg" multiple/>
            <input type="submit" value="Upload" />
        </form>

    </div>
    <div id="bg" class="bg"></div>



    <script type="text/javascript">
        var bound_box = document.getElementById("bound_box");
        var post = document.getElementById("post");
        var bg = document.getElementById("bg");
        var up_photo = document.getElementById("up_photo");
        function add_post(){
            bound_box.style.display = "block";
            bg.style.display = "block";
            return false;
        }
        function close_box(){
            bound_box.style.display = "none";
            up_photo.style.display = "none";
            bg.style.display = "none";
        }
        function change_settings(){
            up_photo.style.display = "block";
            bg.style.display = "block";
            return false;
        }
    </script>
</body>
</html>