<?php

function getTableFieldName($dbh, $tableName)
{
    $query = $dbh->prepare("DESCRIBE " . $tableName);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_COLUMN);
}

function saveDataToFile(string $fileName , array $arrData): void
{
    try {
        file_put_contents($fileName, json_encode($arrData, JSON_FORCE_OBJECT));
    } catch (\Exception $e) {
        throw new DataNotFoundException();
    } finally {
        unset($file);
    }
}

try {
    $dbh = new PDO("mysql:host=db_mysql; dbname=php_pro", "avrys", "mysqlavrys");
    $dbh->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING );
    $date = new DateTime();

//    $dbh->prepare("insert into user_data (created_at,update_at, name, password) values (?, ?, ?, ?)")
//        ->execute([
//            $date->format('Y-m-d H:i:s'),
//            $date->format('Y-m-d H:i:s'),
//            'Оленка',
//            md5('23112016')
//        ]);


    $allUsers = $dbh
        ->query("select id, name, update_at, phone from user_data left join user_phone on id = id_user where id > 1 ")
        ->fetchAll(PDO::FETCH_ASSOC);

    print_r($allUsers);

//     $allUsers = $dbh->query("select * from user_data")->fetchAll(PDO::FETCH_ASSOC);

//    $sql = 'SHOW TABLES';
//    $query = $dbh->query($sql);

    $sql = 'SHOW TABLES';
    $query = $dbh->query($sql);
    print_r($db_tables = $query->fetchAll(PDO::FETCH_COLUMN));

    foreach ($db_tables as $table) {
        $arrData = getTableFieldName($dbh, $table);
        echo 'arrData: ' . implode(', ', $arrData) . PHP_EOL;
        $allUsers = $dbh->query("select * from $table")->fetchAll(PDO::FETCH_ASSOC);

        $fileName = __DIR__.'/../storage';

        echo 'DUMP: ' . $fileName . PHP_EOL;

        // echo 'DUMP: ' . exec("mysqldump –-user [avrys] –-password=[mysqlavrys] $fileName > $table'.csv'");
        // $dump_output = shell_exec("mysqldump --opt --default-character-set=UTF8 --single-transaction --protocol=TCP -u --user=avrys --password=mysqlavrys --host=localhost $fileName > $table.csv");
        // echo $dump_output;

        // saveDataToFile($fileName, $allUsers);

//        foreach ($allUsers as $user) {
//            echo 'userField: ' . implode(', ', $user) . PHP_EOL;
//        }

        // print_r($allUsers);
    }

//    $q = $dbh->prepare("DESCRIBE user_phone");
//    $q->execute();
//    $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
//    print_r($table_fields);
//    $dbh = null;

//    print_r($db_tables = $query->fetchAll(PDO::FETCH_COLUMN));
//    print_r($allUsers);


} catch (PDOException $e) {
    echo $e->getCode() . ': ' . $e->getMessage();
}


