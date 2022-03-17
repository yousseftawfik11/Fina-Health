<?php

/* connect to gmail */
$hostname = '{imap.gmail.com:993/imap/ssl}INBOX';
$username = 'finahealthcare123@gmail.com';
$password = 'T1e2s3t4';

/* try to connect */
$inbox = imap_open($hostname,$username,$password) or die('Cannot connect to Gmail: ' . imap_last_error());

/* grab emails */
$emails = imap_search($inbox, 'AlL');



/* if emails are returned, cycle through each... */
if($emails) {

  /* begin output var */
  $output = '';

  /* put the newest emails on top */
  rsort($emails);




    foreach($emails as $email_number) {

    /* get information specific to this email */
    $overview = imap_fetch_overview($inbox,$email_number,0);
    $message = imap_fetchbody($inbox,$email_number,2);
    $structure = imap_fetchstructure($inbox,$email_number);


    //pre($overview);


     $attachments = array();
       if(isset($structure->parts) && count($structure->parts)) {
         for($i = 0; $i < count($structure->parts); $i++) {
           $attachments[$i] = array(
              'is_attachment' => false,
              'filename' => '',
              'name' => '',
              'attachment' => '');

           if($structure->parts[$i]->ifdparameters) {
             foreach($structure->parts[$i]->dparameters as $object) {
               if(strtolower($object->attribute) == 'filename') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['filename'] = $object->value;
               }
             }
           }

           if($structure->parts[$i]->ifparameters) {
             foreach($structure->parts[$i]->parameters as $object) {
               if(strtolower($object->attribute) == 'name') {
                 $attachments[$i]['is_attachment'] = true;
                 $attachments[$i]['name'] = $object->value;
               }
             }
           }

           if($attachments[$i]['is_attachment']) {
             $attachments[$i]['attachment'] = imap_fetchbody($inbox, $email_number, $i+1);
             if($structure->parts[$i]->encoding == 3) { // 3 = BASE64
               $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
             }
             elseif($structure->parts[$i]->encoding == 4) { // 4 = QUOTED-PRINTABLE
               $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
             }
           }             
         } // for($i = 0; $i < count($structure->parts); $i++)
       } // if(isset($structure->parts) && count($structure->parts))


    if(count($attachments)!=0){
        foreach($attachments as $at){
            if($at['is_attachment']==1){
                file_put_contents($at['filename'], $at['new_attachment']);
            }
        }
    }

  }

 // echo $output;
} 

/* close the connection */
imap_close($inbox);



?>