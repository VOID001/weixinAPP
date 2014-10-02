<?
	//ClassID: VSession
	//Description:This is the session control,Get the UserID
	//			  and access the Session Database then operate 
	// 			  the session Info with functions given below
	class VSession{
		private $userID;
		public function check_session()
		{
			$SQLQUERY="SELECT * FROM session WHERE UID ='".$this->userID
		}

		public function set_session()
		{

		}

		public function get_session()
		{

		}

		public function __construct($uid)
		{
			$userID=$uid;
		}
	}
	
