<!-- resources/views/home.blade.php -->
<html>
    <head>
        <title>Dashboard</title>

		
        <link href="//fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

        <style>
            html, body {
				height: 100%;
            }

            body {
				margin: 0;
                padding: 20;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
				text-align: center;
                display: table-cell;
                vertical-align: middle;
				bgcolor="#CCFF99";
            }

            .content {
				text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 125px;
				text-align: center;
            }
			
			.header {
                font-size: 50px;
				text-align: left;
            }
			
			.logout {
				font-weight: 100;
				align:right;
			}
			
			.submit {
				background-color: #ccc;
				-moz-border-radius: 5px;
				-webkit-border-radius: 5px;
				border-radius:6px;
				font-family: 'Oswald';
				font-size: 20px;
				text-decoration: none;
				cursor: pointer;
				border:none;
				align:right;
				margin-left:1400px;
			}
			
			
        </style>
    </head>
	<body bgcolor="#CCFF99">
	<?php
	echo $welcomeMessage;
	?>
	
	<form method="POST" action="/auth/logout">
    {!! csrf_field() !!}
		<div class="logout">
			<button type="submit" class="submit">Logout</button>
		</div>
	    <div class="container">
            <div class="content">
                <div class="title">You are logged in !!!</div>
            </div>
        </div>
	</form>
   </body>
</html>