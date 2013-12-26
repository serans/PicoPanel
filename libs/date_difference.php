<?php 
/*
 * This function prints the difference between two php datetime objects
 * in a more human readable form
 * inputs should be like strtotime($date)
 * Adapted from https://gist.github.com/krishnakummar/1053741
 * which is in turn adapted from
 * Adapted from https://gist.github.com/207624 python version
 */
 
function dateDifference($now,$otherDate=null,$offset=null){
   if($otherDate != null){
      $offset = $now - $otherDate;
   }
   if($offset != null){
      $deltaS = $offset%60;
      $offset /= 60;
      $deltaM = $offset%60;
      $offset /= 60;
      $deltaH = $offset%24;
      $offset /= 24;
      $deltaD = ($offset > 1)?ceil($offset):$offset;
   } else{
      throw new Exception("Must supply otherdate or offset (from now)");
   }
   if($deltaD > 1){
      if($deltaD > 365){
         $years = ceil($deltaD/365);
         if($years ==1){
            return "last year";
         } else{
            return "$years years ago";
         }
      }
      if($deltaD > 6){
         return date('d-M',strtotime("$deltaD days ago"));
      }
      return "$deltaD days ago";
   }
   if($deltaD == 1){
      return "Yesterday";
   }
   if($deltaH == 1){
     return "last hour";
   }
   if($deltaM == 1){
     return "last minute";
   }
   if($deltaH > 0){
     return $deltaH." hours ago";
   }
   if($deltaM > 0){
     return $deltaM." minutes ago";
   }
   else{
     return "few seconds ago";
   }
}
