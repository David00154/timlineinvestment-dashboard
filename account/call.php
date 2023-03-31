<?php
include "../core/config.php";

function getPlanDetails($royaldb, $plan, $plan2){
    
			
			
				$query = "select * from plans where id='$plan'";
				$result = $royaldb->query($query) or die($royaldb->error);
    if($result->num_rows>0){
				$resultSet = $result->fetch_assoc();
				$salary_date= $resultSet[$plan2];
				return $salary_date;
    }
    else{
        return 0;
    }
			
		}

if ((isset($_GET['func_name'])) && (isset($_GET['plan'])) && (isset($_GET['getplan'])) ){
					$func_name= $_GET['func_name'];
					$plan= $_GET['plan'];
                    $getplan= $_GET['getplan'];

					if ($func_name=="getPlanDetails") {
				 		echo (getPlanDetails($royaldb, $plan, $getplan));
				 	}

			}


?>
