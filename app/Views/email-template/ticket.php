<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,400;0,500;0,600;0,700;1,100&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Email Template</title>
    <style>
        *{
            padding: 0;
            margin: 0;
            box-sizing: border-box;
        }

        body{
            width: 100%;
            height: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            padding:20px;
        }

        h1, h2, h3, h4, h5, h6, p, a,
        div{
            font-family: "Raleway", sans-serif;
            padding: 0;
            margin: 0;
        }

        .emailTempSec{
            width: 100%;
            max-width: 1000px;
            padding:50px;
            border-radius: 10px;
            background: rgb(170,70,150);
            background: linear-gradient(180deg, rgba(170,70,150,1) 15%, rgba(89,39,82,1) 83%);
        }

        .emailCont h3{
            font-size: 45px;
            font-weight: 700;
            color:#fff;
        }

        .emailCont p{
            font-size: 17px;
            font-weight: 400;
            color:#fff;
        }

        .userInfo{
            margin:20px 0px;
        }

        .userInfo span{
            font-size: 18px;
            font-weight: 500;
            color:#fff;
        }

        .userInfo h2{
            font-size: 40px;
            font-weight: 700;
            color:#fff;
        }

        .emailCont h5{
            font-size: 20px;
            font-weight: 600;
            color:#fff;
            margin:30px 0px;
        }

        .dateLoc{
            margin-top: 15px;
        }

        .datelocSec{
            background-color: #fff;
            padding:20px;
            width: 47%;
            margin-right: 20px;
            float: left;
            margin-bottom: 20px;
        }

        .datelocSec h4{
            font-size: 20px;
            font-weight: 600;
            color:#741774;
        }

        .datelocSec p{
            font-size: 18px;
            font-weight: 500;
            color:#000;
        }

        .datelocSec p i{
            font-size: 18px;
        }


        .emailImgs{
            width: 45%;
            gap:20px;
            float: left;
        }

        .emailImgs img{
            width: 45%;
            height: 150px;
            object-fit: contain;
            float: left;
            margin-right: 20px;
        }

        .emailDeatils{
            width: 45%;
            float: right;
        }

        .emailDeatils p{
            font-size: 20px;
            font-weight: 700!important;
            font-style: italic;
            text-align: center;
            color:#fff;
        }

        .emailDeatils h1{
            font-size: 45px;
            font-weight: 700;
            text-align: center;
            color:#fff;
            padding-bottom:30px;
            border-bottom: 2px solid #fff;
            margin-top: 20px!important;
        }


        @media only screen and (max-width:500px) {

            

            body{
                height: 100%;
            }


            .emailCont h3{
                font-size: 35px;
            }

            .emailCont p{
                font-size: 15px;
            }

            .emailDeatils h1{
                font-size: 35px;
            }

            .emailTempSec{
                height: auto;
                padding:30px 20px;
                border-radius: 0px;
            }


            .emailImgs img{
                width: 43%;
                margin-right: 15px;
            }

            .emailBtm{
                flex-direction: column-reverse;
            }

            .datelocSec{
                width: 100%;
                padding: 15px;
                margin:0;
                margin-bottom: 20px;
            }
            .emailImgs, .emailDeatils{
                width: 100%;
            }

            
        }
    </style>
</head>
<body>
    <section class="emailTempSec">
        <div class="emailCont">
            <h3><?=$eventName;?></h3>
            <p>
                <?=$shortDescription;?>
            </p>
            <div class="userInfo">
                <span>Attendee Full Name</span>
                <h2><?=$attendeeName;?></h2>
                <div class="dateLoc">
                    <div class="datelocSec">
                        <h4>Date And Time</h4>
                        <p><i class="bi bi-calendar-check"></i><?=$eventDate;?></p>
                    </div>
                    <div class="datelocSec">
                        <h4>Event Location</h4>
                        <p><i class="bi bi-calendar-check"></i><?=$eventLocation;?></p>
                    </div>
                </div>
            </div>
            <h5>Event ID: <?=$eventId;?></h5>

            <div class="emailBtm">
                <div class="emailImgs">
                    <img src="https://website-584df99e.teq.hju.mybluehost.me/img/bannerImg.png">     
                    <img src="https://website-584df99e.teq.hju.mybluehost.me/img/bannerImg.png">           
                </div>
                <div class="emailDeatils">
                    <p>Ticket Name :<br><?=strtoupper($eventName);?></p>
                    <h1>PRICE WAS PAID</h1>
                </div>
            </div>
        </div>
    </section>
</body>
</html>