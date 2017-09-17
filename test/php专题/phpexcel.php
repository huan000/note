<?php
/**
 * Created by PhpStorm.
 * User: huan
 * Date: 2017/9/8
 * Time: 20:02
 */

require "./PHPExcel.php";

// 创建excel 并且默认生成一个sheet
$objPHPExcel = new PHPExcel();
// 获取模板数据
require "PHPExcel/IOFactory.php";
$objPHPExcel = PHPExcel_IOFactory::load('salesorder1.3.xls');   //加载文件
//$sheetCount = $objPHPExcel->getSheetCount();                  //获得sheet数量
$data = $objPHPExcel->getSheet(0)->toArray();        //读取数据
// 获得当前的sheet活动对象
$objSheet = $objPHPExcel->getActiveSheet();
// 设置sheet标题
$objSheet->setTitle('海创合同');
// 设置全局默认样式 文字居中
//$objSheet->getDefaultStyle()->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER)->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
// 导入数据
$objSheet->fromArray($data);
// 插入图片
$objDrawing = new PHPExcel_Worksheet_Drawing();       //获得一个图片操作对象
$objDrawing->setPath('exhead.png');                     //本地图片的地址
$objDrawing->setCoordinates('A1');                    //图片的坐标
$objDrawing->setWidth(670);                           //设置图片的大小，高度会自动缩放
$objDrawing->setOffsetX(0);                           //单元格内偏移量
$objDrawing->setWorkSheet($objSheet);
$objDrawing = new PHPExcel_Worksheet_Drawing();       //获得一个图片操作对象
$objDrawing->setPath('exfoot.png');                     //本地图片的地址
$objDrawing->setCoordinates('A39');                    //图片的坐标
$objDrawing->setWidth(670);                           //设置图片的大小，高度会自动缩放
$objDrawing->setOffsetY(22);                           //单元格内偏移量
$objDrawing->setWorkSheet($objSheet);
// 添加具有样式的文字块
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
//$objRichText->createText('三、');
$objStyleFont = $objRichText->createTextRun('三、交（提）地点和方式：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('优速快递发货至用户所在地。');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A23")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('四、质量要求技术标准、供方对质量负责的条件和期限：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun(' 产品自交货之日起仪表部分保修三年；机械部分保修一年（一年内，非人为损坏，免费维修；保修期外，只收取工本费及邮寄费用）。 ');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A25")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('五、包装标准、包装物的供应与回收：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('包装标准为所购产品的原包装，包装物由需方妥善保存。');
$objStyleFont1->getFont(s)->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A26")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('六、验收标准、方法及提出异议的期限：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('设备规格型号、数量符合合同要求，根据相关行业标准验收。');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A27")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('七、违约责任：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('任何一方违约，将依据《中华人民共和国合同法》及相关法律追究其违约责任。');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A28")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('八、解决合同纠纷的方式：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('本合同在履行过程中发生争议，由当事人双方协商解决。协商不成，由合同签订地点司法部门申诉解决。');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A29")->setValue($objRichText);
$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
$objStyleFont = $objRichText->createTextRun('九、其它约定事项：');
$objStyleFont->getFont()->setBold(true)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objStyleFont1 = $objRichText->createTextRun('本合同一式贰份，供方、需方各持壹份，本合同经双方签字、盖章后即生效（传真件有效）。');
$objStyleFont1->getFont()->setBold(false)->setSize(8.5)->setName("微软雅黑")->setUnderline(false);
$objSheet->getCell("A30")->setValue($objRichText);








// 设置指定字体样式
//$objSheet->getStyle("A1:B1")->getFont()->setName("微软雅黑")->setSize(20)->setBold(true);

// 设置指定的背景颜色  完全填充-> 填充颜色
//$objSheet->getStyle("A1:B1")->getFill()->setFillType(PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setRGB("#ff0033");

// 设置指定边框
//$border = getBorderStyle();
//$objSheet->getStyle('A3:B3')->applyFromArray($border);
//
//function getBorderStyle(){
//    $styleArray = array(
//        'borders'=>array(
//            'outline'=>array(
//                'style'=>PHPExcel_Style_Border::BORDER_THIN,
//                'color'=> array('rgb'=>'#f30547')
//            )
//        )
//    );
//    return $styleArray;
//}

// 设置单元格宽度
//$objSheet->getColumnDimension('A')->setWidth(12);
// 设置单元格高度
//$objSheet->getRowDimension(2)->setRowHeight(32);

// 设置自动换行 (一定要写在添加数据之前)
//$objSheet->getStyle('A1')->getAlignment()->setWrapText(false);

// 是定数据类型
//$objSheet->getStyle('F1')->getNumberFormat()->setFormatCode(PHPExcel_Style_NumberFormat::FORMAT_NUMBER_COMMA_SEPARATED1);


// 设置sheet的标题
//$objSheet->setTitle('testsheet');



// 填充数据 方式1
//$objSheet->setCellValue("A1","张四")->setCellValue("B1","分数");
//$objSheet->getStyle('D1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_FILL);

// 填充数据 方式2
//$array = array(
//    array('','一班','二班','三班'),
//    array('不及格','20','30','40'),
//    array('良好',300,50,55),
//    array('优秀',15,17,20),
//);
//$objSheet->fromArray($array);

// 填充数据指定类型 不显示科学记数法
//$objSheet->setCellValueExplicit('B8','23423423534653463145342134321543',PHPExcel_cell_Datatype::TYPE_STRING);




// 样式控制:合并单元格
//$objSheet->mergeCells("A2:F2");
//$objSheet->setCellValue('A2','合并数据');


// 插入图片
//$objDrawing = new PHPExcel_Worksheet_Drawing();       //获得一个图片操作对象
//$objDrawing->setPath('head.jpg');                     //本地图片的地址
//$objDrawing->setCoordinates('G1');                    //图片的坐标
//$objDrawing->setWidth(200);                           //设置图片的大小，高度会自动缩放
//$objDrawing->setOffsetX(0);                           //单元格内偏移量
//$objDrawing->setWorkSheet($objSheet);


// 添加具有样式的文字块
//$objRichText = new PHPExcel_RichText();                //获得一个文字块对象
//$objRichText->createText('普通文字');
//$objStyleFont = $objRichText->createTextRun('具有样式的文字块');
//$objStyleFont->getFont()->setSize(16)->setBold(true)->setUnderline(true)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
//$objRichText->createText('normal');
//$objSheet->getCell("L3")->setValue($objRichText);

// 添加批注 (只有excel2007 有效果)
//$objSheet->getComment('L3')->getText()->createTextRun('这是一个批注');


// 添加超链接
//$objSheet->getStyle('B8')->getFont()->setUnderline(true)->setColor(new PHPExcel_Style_Color(PHPExcel_Style_Color::COLOR_RED));
//$objSheet->getCell('L3')->getHyperlink()->setUrl('http://www.baidu.com');


// 生成线性图
// 取得绘制图表的标签
//$label = array(
//    new PHPExcel_Chart_DataSeriesValue('String','Worksheet!$B$1',null,1),
//    new PHPExcel_Chart_DataSeriesValue('String','Worksheet!$C$1',null,1),
//    new PHPExcel_Chart_DataSeriesValue('String','Worksheet!$D$1',null,1),
//);
//
//// 取得x的坐标轴
//$xlabel = array(
//    new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$A$2:$A$4',null,3),
//);
//
//// 取得所有数据
//$datas = array(
//    new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$B$2:$B$4',null,3),
//    new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$C$2:$C$4',null,3),
//    new PHPExcel_Chart_DataSeriesValues('String','Worksheet!$D$2:$D$4',null,3),
//);


//  读取数据  方式1
//require "PHPExcel/IOFactory.php";
//$objPHPExcel = PHPExcel_IOFactory::load('demo2.xlsx');   //加载文件
//$sheetCount = $objPHPExcel->getSheetCount();                  //获得sheet数量
//for($i=0; $i<$sheetCount; $i++){
//   $data = $objPHPExcel->getSheet($i)->toArray();        //读取数据
//}

//  读取数据方式 2
//foreach($objPHPExcel->getWorksheetIterator() as $sheet){
//      foreach($sheet->getRowIterator() as $row){
//         foreach($row->getCellIterator() as $cell){
//              $data = $cell->getValue();
//         }
//      }
//}

//  部分sheet加载方式
//$filename = 'demo2.xlsx';
//$fileType = PHPExcel_IOFactory::identify($filename);   // 获取文件类型
//$objReader = PHPExcel_IOFactory::createReader($fileType);  //获得操作对象
//$objReader->setLoadSheetsOnly('testsheet');             // 指定获取sheet
//$objPHPExcel = $objReader->load($filename);                          // 加载文件
 


// 保存到本地服 务器
$objwriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel5");
$objwriter->save("demo2.xls");

// 保存到浏览器客户端
//$objwriter = PHPExcel_IOFactory::createWriter($objPHPExcel,"Excel2007");
//// header('Content-Type:application/vnd.ms-excel');    // excel5 xls
// header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'); // excel07 xlsx
// header('Content-Disposition:attachment;filename="test.xls"');  // 输出文件的名称
// header('Cache-Control:max-age=0');     // 禁止缓存
//$objwriter->save("php://output");

