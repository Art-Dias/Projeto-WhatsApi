<?php
session_start();
$device_token = $_SESSION['device_token'];
// callFunction.php

$numero = $_GET['numero'];
$numeroDeMensagens = $_GET['numeroDeMensagens'];

call_user_func('function1', "$numero", $numeroDeMensagens, $device_token);

function function1($numero, $numeroDeMensagens, $device_token)
{
    $selectedChat = $numero;
    // Include the database connection file
    require '../connection.php';

    $connection = DatabaseConnection::getConnection();

    // $sql_tipo = "SELECT * FROM (SELECT * FROM mensagem_infos WHERE (number_from = \"$selectedChat\" or number_to = \"$selectedChat\") ORDER BY id DESC LIMIT 20 ) AS subquery ORDER BY id ASC;";
    $resultMsg = $connection->query("SELECT * FROM (SELECT * FROM mensagem_infos WHERE (number_from = \"$selectedChat\" or number_to = \"$selectedChat\") AND device_token = \"$device_token\" ORDER BY id DESC LIMIT $numeroDeMensagens ) AS subquery ORDER BY id ASC");
    while ($rowMsg = mysqli_fetch_assoc($resultMsg)) {
        $message = $rowMsg['mensagem'];
        $fromMe = $rowMsg['fromMe'];
        $type = $rowMsg['type'];
        $caption = $rowMsg['image_caption'];
        $nomeArquivo = $rowMsg['nomeArquivo'];

        // Original timestamp
        $originalTimestamp = $rowMsg['hora'];
        // Set the timezone to Brasília
        $timezone = new DateTimeZone('GMT-03:00');
        // Convert timestamp to DateTime object with the specified timezone
        $dateTime = new DateTime("@$originalTimestamp");
        $dateTime->setTimezone($timezone);
        // Format DateTime object to 24-hour format
        $timeIn24HourFormat = $dateTime->format('H:i');

        // Text
        if ($fromMe == 'true' && $type == 'text') {
            echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
        } else if ($fromMe == 'false' && $type == 'text') {
            echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
        }

        // Image
        if ($fromMe == 'true' && $type == 'image') {
            echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            }
        } else if ($fromMe == 'false' && $type == 'image') {
            echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            }
        }

        //ptt = audio
        if ($fromMe == 'true' && $type == 'ptt') {
            $audioBase64 = str_replace(' ', '', $message);
            echo '<div class="right" style="position: relative; float: right;"> <div> <audio controls class="audio-right" style="float: right;"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0" style="float: right; margin-right: 8px; width: 100%; padding-bottom: 15px;"> <span class="align-middle" style="font-size: 12px; float: right;"> ' . $timeIn24HourFormat . ' </span> <i class="ri-time-line align-middle" style="float: right;"></i> </p> </div>';
        } else if ($fromMe == 'false' && $type == 'ptt') {
            $audioBase64 = str_replace(' ', '', $message);
            echo '<div style="position: relative; z-index: 1;"><div><audio controls class="audio-right"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle" style="font-size: 12px">' . $timeIn24HourFormat . '</span> </p> </div>';
        }

        // PDF ou MSWORD or DOC or DOCX
        // if ($fromMe == 'true' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
        if ($fromMe == 'true' && ($type != 'text' && $type != 'image' && $type != 'ptt')) {
            $base64 = str_replace(' ', '', $message);
            echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            }
        // } else if ($fromMe == 'false' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
        } else if ($fromMe == 'false' && ($type != 'text' && $type != 'image' && $type != 'ptt')) {
            $base64 = str_replace(' ', '', $message);
            echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0 message-text"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            }
        }
    }
    // $connection->close();
}
