<?php

session_start();
date_default_timezone_set("Asia/Taipei");

class DB{
  private $dsn="mysql:hostname=localhost;dbname=lighttech;charset=utf8";
  private $table;
  private $pdo;

  function __construct($table)
  {
    $this->table=$table;
    $this->pdo=new PDO($this->dsn,"root","");
  }

  function all(...$arg){
    $sql="select * from $this->table";
    if(!empty($arg[0])&&is_array($arg[0])){
      foreach($arg[0]as$k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }
    if(!empty($arg[1])){
      $sql=$sql.$arg[1];
    }
    return $this->pdo->query($sql)->fetchAll();
  }

  function count(...$arg){
    $sql="select count(*) from $this->table";
    if(!empty($arg[0])&&is_array($arg[0])){
      foreach($arg[0]as$k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }
    if(!empty($arg[1])){
      $sql=$sql.$arg[1];
    }
    return $this->pdo->query($sql)->fetchColumn();
  }

  function find($arg){
    $sql="select * from $this->table";
    if(is_array($arg)){
      foreach($arg as$k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }else{
      $sql=$sql." where `id`='".$arg."'";
    }
    return $this->pdo->query($sql)->fetch(PDO::FETCH_ASSOC);
  }

  function delete($arg){
    $sql="delete from $this->table";
    if(is_array($arg)){
      foreach($arg as$k=>$v){
        $tmp[]=sprintf("`%s`='%s'",$k,$v);
      }
      $sql=$sql." where ".implode(" && ",$tmp);
    }else{
      $sql=$sql." where `id`='".$arg."'";
    }
    return $this->pdo->exec($sql);
  }

  function save($arg){
    if(empty($arg['id'])){
      $sql="insert into $this->table (`".implode("`,`",array_keys($arg))."`) values ('".implode("','",$arg)."')";
    }else{
      foreach($arg as $k=>$v){
        if($k!='id'){
          $tmp[]=sprintf("`%s`='%s'",$k,$v);
        }
      }
      $sql="update $this->table set ".implode(",",$tmp)." where `id`='".$arg['id']."'";
    }
    echo $sql;
    return $this->pdo->exec($sql);
  }

  function q($sql){
    return $this->pdo->query($sql)->fetchAll();
  }
}

function to($url){
  header("location:".$url);
}

$User=new DB('user');
$Customer=new DB('customer');
$Products=new DB('products');
$Category=new DB('category');
$Price=new DB('price');
$Inquiry=new DB('inquiry');
$Inquiry_details=new DB('inquiry_details');
?>