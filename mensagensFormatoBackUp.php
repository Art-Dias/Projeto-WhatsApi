<?php
session_start();
$device_token = $_SESSION['device_token'];

// callFunction.php

$myValue = $_GET['myValue'];
$selfCall = $_GET['selfCall'];
$idMaquina = $_GET['idMaquina'];


if (function_exists('function1')) {
    call_user_func('function1', "$myValue", "$selfCall", $idMaquina, $device_token);
} else {
    echo "Function not found";
}

function function1($myValue, $selfCall, $idMaquina, $device_token)
{
    $selectedChat = $myValue;
    if ($selfCall == 0) {
        // Include the database connection file
        require '../connection.php';

        $connection = DatabaseConnection::getConnection();

        // Atualizando mensagens da conversa como lido
        $connection->query("UPDATE `mensagem_infos` SET lido = '1' WHERE number_from = \"$selectedChat\" AND lido = '0' AND device_token = \"$device_token\"");

        $resultMsg = $connection->query("SELECT * FROM (SELECT * FROM mensagem_infos WHERE (number_from = \"$selectedChat\" or number_to = \"$selectedChat\") AND device_token = \"$device_token\" ORDER BY id DESC LIMIT 20 ) AS subquery ORDER BY id ASC");
        // $resultMsg = $connection->query("SELECT * FROM (SELECT * FROM mensagem_infos WHERE (number_from = \"$selectedChat\" or number_to = \"$selectedChat\") ORDER BY id DESC LIMIT 20 ) AS subquery ORDER BY id ASC");
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
                echo '<div class="right" style="z-index: 1"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            } else if ($fromMe == 'false' && $type == 'text') {
                echo '<div class="left" style="z-index: 1"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            }

            // Image
            if ($fromMe == 'true' && $type == 'image') {
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                    echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            } else if ($fromMe == 'false' && $type == 'image') {
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                    echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            }

            // ptt = audio
            if ($fromMe == 'true' && $type == 'ptt') {
                $audioBase64 = str_replace(' ', '', $message);
                echo '<div class="right" style="position: relative; float: right;"> <div> <audio controls class="audio-right" style="float: right;"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0" style="float: right; margin-right: 8px; width: 100%; padding-bottom: 15px;"> <span class="align-middle" style="font-size: 12px; float: right;"> ' . $timeIn24HourFormat . ' </span> <i class="ri-time-line align-middle" style="float: right;"></i> </p> </div>';

                // echo '<div class="right" style="position: relative; float: right;"><div><audio controls class="audio-right"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio></div> <p class="chat-time mb-0" style="float: right; margin-right: 8px"><i class="ri-time-line align-middle"></i> <span class="align-middle" style="font-size: 12px">' . $timeIn24HourFormat . '</span> </p> </div>';
            } else if ($fromMe == 'false' && $type == 'ptt') {
                $audioBase64 = str_replace(' ', '', $message);
                echo '<div class="left"><div><audio controls class="audio-right"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle" style="font-size: 12px">' . $timeIn24HourFormat . '</span> </p> </div>';
            }

            // PDF ou MSWORD or DOC or DOCX
            if ($fromMe == 'true' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
                $base64 = str_replace(' ', '', $message);
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                    echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            } else if ($fromMe == 'false' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
                $base64 = str_replace(' ', '', $message);
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                    echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            }
        }
        // $connection->close();
    }

    if ($selfCall == 1) {

        // Include the database connection file
        require '../connection.php';

        $connection = DatabaseConnection::getConnection();


        $result = $connection->query("SELECT id FROM `mensagem_infos` WHERE (number_from = \"$selectedChat\" OR number_to = \"$selectedChat\") AND device_token = \"$device_token\" ORDER BY id DESC LIMIT 1");
        $rowValue = mysqli_fetch_assoc($result);
        $indexUltimaMsg = $rowValue['id'];
        if (empty($indexUltimaMsg)) {
            $indiceMsg = 0;
        } else {
            $indiceMsg = file_get_contents("../indicesCvs/indiceMsgCvsAtual$idMaquina.txt");
        }


        // Atualizando mensagens da conversa como lido
        $connection->query("UPDATE `mensagem_infos` SET lido = '1' WHERE number_from = \"$selectedChat\" AND lido = '0' AND device_token = \"$device_token\"");

        $resultMsg = $connection->query("SELECT * FROM mensagem_infos WHERE (number_from = \"$selectedChat\" OR number_to = \"$selectedChat\") AND (id > $indiceMsg) AND device_token = \"$device_token\" ORDER BY id ASC");
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
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            } else if ($fromMe == 'false' && $type == 'text') {
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            }

            // Image
            if ($fromMe == 'true' && $type == 'image') {
                // echo '<div class="square-with-border-right-image"> <img src=' . $message . ' alt="Indisponivel"> </div>';
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                    echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            } else if ($fromMe == 'false' && $type == 'image') {
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                    echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            }

            // ptt = audio
            if ($fromMe == 'true' && $type == 'ptt') {
                $audioBase64 = str_replace(' ', '', $message);
                echo '<div class="right" style="position: relative; float: right;"> <div> <audio controls class="audio-right" style="float: right;"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0" style="float: right; margin-right: 8px; width: 100%; padding-bottom: 15px;"> <span class="align-middle" style="font-size: 12px; float: right;"> ' . $timeIn24HourFormat . ' </span> <i class="ri-time-line align-middle" style="float: right;"></i> </p> </div>';
            } else if ($fromMe == 'false' && $type == 'ptt') {
                $audioBase64 = str_replace(' ', '', $message);
                echo '<div class="left"><div><audio controls class="audio-right"> <source src=' . $audioBase64 . ' type="audio/ogg"> </audio> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle" style="font-size: 12px">' . $timeIn24HourFormat . '</span> </p> </div>';
            }

            // PDF ou MSWORD or DOC or DOCX
            if ($fromMe == 'true' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
                $base64 = str_replace(' ', '', $message);
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                    echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            } else if ($fromMe == 'false' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
                $base64 = str_replace(' ', '', $message);
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
                if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                    echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
                }
            }


            // $connection->close();
        }
        $result = $connection->query("SELECT id FROM `mensagem_infos` WHERE (number_from = \"$selectedChat\" OR number_to = \"$selectedChat\") AND device_token = \"$device_token\" ORDER BY id DESC LIMIT 1");
        $rowValue = mysqli_fetch_assoc($result);
        $indexUltimaMsg = $rowValue['id'];
        if (empty($indexUltimaMsg)) {
            file_put_contents("../indicesCvs/indiceMsgCvsAtual$idMaquina.txt", 0);
        } else {
            file_put_contents("../indicesCvs/indiceMsgCvsAtual$idMaquina.txt", $indexUltimaMsg);
        }
    }
}



// Mensagens anterioes
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
            echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
        } else if ($fromMe == 'false' && $type == 'text') {
            echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $message . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
        }

        // Image
        if ($fromMe == 'true' && $type == 'image') {
            echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                echo '<div class="right" style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            }
        } else if ($fromMe == 'false' && $type == 'image') {
            echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"><img src=' . $message . ' alt="Indisponivel" style="max-width: 500px; max-height: 400px;"></p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption))) {
                echo '<div style="position: relative; z-index: 1;"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
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
        if ($fromMe == 'true' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
            $base64 = str_replace(' ', '', $message);
            echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                echo '<div class="right"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            }
        } else if ($fromMe == 'false' && ($type == 'pdf' || $type == 'msword' || $type == 'doc' || $type == 'docx')) {
            $base64 = str_replace(' ', '', $message);
            echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content"> <div class="card p-2 mb-2"> <div class="d-flex flex-wrap align-items-center attached-file"> <div class="avatar-sm me-3 ms-0 attached-file-avatar"> <div class="avatar-title bg-primary-subtle text-primary rounded font-size-20"> <i class="ri-file-text-fill"></i> </div> </div> <div class="flex-grow-1 overflow-hidden"> <div class="text-start"> <h5 class="font-size-14 text-truncate mb-1"> ' . $nomeArquivo . '</h5> </div> </div> <div class="ms-4 me-0"> <div class="d-flex gap-2 font-size-20 d-flex align-items-start"> <div> <a onclick="downloadBase64(\'' . $base64 . '\', \'' . $nomeArquivo . '\')" class="fw-medium"> <i class="ri-download-2-line"></i> </a> </div> </div> </div> </div> </div> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> </div> </div> </div> </div>';
            if (strlen($caption) > 0 && $caption != 'null' && (!is_null($caption)) && $nomeArquivo != $caption) {
                echo '<div class="left"> <div class="conversation-list"> <div class="user-chat-content"> <div class="ctext-wrap"> <div class="ctext-wrap-content" style="max-width: 600px; white-space: pre-line; word-wrap: break-word;"> <p class="mb-0"> ' . $caption . ' </p> <p class="chat-time mb-0"><i class="ri-time-line align-middle"></i> <span class="align-middle">' . $timeIn24HourFormat . '</span> </p> </div> <div class="dropdown align-self-start"> <a class="dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="ri-more-2-fill"></i> </a> <div class="dropdown-menu"> <a class="dropdown-item" href="#">Copy <i class="ri-file-copy-line float-end text-muted"></i></a> <a class="dropdown-item" href="#">Delete <i class="ri-delete-bin-line float-end text-muted"></i></a> </div> </div> </div> </div> </div> </div>';
            }
        }
    }
    // $connection->close();
}
