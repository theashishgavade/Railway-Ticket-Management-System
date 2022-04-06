<?php 
interface iBook{
	public function getAllBook();//distinct with book_tracker
	public function deleteBook($tracker);
	public function getBookBy($tracker);//limit 1
	public function getPassengers($tracker);
	public function selectBook($book_id);
	public function deleteBookByID($bid);
}//end iBook