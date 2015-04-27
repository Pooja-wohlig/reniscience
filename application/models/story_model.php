<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class story_model extends CI_Model
{
public function create($title,$content,$numberofimage,$image1,$image2,$status,$timestamp)
{
$data=array("title" => $title,"content" => $content,"numberofimage" => $numberofimage,"image1" => $image1,"image2" => $image2,"status" => $status,"timestamp" => $timestamp);
$query=$this->db->insert( "reniscience_story", $data );
$id=$this->db->insert_id();
if(!$query)
return  0;
else
return  $id;
}
public function beforeedit($id)
{
$this->db->where("id",$id);
$query=$this->db->get("reniscience_story")->row();
return $query;
}
function getsinglestory($id){
$this->db->where("id",$id);
$query=$this->db->get("reniscience_story")->row();
return $query;
}
public function edit($id,$title,$content,$numberofimage,$image1,$image2,$status,$timestamp)
{
$data=array("title" => $title,"content" => $content,"numberofimage" => $numberofimage,"image1" => $image1,"image2" => $image2,"status" => $status,"timestamp" => $timestamp);
$this->db->where( "id", $id );
$query=$this->db->update( "reniscience_story", $data );
return 1;
}
	   
	public function getstoryimagebyid1($id)
	{
		$query=$this->db->query("SELECT `image1` FROM `reniscience_story` WHERE `id`='$id'")->row();
		return $query;
	}
	public function getstoryimagebyid2($id)
	{
		$query=$this->db->query("SELECT `image2` FROM `reniscience_story` WHERE `id`='$id'")->row();
		return $query;
	}
public function delete($id)
{
$query=$this->db->query("DELETE FROM `reniscience_story` WHERE `id`='$id'");
return $query;
}
	public function getnumberofimagedropdown(){
$query=$this->db->query("SELECT * FROM `numberofimage`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->name;
		}
		
		return $return;
	}
	public function getstorydropdown(){
$query=$this->db->query("SELECT * FROM `reniscience_story`  ORDER BY `id` ASC")->result();
		$return=array(
		);
		foreach($query as $row)
		{
			$return[$row->id]=$row->title;
		}
		
		return $return;
	}

}
?>
