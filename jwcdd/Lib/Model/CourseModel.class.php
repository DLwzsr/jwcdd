<?php
	class CourseModel extends Model {
		protected $tableName = "KCXX";
		protected $fields = array(
			'coursetype','year','term','courseid','cname','category1','category2','ctime1','ctime2','week','cplace1','cplace2','teaid','teaname','tcollege','sclassid','sclass'
		);
	}

?>