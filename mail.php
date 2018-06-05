  if(isset($_POST['submit'])){

        $emailSubject   =  'Reservation Form';    
       
        $GuestName      = $_POST['GuestName'];
        $HotelName      = $_POST['HotelName'];
        $Nationality    = $_POST['Nationality'];
        $RoomType       = $_POST['RoomType'];
        $Occubation     = $_POST['Occubation'];
        $MealPlan       = $_POST['MealPlan'];
        $Rooms          = $_POST['Rooms'];
        $Adults         = $_POST['Adults'];
        $Childern       = $_POST['Childern'];
        $ArrivalDate    = $_POST['pickup_date'];
        $DepartureDate  = $_POST['dropoff_date'];
        $duration       = $_POST['numdays'];
        
    
        $mailBody  =  "GuestName     : $GuestName   <br>";      
        $mailBody .=  "HotelName     : $HotelName   <br>";     
        $mailBody .=  "Nationality   : $Nationality  <br>";  
        $mailBody .=  "RoomType      : $RoomType     <br>"; 
        $mailBody .=  "Occubation    : $Occubation   <br>"; 
        $mailBody .=  "MealPlan      : $MealPlan     <br>"; 
        $mailBody .=  "Rooms         : $Rooms        <br>"; 
        $mailBody .=  "Adults        : $Adults       <br>";  
        $mailBody .=  "Childern      : $Childern     <br>";  
        $mailBody .=  "ArrivalDate   : $ArrivalDate  <br>";  
        $mailBody .=  "DepartureDate : $DepartureDate<br>"; 
        $mailBody .=  "duration      : $duration     <br>";   
         
      $select= $con->prepare("SELECT email FROM login");
      $select->setFetchMode(PDO::FETCH_ASSOC);
      $select->execute();
      $data=$select->fetch();   
    
      
      $from     = $data['email'];//THIS in table login
     
      $select1= $con->prepare("SELECT Hotelmail FROM reservationtable");
      $select1->setFetchMode(PDO::FETCH_ASSOC);
      $select1->execute();
      $data1=$select1->fetch();   

 
        $to          = $data1['Hotelmail'];//this in table reservationtable
        
       $content   = $mailBody;
        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        // Create email headers
        $headers .= 'From: '.$from."\r\n".
          'Reply-To: '.$from."\r\n" .
          'X-Mailer: PHP/' . phpversion();
        $message  = '<html><body>';
        $message .= '<table width="600" border="0" cellspacing="0" cellpadding="0" align="center" style="background-color:#CCC;">';
        $message .= '<tr>';
        $message .= '<td>';
        $message .= $content;
        $message .='</td>';
        $message .= '</tr>';
        $message .= '</table>';
        $message .= '</body></html>';
        mail($to,$emailSubject,$message,$headers);

      
 } 