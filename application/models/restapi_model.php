<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
public function getstories($storyid){
$query['story']=$this->db->query("SELECT `id`,`title`,`content`,`numberofimage`,`image1`,`image2`,`status` FROM `reniscience_story` WHERE `id`='$storyid'")->result();
	$query['storyimage']=$this->db->query("SELECT `reniscience_storyimage`.`id`,`reniscience_storyimage`.`storyid`,`reniscience_storyimage`.`order`,`reniscience_storyimage`.`image`,`reniscience_storyimage`.`status`,`reniscience_story`.`title` FROM `reniscience_story` LEFT OUTER JOIN `reniscience_storyimage` ON `reniscience_storyimage`.`storyid`=`reniscience_story`.`id` WHERE `reniscience_story`.`id`='$storyid'")->result();
		return $query;
}
	public function getallstories(){
	$query=$this->db->query("SELECT `id`,`title`,`content`,`numberofimage`,`image1`,`image2`,`status` FROM `reniscience_story`")->result();
		
		 foreach($query AS $row)
        {
            $row->images=$this->db->query("SELECT `storyid`,`image` FROM `reniscience_storyimage` WHERE `storyid`='$row->id'");
			 if($row->images->num_rows()>0)
			 {
				 $row->images=$row->images->result();
			 }
			 else
			 {
				 $row->images=array();
			 }
		 }
		return $query;
        
	}

}
?>
