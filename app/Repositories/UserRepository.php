<?php

namespace App\Repositories;

use App\Models\User;
//use App\Models\Task;

class UserRepository//this Pavel wrote
{
       
    public function sendEmail($subject, $message){
        mail($this->email, $subject, $message);
    }
    
}
