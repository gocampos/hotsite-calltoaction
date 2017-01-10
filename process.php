<?php

function mailchimp_cadastro($email) {
  $api_key = 'cd4b0eecf3c6ecb5b7a0ba1606dcfacb-us14';
  $list_id = '377be9afee';

  $command = <<<COMMAND
curl --user apikey:$api_key \
     -H "Content-Type: application/json" \
     --request POST "https://us14.api.mailchimp.com/3.0/lists/$list_id/members/" \
     -d '{"email_address": "$email", "status": "subscribed", "merge_fields": {"SOURCE": "Me avise"}}'
COMMAND;

  $result = shell_exec($command);

  $json_result = json_decode($result);

  // ja existe
  if($json_result->status == 400) {
     return 'exists';
  }

  return !empty($json_result->id) ? 'registered' : 'error';
}

function arquivo_registrar_email($email) {
  $dir = dirname(__FILE__) . '/list';
  $filepath = $dir . '/list.txt';

  $fp = fopen($filepath, 'a+');
  fwrite($fp, date('Y-m-d H:i:s') . ';'. $email . PHP_EOL);
  fclose($fp);
} 


$mail = trim(escapeshellarg($_POST['email']), "'");

$result = mailchimp_cadastro($mail);

arquivo_registrar_email($mail);

die(json_encode($result));
