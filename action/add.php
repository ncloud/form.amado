<?php
    define('ROOT', '../');
    require_once ROOT . 'config.php';
    
    $output = new StdClass;
    $output->success = false;
    $output->use_database = false;
    $output->use_google_spreadsheet = false;

    if(empty($_POST)) {
        $output->message = '잘못된 접근입니다. 다시 확인해주세요';
    } else {
        $error = false;
        
        $from_name = isset($_POST['from_name']) ? $_POST['from_name'] : '';
        $from_email = isset($_POST['from_email']) ? $_POST['from_email'] : '';
        $object_type = isset($_POST['object_type']) ? $_POST['object_type'] : '';
        $object_name = isset($_POST['object_name']) ? $_POST['object_name'] : '';
        $message = isset($_POST['message']) ? $_POST['message'] : '';
        
        if(empty($from_name)) {
            $error = true;
            $output->error_target = 'from_name';
            $output->message = '이름이 비었습니다. 입력해주세요';
        } else {
            if(empty($from_email)) {
                $error = true;
                $output->error_target = 'from_email';
                $output->message = '이메일주소가 비었습니다. 입력해주세요';
            } else {
                if(empty($object_type)) {
                    $error = true;
                    $output->error_target = 'object_type';
                    $output->message = '물건종류가 비었습니다. 입력해주세요';
                } else {
                    if(empty($object_name)) {
                        $error = true;
                        $output->error_target = 'object_name';
                        $output->message = '물건이름이 비었습니다. 입력해주세요';
                    }
                }
            }
        }
        
        if(!$error) {
            if($config['db.use']) {
                $output->use_database  = true;
                
                require_once ROOT . 'library/class.db.php';
                
                $db = new DB($config['db.name'], $config['db.host'], $config['db.user'], $config['db.password']);
                $db->query("SET NAMES 'utf8'");
                
                $from_name = mysql_real_escape_string($from_name);
                $from_email = mysql_real_escape_string($from_email);
                $object_type = mysql_real_escape_string($object_type);
                $object_name = mysql_real_escape_string($object_name);
                $message = mysql_real_escape_string($message);
                
                $create_time = date('Y-m-d H:i:s', mktime());
                
                $db->execute("INSERT INTO forms (from_name, from_email, object_type, object_name, message, create_time) VALUES ('{$from_name}', '{$from_email}','{$object_type}','{$object_name}','{$message}', '{$create_time}');");
            }
            
            if($config['google.spreadsheet.use']) {
                $output->use_google_spreadsheet = true;
                
                $now_path = $_SERVER['DOCUMENT_ROOT'] . '/' . $config['sub_path'];

                set_include_path(get_include_path() . PATH_SEPARATOR . $now_path . '/library');
            
                require_once ROOT . 'library/Google.spreadsheet.php';
            
                $ss = new Google_Spreadsheet($config['google.username'],$config['google.password']);
                $ss->useSpreadsheetByKey($config['google.spreadsheet.key']);
                $ss->useWorksheet($config['google.worksheet.name']);
                
                $header_names = array('from-name','from-email','object-type','object-name','message');
                
                $headers = $ss->getHeaders();
                if(count($headers)==0 || count($headers) != count($header_names)) {
                    $ss->insertHeaders($header_names);
                }
            
                $row = array (
                    "from-name" => $from_name,
                    "from-email" => $from_email,
                    "object-type" => $object_type,
                    "object-name" => $object_name,
                    "message" => $message
                );
                
                if ($ss->addRow($row)) {
                    
                }
            }
        }
    }

    echo json_encode($output);