<?php
    require_once('xmldb.php');
    $id = 0;
    if(isset($_GET['id'])){
        $id = intval($_GET['id']);
    }
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css" />
    <title>List</title>
    
    <link rel="stylesheet" href="style.css" />
    <link rel="stylesheet" href="https://cdn.staticfile.org/font-awesome/4.7.0/css/font-awesome.css"> 
</head>
<body>
    
    <div class="main">
        <div class="top-nav">
            <a class="text-a" href=<?="index.php?id=" . $id ?>>Home</a>
            <a class="text-a" href="list.php">Friends</a>
            <a class="text-a" href="#">Settings</a>
            <div class="search">
                <input type="text" placeholder="Search" />
                <a class="search-btn" >
                    <i class="fa fa-search" aria-hidden="true"></i>
                </a>
            </div>
            <a class="right-text-a" href="register.php">Logout</a>
            <a class="add-post"  id="post" href="javascript:add_post();">+</a><br />
        </div>
        <div class="main-content">
            <?php
            $persons = load_persons();
            foreach ($persons as $person) {
                $photo = substr($person->Photo,0,stripos($person->Photo,','));
            ?>
                <div class="list">
                    <img src=<?= $photo?> />
                    <a href="index.php?id=<?= $person['id'] ?>"><?= $person->Name ?></a>
                    <a href="delete.php?id=<?= $person['id'] ?>">Delete</a>
                </div>
            <?php
            }
            ?>
        </div>
        <div class="bound-box" id="bound_box">
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
        <div id="bg" class="bg"></div>
    </div>
    <script type="text/javascript">
        var bound_box = document.getElementById("bound_box");
        var post = document.getElementById("post");
        var bg = document.getElementById("bg");
        function add_post(){
            bound_box.style.display = "block";
            bg.style.display = "block";
            return false;
        }
        function close_box(){
            bound_box.style.display = "none";
            bg.style.display = "none";
        }
    </script>
</body>
</html>
<style>
        .main-content{
            text-align: center;
        }
        .list {
            display: flex;
            flex-direction: row;
            justify-content: center;
            align-items: center;
            padding: 20px;
            margin: 50px;
            
        }
        .list img{
            border-radius: 30%;
            width: 100px;
        }
        .list a {
            display: block;
            margin: 15px;
            padding: 15px;
            min-width: 150px;
            font:200 20px '优设标题黑';
            text-decoration: none;
            color: black;
        }
    </style>