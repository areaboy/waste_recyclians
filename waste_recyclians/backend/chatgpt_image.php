<style>
.css_ai{
background:#ddd;color:black;padding:6px;border:none;
//margin: 0 1%;
margin: 0.2%;
  display: inline-block;
}

.css_ai:hover{
background: orange;
color:black;

}
</style>
<?php
error_reporting(0);
//chatgpt Access Token New
$chatgpt_accesstoken='sk-aEXHY1RLEdYCBMzba8EqD35d7tLAyVvmyhnQTOVA8KT3BlbkFJSoIqDNaaLHnla772x1XjUbMAXNwNKDzNpHbD_3w0AA';


// remove single and double quote in a string
$str ='aggagag"s22@';
echo $stra = str_replace(array('\'', '"'), '', $str); 





// sanitize Extracted Text documents

// Remove special characters except comma fullstop and space
//$message = preg_replace('/[^A-Za-z0-9,. ]/', '', $question);

/*
curl https://api.openai.com/v1/chat/completions \
  -H "Content-Type: application/json" \
  -H "Authorization: Bearer $OPENAI_API_KEY" \
  -d '{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": [
          {
            "type": "text",
            "text": "What’s in this image?"
          },
          {
            "type": "image_url",
            "image_url": {
              "url": "https://upload.wikimedia.org/wikipedia/commons/thumb/d/dd/Gfp-wisconsin-madison-the-nature-boardwalk.jpg/2560px-Gfp-wisconsin-madison-the-nature-boardwalk.jpg"
            }
          }
        ]
      }
    ],
    "max_tokens": 300
  }'


'.$message.'
*/


$message ='define food';
// Remove special characters except comma fullstop and space
//$message = preg_replace('/[^A-Za-z0-9,. ]/', '', $question);





// Make API Call to ChatGPT AI
//"model": "gpt-4o-mini",
       
//$url ="https://api.openai.com/v1/completions";

$url ="https://api.openai.com/v1/chat/completions";

// How many they are. list their quantities or numbers 
/*
$data_param='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": [
          {
            "type": "text",
            "text": "What is in this image. How many they are. list their quantities or numbers ?"
          },
          {
            "type": "image_url",
            "image_url": {
              "url": "https://fredjarsoft.com/waste_recyclians/backend/recycle_waste_images/waste3.png"
            }
          }
        ]
      }
    ],
    "max_tokens": 300
  }';
*/

/*
{
          "type": "image_url",
          "image_url": {
            "url": f"data:image/jpeg;base64,{base64_image}"
          }
*/

 $mime_typex= mime_content_type('recycle_waste_images/waste3.png');


echo " fred------$mime_type ---<br><br>";




// Get the image and convert into string 
$img = file_get_contents("recycle_waste_images/waste3.png"); 
  
// Encode the image string data into base64 
//$image_b64_encoded = base64_encode($img); 

//$base64 = 'data:image/' . $mime_typex . ';base64,' . base64_encode($img);


$file_path = 'recycle_waste_images/waste4.png';
$file_type = pathinfo($file_path, PATHINFO_EXTENSION);
$file_image = file_get_contents($file_path);
$image_base64 = 'data:image/' . $file_type . ';base64,' . base64_encode($file_image);

$data_param='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "user",
        "content": [
          {
            "type": "text",
            "text": "What is in this image.? list their quantities"
          },
          {
            "type": "image_url",
            "image_url": {
              "url": "'.$image_base64.'"
            }
          }
        ]
      }
    ],
    "max_tokens": 300
  }';


$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
echo $output = curl_exec($ch); 

if($output == ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>API Call to Chatgpt AI Failed. Ensure there is an Internet  Connections...</div><br>";
exit();
}

$http_status = curl_getinfo($ch, CURLINFO_HTTP_CODE);

// catch error message before closing
if (curl_errno($ch)) {
   //echo $error_msg = curl_error($ch);
}

curl_close($ch);



$json = json_decode($output, true);
$id = $json["id"];

$mx_error = $json["error"]["message"];
if($mx_error != ''){
echo "<div style='background:red;color:white;padding:10px;border:none;'>Chatgpt API Error Message: $mx_error.</div><br>";
//exit();
}

if($http_status == 400){
echo "<div style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT request was malformed or missing some required parameters</div><br>";
exit();
}

if($http_status == 429){
echo "<div style='background:red;color:white;padding:10px;border:none;'>You have hit your OpenAI/ChatGPT assigned rate limit.</div><br>";
exit();
}

if($http_status == 403){
echo "<div style='background:red;color:white;padding:10px;border:none;'>You have exceeded the allowed number of tokens in your OpenAI/ChatGPT request.</div><br>";
exit();
}

if($http_status == 401){
echo "<div style='background:red;color:white;padding:10px;border:none;'> OpenAI/ChatGPT API key or token was invalid, expired, or revoked.</div><br>";
exit();
}

if($http_status == 404){
echo "<div style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT requested resource API Model was not found</div><br>";
exit();
}

if($http_status == 500){
echo "<div style='background:red;color:white;padding:10px;border:none;'>An issue occurred on the OpenAI/ChatGPT server side</div><br>";
exit();
}

if($http_status == 403){
echo "<div style='background:red;color:white;padding:10px;border:none;'>OpenAI/ChatGPT API key or token lacks the required permissions</div><br>";
exit();
}

if($http_status == 200){
echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Call Successful....</div><br>";

if($id != ''){
echo "<div style='background:green;color:white;padding:10px;border:none;'>Chatgpt API Response Successfully Generated....</div><br>";
$content = $json["choices"][0]["message"]["content"];

echo $val2 = str_replace('/n', '<br><br>', $content);
//$value = str_replace('.', '<br>', $val2);

}



}














/*

}
else{
echo "<div id='' style='background:red;color:white;padding:10px;border:none;'>
Direct Page Access not Allowed<br></div>";
}
*/

?>
