<?php
require_once('config.php');
require_once('functions.php');
$content = file_get_contents("php://input");
$update = json_decode($content, true);
//file_put_contents("array.txt", print_r($update, true));
if (!$update) {
    // receive wrong update, must not happen
    exit;
}
if (isset($update["message"])) {
    processMessage($update["message"]);
}
/*
if (isset($update["inline_query"])) {
    processInline($update["inline_query"]["query"], $update["inline_query"]["id"]);
}*/
function processMessage($message)
{
    // process incoming message
    //file_put_contents("array.txt",print_r($message,true));
    //$message_id = $message['message_id'];
    $chat_id = $message['chat']['id'];
    if (isset($message['text'])) {
        $text = str_replace("@ZinaBot", "", $message['text']);
        apiRequest("sendChatAction", array('chat_id' => $chat_id, "action" => "typing"));
        apiRequest("sendMessage", array('chat_id' => $chat_id, "text" => $text));
    }

}
?>