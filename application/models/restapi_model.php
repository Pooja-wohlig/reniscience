<?php
if ( !defined( "BASEPATH" ) )
exit( "No direct script access allowed" );
class restapi_model extends CI_Model
{
public function getstories($storyid){
$query['story']=$this->db->query("SELECT `id`,`title`,`content`,`numberofimage`,`image1`,`image2`,`status`,`visibility` FROM `reniscience_story` WHERE `id`='$storyid'")->result();
	$query['storyimage']=$this->db->query("SELECT `reniscience_storyimage`.`id`,`reniscience_storyimage`.`storyid`,`reniscience_storyimage`.`order`,`reniscience_storyimage`.`image`,`reniscience_storyimage`.`status`,`reniscience_story`.`title` FROM `reniscience_story` LEFT OUTER JOIN `reniscience_storyimage` ON `reniscience_storyimage`.`storyid`=`reniscience_story`.`id` WHERE `reniscience_story`.`id`='$storyid'")->result();
		return $query;
}
	public function getallstories(){
	$query=$this->db->query("SELECT `id`,`title`,`content`,`numberofimage`,`image1`,`image2`,`status`,`visibility` FROM `reniscience_story`")->result();

		 foreach($query AS $row)
        {
             $row->images=array();
             $images=$this->db->query("SELECT `image` FROM `reniscience_storyimage` WHERE `storyid`='$row->id'");
			 if($images->num_rows()>0)
			 {
                 $images=$images->result();
                 foreach($images as $image)
                 {
                     //print_r($image);
                     if($image->image!="")
                     {
                        array_push($row->images,$image->image);
                     }
                 }

			 }
		 }
		return $query;

	}

	public function contactSubmit($name, $contact, $email, $enquiry)
	{
			$this->db->query("INSERT INTO `contact`(`name`,`contact`,`email`,`enquiry`) VALUE('$name', '$contact','$email','$enquiry')");
			if(!empty($email))
			{
				 $data['name']=$name;
				 $data['contact']=$contact;
				 $data['email']=$email;
				 $data['enquiry']=$enquiry;
				// $viewcontent = $this->load->view('emailers/contact', $data, true);
				// $this->menu_model->emailer($viewcontent,'Contact Form Submission','umpire@customcricketcompany.com',$username);
			}
			$object = new stdClass();
			$object->value = true;
			return $object;
	}

}
?>
