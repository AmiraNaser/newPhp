<?php 

  
 class Validator{


    function Clean($input, $flag = 0)
{

    $input =  trim($input);

    if ($flag == 0) {
        $input =  filter_var($input, FILTER_SANITIZE_STRING);   
    }
    return $input;
}


function validate($input,$flag){
   
    $status = true;

      switch ($flag) {
          case 1:
               if(empty($input)){
                  $status = false;
               }

              break;
        case 2: 
            if(strlen($input)<50){
                $status = false;
            }    
            break;
        case 3: 
            $nameArray =  explode('.', $input);
            $imgExtension =  strtolower(end($nameArray));
      
            $allowedExt = ['png', 'jpg', 'jpeg'];
    
            if (!in_array($imgExtension, $allowedExt)) {
                $status = false;
            }
          break;    
          case 4:      
               if(!preg_match('/^[a-zA-Z\s]*$/',$input)){
                $status = false;
               }
            break;
}

return $status;
}

function uploadFile($input){

    $result = '';

    $imgName  = $input['image']['name'];
    $imgTemp  = $input['image']['tmp_name'];

    $nameArray =  explode('.', $imgName);
    $imgExtension =  strtolower(end($nameArray));
    $imgFinalName = time() . rand() . '.' . $imgExtension;

     
    $disPath = 'uploads/' . $imgFinalName;

    if (move_uploaded_file($imgTemp, $disPath)) {
      $result =  $imgFinalName ;
       }

      return $result;  
      
  
}
 }
