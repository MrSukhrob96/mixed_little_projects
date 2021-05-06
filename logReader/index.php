<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="60" ;>
    <link rel="icon" href="demo_icon.gif" type="image/gif" sizes="16x16">
    <script src="./app.js"></script>
    <title>Matin</title>
</head>

<body>

    <style>
        @import url("https://fonts.googleapis.com/css?family=Montserrat");

        * {
            margin: 0;
            padding: 0;
			
        }

        body {
            height: 100vh;
            background: #222;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: Montserrat, sans-serif;
            text-align: center;
        }

        #clock {
            color: #0ff;
            text-shadow: 0 0 4px #0ff;
            opacity: 0.9;
        }

        #date {
            font-size: 2.6em;
        }

        ul {
            list-style: none;
            font-size: 4em;
        }

        ul li {
            display: inline;
        }

        #point {
            animation: move 1s linear infinite;
        }

        @keyframes move {
            0% {
                opacity: 1;
                text-shadow: 0 0 20px #0ff;
            }

            50% {
                opacity: 0;
                text-shadow: none;
            }

            100% {
                opacity: 1;
                text-shadow: 0 0 20px #0ff;
            }
        }
    </style>

    <div id="clock">
        <div id="date"></div>
        <ul>
            <li id="hours"></li>
            <li id="point">:</li>
            <li id="mins"></li>
            <li id="point">:</li>
            <li id="secs"></li>
        </ul>
    </div>

    <script>
	
        $(document).ready(() => {
            let month = ["Январ", "Феврал", "Март", "Апрел", "Май", "Июн", "Июл", "Август", "Сентябр", "Октябр", "Ноябр", "Декабр"],
                day = ["Якшанбе", "Душанбе", "Сешанбе", "Чоршанбе", "Панчшанбе", "Жума", "Шанбе"],
                date = new Date();
            date.setDate(date.getDate());

            $("#date").html(`${day[date.getDay()]}<br>${month[date.getMonth()]}-${date.getDate()}-${date.getFullYear()}`);
            setInterval(() => {
                let secs = new Date().getSeconds();
                $("#secs").html(`${secs < 10 ? "0" : ""}${secs}`);
            }, 1000);
            setInterval(() => {
                let mins = new Date().getMinutes();
                $("#mins").html(`${mins < 10 ? "0" : ""}${mins}`);
            }, 1000);
            setInterval(() => {
                let hours = new Date().getHours();
                $("#hours").html(`${hours < 10 ? "0" : ""}${hours}`);
            }, 1000);
        });
		
    </script>

    <?php

	$logPath = realpath('Y:\Событие-2015.10.17-14.10.log');
	$txtPath = dirname( __FILE__ ).'\\test.txt';

    function readLog($fileName)
    {
        if (file_exists($fileName))
		{
            try {
                $file = @file($fileName);
                if ($file)
				{
                    return $file;
                } else 
				{
                    return 'is empty';
                }
            } 
			catch (Exception $ex)
			{
                echo $ex->getMessage();
            }
        } else 
		{
				return 'error';
		}
        return 'Not found';
    }
	

    function updateData($fileDir, $data)
    {
        if (file_exists(dirname(__FILE__ . '\\' . $fileDir)))
		{
            if (file_put_contents($fileDir, $data))
                return true;
        }

        return false;
    }


    function array_key_last($array)
    {
        if (!is_array($array) || empty($array))
		{
            return NULL;
        }
        $arrayKey = array_keys($array)[count($array) - 1];
        return $arrayKey;
    }


    function smsData($logNum, $txtNum, $logPath)
    {
        $array = array();
        if ($logNum >  $txtNum) 
		{
            for ($i = $txtNum + 1; $i <= $logNum; $i++) 
			{
                $array[] = readLog($logPath)[$i];
            }
            updateData('test.txt', array_key_last(readLog($logPath)));
        } else 
		{
            updateData('test.txt', array_key_last(readLog($logPath)));
        }

        return $array;
    }



    function createXmlMessage($message, $phoneNumber)
    {
        $dom = new DomDocument('1.0', 'UTF-8');
        $report = $dom->appendChild($dom->createElement('Report'));
        $customers = $report->appendChild($dom->createElement('Customers'));
		for($i = 0; $i < count($phoneNumber); $i++)
		{
			$customer = $customers->appendChild($dom->createElement('Customer'));
			$customer->setAttribute('CustomerText', $message);
			$customer->setAttribute('CustomerTel', $phoneNumber[$i]);
		}
        $dom->formatOutput = true;
        $dom->saveXML();
        $dom->save('X:/in/sms.xml');
    }

	function checkHasIp($ip, $data)
	{
		$num = 0;
		
		foreach($ip as $key => $i)
		{
			$preg = '/'.$i.'/i';
			if(preg_match($preg, $data))
			{
				$num++;
			}
		}
		
		return $num;
	}

    $logNum = array_key_last(readLog($logPath));
    $txtNum =  readLog($txtPath)[0];	

	if(!empty($txtNum)){
		updateData('test.txt', array_key_last(readLog($logPath)));
	}

	$sms = smsData($logNum, $txtNum, $logPath);

	
	$ipList = [
		"192.168.10.1",
		"192.168.10.1",
		"192.168.10.1",
	];
	
	$phoneNumber = [
		'992926352444',
		'992927005170',
	];
	
    if (!empty($sms)) 
	{
        $message = '';

        foreach ($sms as $key => $data)
		{
			$off = preg_match('/таймаут/i', $data);
			
			if($off)
			{
				$n = checkHasIp($ipList, $data);
				if($n)
				{
					$message .= $data . ' ';
				}
			}
							
        }
		
		if(trim($message) != ''){
			createXmlMessage($message, $phoneNumber);
		}
	}

    ?>

</body>

</html>