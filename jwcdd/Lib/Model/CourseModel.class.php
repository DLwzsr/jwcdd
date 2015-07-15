<?php
	class CourseModel extends Model {
		protected $tableName = "KCXX";
		protected $fields = array(
			'CID','COURSETYPE','YEAR','TERM','COURSEID','CNAME','CATEGORY1','CATEGORY2','CTIME1','CTIME2','WEEK','CPLACE1','CPLACE2','TEAID','TEANAME','TCOLLEGE','TITLE','SCOLLEGE','SCLASSID','SCLASS'
		);
	}

?>