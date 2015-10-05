<?php

class User {
    public $ip;
    public $amount;
    public $games_left;

    public function __construct($ip){
        $player = reset(Database::select('users','*',array('ip'=>$ip)));

        if(empty($player)) {
            $player = array('ip'=>$ip, 'games_left'=>GAMES, 'amount'=>0);

            Database::insert('users',$player);
        }

        foreach($player as $key =>$value) {
            $this->$key = $value;
        }
    }

} 