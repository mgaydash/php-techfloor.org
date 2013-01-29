<?php
    $pageTitle = "Send E-Mail";
    include("../php/headerInc.php");
?>

<div class="pageTitle">
    Projects
</div>

<?php
    $recipients = array();

    $file = fopen('../../dataFiles/email.txt', 'rb');  
    while(!feof($file)) 
    {
        $address = trim(fgets($file));
        if(strlen($address) > 0) 
        {
        $recipients[] = $address;
        }
    }
    fclose($file);
    
    $file = '../../dataFiles/newsletter/newsletter.html';
    $message = file_get_contents($file);

    require_once 'Mail.php';
    $options = array();
    $options['host'] = 'ssl://smtp.gmail.com';
    $options['port'] = 465;
    $options['auth'] = true;
    $options['username'] = 'cuptechfloor@gmail.com';
    $options['password'] = 'techfloor99';
    $mailer = Mail::factory('smtp', $options);
    $headers = array ();
    $headers['From'] = 'TechFloor <cuptechfloor@gmail.com>';
    $headers['Subject'] = 'TechFloor News';
    $headers['Content-type'] = 'text/html';
    // $recipients is an array of addresses,$message is the html
    $result = $mailer->send($recipients, $headers, $message);
    
    if (PEAR::isError($result)) 
    {
        echo("There was a problem.");
    }
    else
    {
        echo("<h3>&nbsp;The newsletter has been sent successfully.</h3>");
        echo("&nbsp;The following addresses will recieve the message:<br />");
        for($i=0;$i<count($recipients);$i++)
            echo("&nbsp;$recipients[$i]<br />");
    }
    echo("<a href='../view/index.php'><br /><span class='pButton'>Continue</span></a>");
    
    include("../php/footerInc.php");
?>