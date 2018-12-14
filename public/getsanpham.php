<?php
  include('connect.php');
  $page=$_GET['page'];
  $idsp=$_POST['idsanpham'];
 // $idsp=2;
  $space=5;
  $limit=($page-1)*$space;
  $mangsanpham=array();
  $query="SELECT * FROM products WHERE id_type = $idsp LIMIT $limit,$space";
  $data=mysqli_query($conn,$query);
  while($row = mysqli_fetch_assoc($data))
  {
      array_push($mangsanpham,new Sanpham(
       $row['id'],
       $row['name'],
       $row['unit_price'],
       $row['image'],
       $row['description'],
       $row['id_type']
      ));

  }
  echo json_encode($mangsanpham);
  class Sanpham
  {
  	function Sanpham($id,$tensp,$giasp,$hinhanhsp,$motasp,$idsanpham){
  		$this->id=$id;
  		$this->tensp=$tensp;
  		$this->giasp=$giasp;
  		$this->hinhanhsp=$hinhanhsp;
  		$this->motasp=$motasp;
  		$this->idsp=$idsanpham;
  	}
  }




?>