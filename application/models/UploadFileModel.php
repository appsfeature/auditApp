<?php
      defined('BASEPATH') OR exit('No direct script access allowed');

class UploadFileModel extends CI_Model{

	public function insertImageDetails($imageName="efwe",$image=null){
		
		$data = array('imageName'=>$imageName,'imageUrl'=>$image);
		$this->db->insert('image',$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function getImageDetails(){
	    $query = $this->db->query('Select * from image');
		$result = $query->result_array();
		if($this->db->affected_rows())
		{
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function getNewFeedsList(){
	    $query = $this->db->query('Select * from story_category');
		$result = $query->result_array();
		if($result)
		{
			foreach($result as $key => $details)
			{
				$newsFeed = $this->db->query("Select * from story_feeds WHERE cat_id = '".$details['cat_id']."'");
				$newsFeed = $newsFeed->result_array();
				if($newsFeed)
				{
					$result[$key]['storyFeeds'] = $newsFeed;
				}
			}

			return $result;
		}
		else
		{
			return false;
		}
	}

	public function verifyUser($username,$password)
	{
		$query = $this->db->query("Select * from users WHERE username = '".$username."' AND password='".$password."'");
		$result = $query->result_array();
		if($this->db->affected_rows()){
			return $result;
		}
		else
		{
			return false;
		}
	}

	public function registerUser($username,$password,$name)
	{
		$data = Array(
			"username" => $username,
			"password" => $password,
			"name" => $name,
			"activeDate" => date("Y-m-d H:i:s")
		);
		$this->db->insert("users",$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function addNewFeed($catId,$title,$detail,$imageUrl)
	{
		$data = Array(
			"cat_id" => $catId,
			"title" => $title,
			"detail" => $detail,
			"image_url" => $imageUrl
		);
		$this->db->insert("story_feeds",$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}
	
	public function addNewCategory($catName,$catDetail,$catImage)
	{
		$data = Array(
			"cat_name" => $catName,
			"cat_detail" => $catDetail,
			"cat_image" => $catImage
		);
		$this->db->insert("story_category",$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function updateNewFeed($id,$catId,$title,$detail,$imageUrl)
	{
		$data = Array(
			"cat_id" => $catId,
			"title" => $title,
			"detail" => $detail,
			"image_url" => $imageUrl
		);
		$this->db->where("id",$id);
		$this->db->update("story_feeds",$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}
 
	public function updateCategory($catId,$catName,$catDetail,$catImage)
	{
		$data = Array( 
			"cat_name" => $catName,
			"cat_detail" => $catDetail,
			"cat_image" => $catImage
		);
		$this->db->where("cat_id",$catId);
		$this->db->update("story_category",$data);
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function deleteNewFeed($id)
	{
		$this->db->delete("story_feeds",array('id'=>$id));
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function deleteCategory($catId)
	{
		$this->db->delete("story_category",array('cat_id'=>$catId));
		if($this->db->affected_rows()){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function checkUserAvailability($username)
	{
		$query = $this->db->query("Select * from users WHERE username = '".$username."' ");
		$result = $query->result_array();
		if($result){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function checkFeedAvailability($title)
	{
		$query = $this->db->query("Select * from story_feeds WHERE title = '".$title."' ");
		$result = $query->result_array();
		if($result){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function checkCategoryAvailability($catName)
	{
		$query = $this->db->query("Select * from story_category WHERE cat_name = '".$catName."' ");
		$result = $query->result_array();
		if($result){
			return true;
		}
		else
		{
			return false;
		}
	}

	public function changeActiveDate()
	{
		$query = $this->db->query("UPDATE users SET activeDate = '".date("Y-m-d H:i:s")."' ");
	}
}