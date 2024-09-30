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
$data_param ='{
    "model": "gpt-4o",
    "messages": [
      {
        "role": "system",
        "content": "'.$message.'"
      }
    ]
  }';




$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, TRUE);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json', "Authorization: Bearer $chatgpt_accesstoken"));  
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_param);
//curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
$output = curl_exec($ch); 

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

//$val2 = str_replace(',', ',<br>', $val);
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
