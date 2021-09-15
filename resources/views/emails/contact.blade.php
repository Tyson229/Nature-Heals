<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Contact Form</title>
    <style>
    .p{
        color:red;
    }
        .mail-container{
            margin: 0 auto;
            background-color:#F2F2F2;
            padding:20px 20px;
        }
        .header{
            padding: 10px 10px;
            text-align: center;
            background-color:black;
            color:white;
            font-size:18px;
        }
        .contact-from{
            padding: 12px 1px;
            background: #4D0011;
            text-align: center;
            color: #FFF;
            font-size:18px;
        }
    </style>
</head>
<body>
    <div class="mail-container">
        <h2 class="header">Nature Heals</h2>
        <h4 class="contact-from">Message From {{$name}}</h4>
        <p><b>Email:</b> {{$email ?? '-'}}</p>
        <p><b>Category:</b> {{$category}}</p>
        <p><b>Message:</b> {{$contactMessage}} </p>
       <br> <br> 
    </div>
</body>
</html>