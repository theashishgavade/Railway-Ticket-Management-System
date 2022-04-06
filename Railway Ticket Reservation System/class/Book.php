<?php 
require_once('../database/Database.php');
require_once('../interface/iBook.php');
class Book extends Database implements iBook{

	public function getAllBook()
	{
		$sql = "SELECT *
				FROM booked
				GROUP BY book_tracker;
		";
		return $this->getRows($sql);
	}//end getAllBook

	public function deleteBook($tracker)
	{
		$sql = "DELETE FROM booked WHERE book_tracker = ?;";
		// return true;
		return $this->deleteRow($sql, [$tracker]);
	}//end deleteBook

	public function getBookBy($tracker)//limit 1
	{
		$sql = "SELECT * FROM booked WHERE book_tracker = ? LIMIT 1";
		return $this->getRow($sql, [$tracker]);
	}//end getPassengerList

	public function getPassengers($tracker)
	{
		$sql = "SELECT *
				FROM booked b 
				INNER JOIN accomodation a 
				ON b.acc_id = a.acc_id
				WHERE b.book_tracker = ?;
		";
		return $this->getRows($sql, [$tracker]);
	}///end getPassengers

	public function selectBook($book_id)
	{
		$sql = "SELECT *
				FROM booked b
				INNER JOIN accomodation a 
				ON b.acc_id = a.acc_id 
				INNER JOIN origin o 
				ON b.origin_id = o.origin_id
				INNER JOIN destination d 
				ON b.dest_id = d.dest_id 
				WHERE b.book_id = ?;
		";
		return $this->getRow($sql, [$book_id]);
	}//end selectBook

	public function deleteBookByID($bid)
	{
		$sql = "DELETE 
				FROM booked 
				WHERE book_id = ?
		";
		return $this->deleteRow($sql, [$bid]);
	}//end deleteBookByID

}//end class

$book = new Book();