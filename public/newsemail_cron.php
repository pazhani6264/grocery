<?php
ini_set('max_execution_time', '0');
$conn = new mysqli("54.254.59.163","u897330473_grocery","H43g#5cl8","u897330473_grocery");

// Check connection
if ($conn -> connect_errno) {
  echo "Failed to connect to MySQL: " . $conn -> connect_error;
  exit();
}

$sql = 'SELECT a.*, b.*, c.*, d.*, e.categories_name FROM news_to_news_categories a INNER JOIN news_categories b ON b.categories_id =a.categories_id INNER JOIN news c ON c.news_id =a.news_id INNER JOIN news_description d ON d.news_id =a.news_id INNER JOIN news_categories_description e ON e.categories_id =a.categories_id and c.cron_status = 0 and d.language_id = 1 and e.language_id = 1';


$result = $conn->query($sql);

if ($result->num_rows > 0) {
  // output data of each row
  $q1 = "SELECT * FROM settings where id = 103";
  $q1conn = $conn->query($q1);
  $value1 = mysqli_fetch_assoc($q1conn);
  $website_link = $value1['value'];

  $news = mysqli_fetch_assoc($result);
  $news_image = $news['news_image'];
 

  $q2 = "SELECT * FROM image_categories where image_id = '".$news_image."' and image_type ='ACTUAL'";
  $q2conn = $conn->query($q2);
  $value2 = mysqli_fetch_assoc($q2conn);
  $imgurls = $value2['path'];
  $imgurl_path_type = $value2['path_type'];

  if($imgurl_path_type == 'aws')
  {
    $imgurl = $imgurls;
  }
  else
  {
    $imgurl = $website_link.$imgurls;
  }

  

  $q3 = "SELECT * FROM alert_settings where news_email = 1";
  $q3conn = $conn->query($q3);
  $value3 = mysqli_fetch_assoc($q3conn);
  if($value3 !='')
  {
    $news_email = 1;
  }
  else
  {
    $news_email = 0;
  }

  $q4 = "SELECT * FROM alert_settings where news_notification = 1";
  $q4conn = $conn->query($q4);
  $value4 = mysqli_fetch_assoc($q4conn);
  if($value4 !='')
  {
    $news_notification = 1;
  }
  else
  {
    $news_notification = 0;
  }

  
  if($news_notification == 1)
  {
   

    $title	 = 'New Blog Added!';
    $message  = $news['news_name'];
    $websiteURL =  $imgurl;
    $q12 = "SELECT settings.value FROM settings where id = 56";
    $q12conn = $conn->query($q12);
    $value12 = mysqli_fetch_assoc($q12conn);
    $app_id = $value12['value'];
    $sendData = array
    (
        'body' 	=> $message,
        'title'	=> $title ,
        'icon'	=> 'myicon',/*Default Icon*/
        'sound' => 'mySound',/*Default sound*/
        'image' => $imgurl,
        'key' => 'news_id', 
        'value' => $news['news_id'], 
        'key1' => 'type', 
        'value1' => 'news', 
    );
    $q11 = "SELECT * FROM devices where devices.status = 1 and devices.is_notify = 1";
    $q11conn = $conn->query($q11);

   
  
    if(!empty($q11conn)){
   
      while($devices = mysqli_fetch_assoc($q11conn)) {
       
     
        $content = array(
          "en" => $sendData['body']
          );
       
       $headings = array(
          "en" => $sendData['title']
          );
       
       $big_picture = array(
          "id1" => $sendData['image']
          );

          $fields = array(
            'app_id' => $app_id,
            'include_player_ids' => array($devices['device_id']),		   
            'contents' => $content,
            'headings'=>$headings,
            'chrome_web_image'=>$sendData['image'],
            'big_picture'=>$sendData['image'],
            'ios_attachments'=>$sendData['image'],
            'firefox_icon'=>$sendData['image'],
                'data' => array($sendData['key'] => $sendData['value'],$sendData['key1'] => $sendData['value1'])
         );
       
         $fields = json_encode($fields);

       
       
         $ch = curl_init();
         curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
         curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json; charset=utf-8',
                'Authorization: Basic ZTJhZTcwNzItODQ4Ni00Y2FiLWFjZjEtMGY4ODZhZGZlMGZl'));
         curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
         curl_setopt($ch, CURLOPT_HEADER, FALSE);
         curl_setopt($ch, CURLOPT_POST, TRUE);
         curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
         curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
       
         $result = curl_exec($ch);
         $data = json_decode($result);
         curl_close($ch);

       
               
                
      }
    }
    
  }

  if($news_email == 1)
  {
    $q6 = "SELECT settings.value FROM settings where id = 71";
    $q6conn = $conn->query($q6);
    $value6 = mysqli_fetch_assoc($q6conn);
    $order_email = $value6['value'];

    $q7 = "SELECT settings.value FROM settings where id = 19";
    $q7conn = $conn->query($q7);
    $value7 = mysqli_fetch_assoc($q7conn);
    $app_name = $value7['value'];

    $q8 = "SELECT settings.value FROM settings where id = 16";
    $q8conn = $conn->query($q8);
    $value8 = mysqli_fetch_assoc($q8conn);
    $website_logo = $value8['value'];

    $q9 = "SELECT settings.value FROM settings where id = 123";
    $q9conn = $conn->query($q9);
    $value9 = mysqli_fetch_assoc($q9conn);
    $api_key = $value9['value'];

    $q10 = "SELECT settings.value FROM settings where id = 124";
    $q10conn = $conn->query($q10);
    $value10 = mysqli_fetch_assoc($q10conn);
    $domain = $value10['value'];
    $sub = 'New Blog Added!';
   
 

    $q5 = "SELECT * FROM newsletter_subscribe";
    $q5conn = $conn->query($q5);
    if(!empty($q5conn)){
      while($row = mysqli_fetch_assoc($q5conn)) {
        $email = $row['email'];
        if(!empty($email)) {
          $des = stripslashes($news['news_description']);
          $title = $news['news_name'];
          $first_name = 'Customer';
          $last_name = '';
         

          $html = '<div style="width: 100%; display:block;"><h2>'.$title.'</h2><strong>Hi '.$first_name.' '.$last_name.'!</strong><br>'.$des.'<br><img src="'.$imgurl.'" style="width:50%;height:auto;"><br><strong>Sincerely,</strong><br>'.$app_name.'<p></div>'; 


          $subject = $sub;
          $MailData            = array();
          $api_key             = $api_key;
          $domain              = $domain;
          $MailData['from']    = $app_name. "<".$order_email.">";
          $MailData['to']      = $email;
          $MailData['subject'] = $sub;
          $MailData['html'] =  $html;

          $ch = curl_init();
          curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
          curl_setopt($ch, CURLOPT_USERPWD, 'api:'.$api_key);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
          curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'POST');
          curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/'.$domain.'/messages'); // Live
          //curl_setopt($ch, CURLOPT_URL, 'https://api.mailgun.net/v3/sandbox5aa5969accf94fbe95114e85c4e7fd89.mailgun.org/messages'); // SanbBox
          curl_setopt($ch, CURLOPT_POSTFIELDS, $MailData);
          $resultss = curl_exec($ch);
          curl_close($ch);  
          //echo $resultss;
          //return $result; 
        }
      }
    }         

  } 

  $update="UPDATE news SET cron_status=1 WHERE news_id = '".$news['news_id']."' ";
    $result3 = $conn->query($update);

 
  
} else {
  echo "0 results";
}
$conn->close();

 
    
?>