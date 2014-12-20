<?php
/* Created: 2013-9-29
*  Author: XiaoFeng
*  Group: IREG
*/
	/**
	 * 
	 * excel相关操作
	 * @author XiaFeng
	 *
	 */
	class excel{
		
		/**
		 * 
		 * 根据数据导出excel表
		 * @param array $dataArr 数据列表
		 * @param array $nameArr 数据属性列表
		 * @param array $attrArr 数组下表列表
		 * @param String $fileName excel文件名
		 */
		public function exportExcel($dataArr,$nameArr,$attrArr,$fileName){
			
			vendor('PHPExcel.PHPExcel');
			$objPHPExcel = new PHPExcel();
			$objPHPExcel->getProperties()->setCreator($author)
										 ->setLastModifiedBy($author)
										 ->setTitle($title)
										 ->setSubject($title)
										 ->setDescription("Big Data & IoT")
										 ->setKeywords("PHPExcel")
										 ->setCategory("infomation");
			$length1 = count($nameArr,0);
			$length2 = count($dataArr,0);
			$author = 'IREG';
			$title = 'IREG';
			$n = 0;
			$Letter = array("A","B","C","D","E","F","G","H","I","J","K","L","M",
							"N","O","P","Q","R","S","T","U","V","W","X","Y","Z",
							"AA","AB","AC","AD","AE","AF","AG","AH","AI","AJ","AK",
							"AL","AM","AO","AP","AQ","AR","AS","AT","AU","AV","AW",
							"AX","AY","AZ");
			//生成excel首行标示信息
			for($i = 0; $i < $length1; $i++){
				$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Letter[$i].'1',$nameArr[$i]);
			}
			//生成每一行数据
			for($i = 0;  $i < $length2; $i++){
				$n = $i + 2;
				for($j = 0; $j < $length1; $j++){
					$objPHPExcel->setActiveSheetIndex(0)->setCellValue($Letter[$j].$n,$dataArr[$i][$attrArr[$j]]);
				}
			}
			$objPHPExcel->getActiveSheet()->setTitle($title);
			$objPHPExcel->setActiveSheetIndex(0);
			spl_autoload_register(array('Think','autoload'));
			header('Content-Type: application/vnd.ms-excel');
			header('Content-Disposition: attachment;filename="'.$fileName.'"');
			header('Cache-Control: max-age=0');
			$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel,'Excel5');
			$objWriter->save('php://output');
			exit;
		}

		/**
		*根据具体的数据库表将上传的文件导入到数据库表中
		*@param String $file 上传到服务器之后的文件路径
		*@param String $table 需要导入的数据库表
		*
		*/
		public function importExcel($file,$table){
			vendor('PHPExcel.PHPExcel');
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$sheet = $objPHPExcel->getSheet(0);
			$arrExcel = $sheet->toArray();
			$rows = $sheet->getHighestRow();	//取得总行数
			$cols = $sheet->getHighestColumn();	//取得总列数
			array_shift($arrExcel);	//删除第一行

			//查询数据库的字段
			$m = M($table);
			$fieldarr = $m->getDbFields();
			array_shift($fieldarr);	//删除自增的ID
			//循环给数据字段赋值
			foreach ($arrExcel as $v) {
				$fields[] = array_combine($fieldarr, $v);	//将excel的一行数据赋值给表的字段
			}
			$isSuccess = $m->addAll($fields);
			if(!$isSuccess){
				Log::write($table."导入数据失败",ERR);
				return false;
			}else{
				Log::write($table."导入数据成功",INFO);
				return true;
			}
		}
		//返回excel数据的行数、列数以及具体数据(删除第一行)
		public function returnExcelData($file){
			vendor('PHPExcel.PHPExcel');
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$sheet = $objPHPExcel->getSheet(0);
			$arrExcel = $sheet->toArray();
			$rows = $sheet->getHighestRow();	//取得总行数
			$cols = $sheet->getHighestColumn();	//取得总列数
			array_shift($arrExcel);	//删除第一行
			array_shift($arrExcel); //删除第二行
			$data = array();
			$data[0]["rows"] = $rows-2;	//已删除一行
			$data[1]["cols"] = $cols;
			$data[2]["data"] = $arrExcel;
			return $data;
		}
		
		//返回excel数据的行数、列数以及具体数据
		public function returnData($file){
			vendor('PHPExcel.PHPExcel');
			$objPHPExcel = PHPExcel_IOFactory::load($file);
			$sheet = $objPHPExcel->getSheet(0);
			$arrExcel = $sheet->toArray();
			$rows = $sheet->getHighestRow();	//取得总行数
			$cols = $sheet->getHighestColumn();	//取得总列数
			
			$data = array();
			$data[0]["rows"] = $rows;
			$data[1]["cols"] = $cols;
			$data[2]["data"] = $arrExcel;
			return $data;
		}
	}

?>