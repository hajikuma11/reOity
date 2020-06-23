<?php
require_once ("login.php");

if (strstr($text,'def:')) {
    $text = substr($text, 4);

    if ($text == 'sign-up') {

        $sql = "SELECT EXISTS(SELECT * FROM user_data WHERE userid = '".$userID."')";

        $stmt = $dbh->query($sql);

        foreach ($stmt as $row) {
            $result = $row[0];
        }

        if ($result == 0) {

            $createdID = substr($userID, 0, 3).substr($userID, 30, 3);

            $sql = "INSERT INTO user_data VALUE (:userid, :defineid)";

            $stmt = $dbh->prepare($sql);

            $params = array(':userid' => $userID, ':defineid' => $createdID);

            $stmt->execute($params);


            $sql = "INSERT INTO def_data (id) VALUE (:id)";

            $stmt = $dbh->prepare($sql);

            $params = array(':id' => $createdID);

            $stmt->execute($params);


            $messageData = [
                'type' => 'text',
                'text' => 'completed sing up'."\n".$userID."\n".$createdID
            ];

        } else {

            $messageData = [
                'type' => 'text',
                'text' => 'id is exist'
            ];

        }

    }

    elseif (strstr($text,'sign-out:')) {

        $text = substr($text,9);

        $sql = "SELECT EXISTS(SELECT * FROM user_data WHERE userid = '".$userID."')";

        $stmt = $dbh->query($sql);

        foreach ($stmt as $row) {
            $result = $row[0];
        }

        if ($result == 1) {

            if ($text == 'confirm') {

                $jsn = file_get_contents(dirname(__FILE__).'/flexJson/deleteconfirm.json');
                $jsn = json_decode($jsn,true);

                $messageData = [
                    'type' => 'flex',
                    'altText' => '確認',
                    'contents' => $jsn
                ];


            } else {

                $sql = "DELETE FROM user_data WHERE userid = '".$userID."'";

                $stmt = $dbh->query($sql);

                $messageData = [
                    'type' => 'text',
                    'text' => 'id was deleted'
                ];

            }

        } else {

            $messageData = [
                'type' => 'text',
                'text' => 'id is not exist'
            ];

        }

    }

    elseif ($text == 'confirm') {

        $sql = "SELECT EXISTS(SELECT * FROM user_data WHERE userid = '".$userID."')";

        $stmt = $dbh->query($sql);

        foreach ($stmt as $row) {
            $result = $row[0];
        }

        if ($result == 1) {

            $messageData = [
                'type' => 'text',
                'text' => 'id is exist'
            ];

        } else {

            $messageData = [
                'type' => 'text',
                'text' => 'id is not exist'
            ];

        }

    }

    elseif (strstr($text,'setting:')) {
        $text = substr($text,8);

        if ($text == 'menu') {

            $jsn = file_get_contents(dirname(__FILE__).'/flexJson/defmenu.json');
            $jsn = json_decode($jsn,true);
            $msgFlag = 1;

            $messageData = [
                'type' => 'flex',
                'altText' => 'メニュー',
                'contents' => $jsn
            ];

            $messageData2 = [
                'type' => 'image',
                'originalContentUrl' => 'https://oity.sakura.ne.jp/image/1f.jpg',
                'previewImageUrl' => 'https://oity.sakura.ne.jp/image/1fs.jpg'
            ];

        }

        elseif ($text == 'test') {

            $messageData = array(
            'type' => 'text',
            'text' => '選択してね',
            'quickReply' => array(
                'items' => array(
                    array(
                        'type' => 'action',
                        'action' => array(
                            'type' => 'camera',
                            'label' => 'カメラを起動',
                        )
                    ),
                    array(
                        'type' => 'action',
                        'action' => array(
                            'type' => 'cameraRoll',
                            'label' => '画像を送信',
                        )
                    ),
                    array(
                        'type' => 'action',
                        'action' => array(
                            'type' => 'location',
                            'label' => '位置情報を送信',
                        )
                    ),
                )
            )
        );
        }

    }

}