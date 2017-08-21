<?php
class Topic{
  //Init DB Variable
  private $db;

  /*
   * Constructor - just runs when you create a new topic object
   */

   public function __construct(){
     $this->db = new Database;
   }

   /*
    *  Get All Topics - Specify what you want from each table, first line then set conditions
    *  And we want to to relate the topics usr_id and users usr_id
    *  Assign result set lastly after the sql statement using $results using resultset in DB page
    */

    public function getAllTopics(){
      $this->db->query("SELECT topics.*, users.usr_username, users.usr_avatar, categories.ca_name FROM topics
                        INNER JOIN users
                        ON topics.usr_id = users.usr_id
                        INNER JOIN categories
                        ON topics.ca_id = categories.ca_id
                        ORDER BY tpc_create_date DESC
                        ");

                        $results = $this->db->resultset();

                        return $results;
    }

    /*
     * Get Topics By Category
     */

     public function getByCategory($category_id) {
       $this->db->query("SELECT topics.*, categories.*, users.usr_username, users.usr_avatar FROM topics
       INNER JOIN categories
       ON topics.ca_id = categories.ca_id
       INNER JOIN users
       ON topics.usr_id = users.usr_id
       WHERE topics.ca_id = :category_id");

       $this->db->bind(':category_id', $category_id);

       //Assign Row
       $results = $this->db->resultset();

       return $results;
     }

     /*
      * Get Topics By Username
      */
     public function getByUser($user_id){
       $this->db->query("SELECT topics.*, categories.*, users.usr_username, users.usr_avatar FROM topics
               INNER JOIN categories
               ON topics.ca_id = categories.ca_id
               INNER JOIN users
               ON topics.usr_id=users.usr_id
               WHERE topics.usr_id = :user_id
       ");
       $this->db->bind(':user_id', $user_id);

       //Assign Result Set
       $results = $this->db->resultset();

       return $results;
     }

    /*
     * Get Total # of Topics
     */

     public function getTotalTopics() {
       $this->db->query('SELECT * FROM topics');
       $rows = $this->db->resultset();
       return $this->db->rowCount();
     }

     /*
      * Get Total # of Categories
      */

      public function getTotalCategories() {
        $this->db->query('SELECT * FROM categories');
        $rows = $this->db->resultset();
        return $this->db->rowCount();
      }

      /*
       * Get Category by ID - Pass in category ID
       */
      public function getCategory($category_id){
        $this->db->query("SELECT * FROM categories WHERE ca_id = :category_id");
        $this->db->bind(':category_id', $category_id);

        //Assign Row
        $row = $this->db->single();

        return $row;
      }

      /*
       * Get Total # of Replies
       * Getting the total number from blobs?
       */

       public function getTotalReplies($tpc_id) {
         $this->db->query('SELECT * FROM replies WHERE tpc_id = '.$tpc_id);
         $rows = $this->db->resultset();
         return $this->db->rowCount();
       }

       /*
        * Get Topic by ID
        */

        public function getTopic($id) {
          $this->db->query("SELECT topics.*,users.usr_username, users.usr_avatar FROM topics
          INNER JOIN users
          ON topics.usr_id = users.usr_id
          WHERE topics.tpc_id = :id
          ");
          $this->db->bind(':id', $id);

          //Assign Row
          $row = $this->db->single();

          return $row;
        }

        /*
      	 * Get Topic Replies Call from the first Table and INNER JOIN then conditions
      	 */
      	public function getReplies($topic_id){
      		$this->db->query("SELECT replies.*, users.* FROM replies
      						INNER JOIN users
      						ON replies.usr_id = users.usr_id
      						WHERE replies.tpc_id = :topic_id
      						ORDER BY rep_create_date ASC
      		");
      		$this->db->bind(':topic_id', $topic_id);

      		//Assign Result Set
      		$results = $this->db->resultset();

      		return $results;
      	}

        public function create($data){
          //Insert Query
          $this->db->query("INSERT INTO topics (ca_id, usr_id, tpc_title, tpc_body, tpc_last_activity)
                            VALUES (:category_id, :user_id, :title,:body,:last_activity)");
          //Bind Values
          $this->db->bind(':category_id', $data['category_id']);
          $this->db->bind(':user_id', $data['user_id']);
          $this->db->bind(':title', $data['title']);
          $this->db->bind(':body', $data['body']);
          $this->db->bind(':last_activity', $data['last_activity']);
          //Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }

        /*
         * Add Reply
         */
        public function reply($data){
          //Insert Query
          $this->db->query("INSERT INTO replies (tpc_id, usr_id, rep_body)
                            VALUES (:topic_id, :user_id, :body)");
          //Bind Values
          $this->db->bind(':topic_id', $data['topic_id']);
          $this->db->bind(':user_id', $data['user_id']);
          $this->db->bind(':body', $data['body']);
          //Execute
          if($this->db->execute()){
            return true;
          } else {
            return false;
          }
        }
}
 ?>
