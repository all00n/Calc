<?php

include('vendor/autoload.php');

include ('TelegramBot.php');
include ('Calculator.php');

$telegramApi = new TelegramBot();
$calculator = new Calculator();

while (true){
    sleep(2);

//получаем последнее сообщение
    $updates = $telegramApi->getUpdates();

    foreach ($updates as $update){

        // проверяем тип сообщения и отправляем его методу калькулятору
        // после создаём отправляем ответ
        if(isset($update->edited_message)){
            $response = $calculator->calc($update->edited_message->text);
            $telegramApi->sendMessage($update->edited_message->chat->id, $response);
        }else{
            $response = $calculator->calc($update->message->text);
            $telegramApi->sendMessage($update->message->chat->id, $response);
        }
    }
}
