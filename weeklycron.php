<?php
include "core/config.php";

//check User with weekely cronjob

$checkuser=$royaldb->query("SELECT * FROM user WHERE status=1 AND interest_time < $time") or die($royaldb->error);
if($checkuser->num_rows>0){
    while($loaduser=$checkuser->fetch_object()){
        $i_time = generateTime("+1 $loaduser->plantype");
        $newprofit= $loaduser->interest;
        if($loaduser->profit_times > 1){
        $updateu=$royaldb->query("UPDATE user SET earnings= earnings + $newprofit, interest_time='$i_time', profit_times= profit_times - 1 WHERE id=$loaduser->id") or die($royaldb->error);
        }
        else{
            $bal=$loaduser->deposit + $loaduser->earnings + $loaduser->interest;
            $getdepo=$royaldb->query("SELECT * FROM deposit WHERE user_id=$loaduser->id AND status=1 ORDER BY id DESC LIMIT 1");
            if($getdepo->num_rows>0){
                $depoload=$getdepo->fetch_object();
                $updatedepo=$royaldb->query("UPDATE deposit SET status=2 WHERE id=$depoload->id AND status=1") or die($royaldb->error);
            }
            $uUser=$royaldb->query("UPDATE user SET balance=balance + $bal, earnings='0', deposit='0', interest='0', plantype='', interest_time='', profit_times='0', status='0' WHERE id=$loaduser->id") or die($royaldb->error);
        }
        //Mailer here
        $usr = new Royaltechinc\Mailer;
        $usr->mailUserProfit($loaduser->email, $loaduser->full_name, $newprofit, $loaduser->plantype);
        
        echo nl2br("Profit Added for $loaduser->email \n");
    }
}
else{
echo "No Profit Available";
}
?>
