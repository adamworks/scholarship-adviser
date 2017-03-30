<html>
    <head>
        <title>Login dengan Jquery AJAX</title>
        <style type="text/css">
            #login{
                font:bold 16px Tahoma,Verdana;
                display:block;
                border:#7596c0 1px solid;
                width:400px;
                height:280px;
                margin-left:auto;
                margin-right:auto;
                border-radius:5px;
                background-color:#98c1f3;
                box-shadow: 5px 5px 5px rgb(150, 149, 149); 
                visibility:visible;
                color:#e9ecf0;
            }
            h3{
                font:bold 20px Tahoma,Verdana;
                margin:0 0 0 0;
                padding:0 0 0 0;
                color:#2572d2;
                text-align:center;
                line-height:50px;
                border-bottom:#ffffff 1px solid;
            }
            #inner{
                margin:0 20px 0 20px;
            }
            input.txt{
                font:normal 14px Tahoma,Verdana;
                padding:10px;
                margin:5px 0 5px 0;
                width:100td_persen;
                background-color:#dee9f6;
            }
            input.btn{
                font:bold 14px Tahoma,Verdana;
                padding:10px;
                margin:5px 0 10px 0;
                width:100td_persen;
                text-align:center;
            }
        </style>
        <script type="text/javascript" src="jquery.min.js">//memanggil jquery</script>
        <script type="text/javascript" src="login.js">//memanggil script ajax</script>
    </head>
    <body>
        <div id="login">
            <h3>LOGIN ADMINISTRATOR</h3>
            <div id="inner">
                  
                <input type="text" class="txt" placeholder="Username anda" id="txt_username"/>
                  
                <input type="password" class="txt" placeholder="Password anda" id="txt_password"/>
                <input type="button" class="btn" name="btn" id="btnLogin" onclick="check_login();" value="Login"/>
            </div>
        </div>
    </body>
</html>