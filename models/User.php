<?php
    class User {
         // Class properties and methods go here

         // Fields
         public $user_id;
         public $user_name;
         public $user_password;
         public $user_role;

         // Constructor of class User
         public function __construct($user_id, $user_name, $user_password, $user_role){
            $this->id = $user_id;
            $this->name = $user_name;
            $this->password = $user_password;
            $this->role = $user_role;
            return true;
         }

         /** Getter Methods */

         /**
          * Getter Method: get the id of the User
          * @return the id of the User
          */
         public function getId(){
            return $this->id;
         }

         /**
          * Getter Method: get the name of the User
          * @return the name of the User
          */
         public function getName(){
            return $this->name;
         }

         /**
          * Getter Method: get the password of the User
          * @return the password of the User
          */
         public function getPassword(){
            return $this->password;
         }

         /**
          * Getter Method: get the role of the User
          * @return the role of the User
          */
         public function getRole(){
            return $this->role;
         }

    }

 ?>