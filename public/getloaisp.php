<?php
  include("connect.php");
  $query="SELECT * FROM type_products";
  $data=mysqli_query($conn,$query);
  $mangloaisp = array();
  while($row=mysqli_fetch_assoc($data))
  {
  	array_push($mangloaisp,new Loaisp($row['id'],$row['name'],$row['image']));

  }
echo json_encode($mangloaisp);
class Loaisp{
	function Loaisp($id,$tenloaisp,$hinhanhloaisp)
	{
        $this->id=$id;
        $this->tenloaisanpham=$tenloaisp;
        $this->hinhanhloaisanpham=$hinhanhloaisp;
	}
}

?>