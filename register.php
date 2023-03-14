<?php
require_once('xmldb.php');

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $name = $_POST['name'];
    $city = $_POST['city'];
    $birth = $_POST['birth'];
    $occu = $_POST['occu'];
    $mail = $_POST['mail'];
    $pasw = $_POST['pasw'];
    $photo = '\lab\img_0\1.png,\lab\img_0\2.png,\lab\img_0\3.png';
    $xml = simplexml_load_file('profiles.xml');
    $id = 1;
    foreach($xml->children() as $person){
        $id++;
    }
    $newPerson = $xml->addChild('person');
    $newPerson->addAttribute('id',$id);
    $newPerson->addChild('Name',$name);
    $newPerson->addChild('City',$city);
    $newPerson->addChild('Birthday',$birth);
    $newPerson->addChild('Occupation',$occu);
    $newPerson->addChild('Photo',$photo);
    $newPerson->addChild('Email',$mail);
    $newPerson->addChild('Password',$pasw);
    $xml->saveXML('profiles.xml');
    header('location:index.php?id='.$id);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="reg_style.css"/>
    
</head>
<body>
    
    <div class="main">
        <div class="banner">
            <div class="banner-list">
                <img class="item" src="img_register/1.jpg">
                <img class="item" src="img_register/2.jpg">
                <img class="item" src="img_register/3.jpg">
                <img class="item" src="img_register/4.jpg">
                <img class="item" src="img_register/5.jpg">
            </div>
        </div>
        
        <div class="right-sheet" id="register_sheet">
            <button class="login" onclick="change()" >Log in</button>
            <div class="welcoming">
                <span class="register-title" id="title">WELCOMING YOUR REGISTER</span><br/>
                <span class = "register-title-login" id="login_title" style ="display:none" >WELCOMING BECK</span><br />
                <span class="register-describe">This is a world you can create everything you like!</span>               
            </div>
            <form action="register.php" method="POST" onsubmit="return check()">
                <div class="register-item" id="name">
                    <span id = "name_label">Name *</span><br />
                    <input type="text" name="name" id="name_in" onfocus="turn_back()" />
                </div>
                
                <div class="register-item" id="city">
                    <span>City *</span><br />
                    <input type="text" name="city" id="city_in" onfocus="turn_back()"/>
                </div>
                
                <div class="register-item" id="birth">
                    <span>Birthday *</span><br />
                    <input  type="text" name="birth" id="birth_in" onfocus="turn_back()"/>
                </div>
                <div class="register-item" id="occu">
                    <span>Occupation *</span><br />
                    <input  type="text" name="occu" id="occu_in" onfocus="turn_back()"/>
                </div>
                <div class="register-item" id="mail">
                    <span>E-mail *</span><br />
                    <input  type="text" name="mail" id="mail_in" onfocus="turn_back()"/>
                </div>
                
                <div class="register-item">
                    <span>Password *</span><br />
                    <input  type="password" name="pasw" id="psw_in" onfocus="turn_back()"/>
                </div>
                <div class="register-item">
                    <input class="register-btn" type="submit" id="btn" value="Register" />
                </div>
            </form>
        </div>




        <div class="right-sheet" id ="login_sheet" style="display:none;">
            <button class="login" onclick="change()" >Log in</button>
            <div class="welcoming">
                <span class = "register-title-login" >WELCOMING BECK</span><br />
                <span class="register-describe">This is a world you can create everything you like!</span>               
            </div>
            <div class="register-item" id="name2">
                <span id = "name_label">Name *</span><br />
                <input type="text" name="name" id="name_in2"/>
            </div>
            <div class="register-item">
                <span>Password *</span><br />
                <input  type="password" name="pasw" id="psw_in2" onfocus="turn_back()"/>
            </div>
            <div class="register-item">
                <input class="register-btn" type="submit" id="login_btn" value="Log In" onclick="login_check()"/>
            </div>
        </div>
            
       
    </div>
    <script type="text/javascript">
        
        function turn_back(){
            var item =  document.activeElement;
            item.style.backgroundColor = "white";
            item.value = "";
        }
        function change(){
            
            if(document.getElementById("register_sheet").style.visibility == "hidden"){
                document.getElementById("register_sheet").style.visibility = "visible";
                document.getElementById("register_sheet").style.display = "";
                document.getElementById("login_sheet").style.visibility = "hidden";
                document.getElementById("login_sheet").style.display = "none";

            }
            else{
                document.getElementById("register_sheet").style.visibility = "hidden";
                document.getElementById("register_sheet").style.display = "none";
                document.getElementById("login_sheet").style.visibility = "visible";
                document.getElementById("login_sheet").style.display = "";
                
            }
        }
        function check(){
                var name =  document.getElementById("name_in");
                var city = document.getElementById("city_in");
                var birth = document.getElementById("birth_in");
                var occu = document.getElementById("occu_in");
                var mail = document.getElementById("mail_in");
                var psw = document.getElementById("psw_in");
                var names = "<?php 
                            $xml = simplexml_load_file('profiles.xml');
                            $names = "";
                            foreach($xml->children() as $person){
                                $names = $names . $person->Name . ',' ;
                            }
                            echo $names;
                        ?>";

                var arr = names.split(',');
                var flag = true;
                if(name.value == "" ){
                    name.style.backgroundColor = "red";
                    flag = false;
                }
                if(city.value == ""){
                    city.style.backgroundColor = "red";
                    flag = false;
                }
                if(birth.value == ""){
                    birth.style.backgroundColor = "red";
                    flag = false;
                }
                if(occu.value == ""){
                    occu.style.backgroundColor = "red";
                    flag = false;
                }
                if(mail.value == ""){
                    mail.style.backgroundColor = "red";
                    flag = false;
                }
                if(psw.value == ""){
                    psw.style.backgroundColor = "red";
                    flag = false;
                }
                for(var i = 0;i < arr.length;i++){
                    if(arr[i] == name.value && name.value != ""){
                        name.value = "This name was token";
                        name.style.color = "red";
                        flag = false;
                    }
                }
                if(name.value == "This name was token"){
                    flag = false;
                }
                
                if(!flag){
                    return false;
                }
            

        }
        function login_check(){
            var name =  document.getElementById("name_in2");
            var psw =  document.getElementById("psw_in2");
            var str = "<?php 
                        $xml = simplexml_load_file('profiles.xml');
                        $str = "";
                        foreach($xml->children() as $person){
                            $str = $str . $person->Name . "," . $person->Password . "," . $person['id'] . ',';
                        }
                        echo $str;
                    ?>";
            var arr = str.split(",");
            console.log(psw.value);
            for(var i = 0;i < arr.length / 3;i++){
                if(arr[3*i] == name.value && arr[3*i+1] == psw.value){
                    location.replace("http://localhost:3000/lab/index.php?id=" + arr[3 * i + 2]);
                }else if(arr[3*i] == name.value){
                    psw.style.backgroundColor = "red";
                }
                
            }
        }
    </script>

</body>
</html>

