<?php
include('connect.php');
$mangspmoinhat=array();
$query="SELECT * FROM products ORDER BY id DESC LIMIT 6";
$data =mysqli_query($conn,$query);
while ($row=mysqli_fetch_assoc($data)) {
	array_push($mangspmoinhat,new Sanphammoinhat($row['id'],$row['name'],$row['unit_price'],$row['image'],$row['description'],$row['id_type']));
	
}
echo json_encode($mangspmoinhat);
class Sanphammoinhat{
	function Sanphammoinhat($id,$tensp,$giasp,$hinhanhsp,$motasp,$idloaisanpham)
	{
    $this->id=$id;
    $this->tensp=$tensp;
    $this->giasp=$giasp;
    $this->hinhanhsp=$hinhanhsp;
    $this->motasp=$motasp;
    $this->idloaisp=$idloaisanpham;
  
	}
}

?>