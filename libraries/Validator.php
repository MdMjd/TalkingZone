<?php
class Validator{
  /*
   * Check required fields
   */

   //Array of fields we want to be required and for each through them
   public function isRequired($field_array){
     foreach ($field_array as $field) {
       if($_POST[''.$field.''] == ''){
         return false;
       }
     }
     return true;
   }

   /*
    * Email Validator as the HTML is not secure and can be bypasssed , can use regular expressions etc.
    */
    public function isValidEmail($email){
      if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        return true;
      } else {
        return false;
      }
    }

    /*
     * Check passwords match, needs 2 fields
     */
     public function passwordsMatch($pw1,$pw2){
       if ($pw1 == $pw2) {
         return true;
       } else {
         return false;
       }
     }
}
