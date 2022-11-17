<?php

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
    // $allUsers = $dbh->query("select * from user_data")->fetchAll(PDO::FETCH_ASSOC);

    $sql = 'SHOW TABLES';
    $query = $dbh->query($sql);
    $dbh = null;

    print_r($db_tables = $query->fetchAll(PDO::FETCH_COLUMN));
    print_r($allUsers);

} catch (PDOException $e) {
    echo $e->getCode() . ': ' . $e->getMessage();
}