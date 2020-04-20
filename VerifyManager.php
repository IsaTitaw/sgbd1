<?php


class VerifyManager
{
   public static function sanitizeData(&$data)
   {
       if (isset($data['pk'])) {
           $data['pk'] = VerifyManager::sanitizeInput($data['pk']);
       }
       if (isset($data['name'])) {
           $data['name'] = VerifyManager::sanitizeInput($data['name']);
       }
       if (isset($data['price'])) {
           $data['price'] = VerifyManager::sanitizeInput($data['price']);
       }
       if (isset($data['quantity'])) {
           $data['quantity'] = VerifyManager::sanitizeInput($data['quantity']);
       }


       if (isset($data['username'])) {
           $data['username'] = VerifyManager::sanitizeInput($data['username']);
       }

       if (isset($data['password'])) {
           $data['password'] = VerifyManager::sanitizeInput($data['password']);

           if (strlen($data['password']) < 8) {
               return false;
           }
       }

       if (isset($data['quantity']) && isset($data['price'])) {
          if ($data['quantity'] < 0 || $data['price'] < 0 ) {
               return false;
          }
       }

       return true;
   }

    public static function sanitizeInput($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}