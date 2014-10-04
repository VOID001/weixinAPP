<?
	//ClassID: VSession
	//Description:This is the session control,Get the UserID
	//			  and access the Session Database then operate 
	// 			  the session Info with functions given below
	class WechatSession{
		public $userID;
        public $sessID;
		public function check_session()
		{
			
        }   
        public function set_session($sessLayer,$sessNum)
		{
			global $connstr;
			switch($sessLayer)
			{
			case 1:
				$SQLQUERY="UPDATE session SET sess_1=".$sessNum." where UID='".$this->userID."'";
				break;
			case 2:
				$SQLQUERY="UPDATE session SET sess_2=".$sessNum." where UID='".$this->userID."'";
				break;
			case 3:
				$SQLQUERY="UPDATE session SET sess_3=".$sessNum." where UID='".$this->userID."'";
				break;
			default:
				$SQLQUERY="UPDATE session SET sess_1=".$sessNum." where UID='".$this->userID."'";
				break;
			}
				mysql_select_db(SAE_MYSQL_DB,$connstr);
				mysql_query($SQLQUERY);
				//echo $SQLQUERY;
				echo mysql_error();
				return ;
		}
		public function get_session()
		{
            global $connstr;
			$SQLQUERY="SELECT * FROM session WHERE UID ='".$this->userID."'";
			$err=mysql_select_db(SAE_MYSQL_DB,$connstr);
            if(!$err) return -2;
            $sqlQueryString=mysql_query($SQLQUERY);
            $resStr=mysql_fetch_array($sqlQueryString);
            echo mysql_error();
            if(!$resStr)
            {
                //Create a new session;
                $SQLQUERY="INSERT INTO session(UID,sess_1,sess_2,sess_3) VALUES ('".$this->userID."',0,0,0)";
				//echo $SQLQUERY;
                mysql_query($SQLQUERY,$connstr);
                echo mysql_error();
            }
            else
            {
               	$this->sessID[1]=$resStr['sess_1'];
                $this->sessID[2]=$resStr['sess_2'];	
                $this->sessID[3]=$resStr['sess_3'];
            }
		}

		public function __construct($uid)
		{
			$this->userID=$uid;
		}

        public function __destruct()
        {
            
        }
	}
	
