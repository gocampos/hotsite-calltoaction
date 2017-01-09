<?php

function mailchimp_cadastro($email) {
  $api_key = 'cd4b0eecf3c6ecb5b7a0ba1606dcfacb-us14';
  $list_id = '377be9afee';

  $command = <<<COMMAND
curl --user apikey:$api_key \
     -H "Content-Type: application/json" \
     --request POST "https://us11.api.mailchimp.com/3.0/lists/$list_id/members/" \
     -d '{"email_address": "$email", "status": "subscribed", "merge_fields": {"SOURCE": "Me avise"}}'
COMMAND;

  $ok = shell_exec($command);

  return $ok;
  // echo $command; exit;
}

$mail = escapeshellarg($_POST['email']);

if($ok = mailchimp_cadastro($mail)) {
	die(json_encode(1));
}

die(json_encode(0));