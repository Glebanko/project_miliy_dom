<?php
/*Запускаем сессию*/
session_start();
/*Подключаем библиотеки*/
require_once 'db_dom.php';
require_once 'fun.dom.php';
//require "eshop_db.inc.php";
//require "eshop_lib.inc.php";
?>

<a class="imHidden" href="#imGoToCont" title="Пропустить главное меню">Перейти к содержимому</a>
			<a id="imGoToMenu"></a><p class="imHidden">Главное меню</p>
			<div id="imMnMn" class="auto">
				<ul class="auto"><?php $sql = "SELECT * FROM `category`  ORDER BY `category`.`id` ASC ";
$r = mysql_query($sql);
$len = mysql_num_rows($r);
while ( $ar=mysql_fetch_array($r) ) {

			if($ar['title']=="Главная"){
				echo'<li id="imMnMnNode0" >';
				}else if($ar['title']=="Распродажа"){
				echo'<li id="imMnMnNode22"  >';
				}else if($ar['title']=="Постельное белье"){
				echo'<li id="imMnMnNode6" >'; //eto vibrannoe menu
				}else if($ar['title']=="Полотенца"){
				echo'<li id="imMnMnNode11" >';
				}else if($ar['title']=="Разное"){
				echo'<li id="imMnMnNode15" >';
				}else if($ar['title']=="Женская одежда"){
				echo'<li id="imMnMnNode19" >';
				}else if($ar['title']=="Мужская одежда"){
				echo'<li id="imMnMnNode29" >';
				}else if($ar['title']=="Доставка и оплата"){
				echo'<li id="imMnMnNode20" >';
				}else if($ar['title']=="Контакты"){
				echo'<li id="imMnMnNode21" >';
				}
			
								echo '<a href="'.$ar['url'].'">
									<span class="imMnMnFirstBg">
										<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar['tit'].'</span>
									</span>
								</a>
								<ul class="auto">';
									if($ar['title']=="Распродажа"){
										$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='2' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
											}
										}else if($ar['title']=="Постельное белье"){
										$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='3' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
										}
									}else if($ar['title']=="Полотенца"){
									$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='4' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len1 = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
										}
									}else if($ar['title']=="Разное"){
									$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='5' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len1 = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
										}
									}else if($ar['title']=="Мужская одежда"){
									$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='7' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len1 = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
										}
									}else if($ar['title']=="Женская одежда"){
									$sql1 = "SELECT * FROM `kat`  where `kat`.`id_category`='6' ORDER BY `kat`.`id_k` ASC ";
										$r1 = mysql_query($sql1);
										$len1 = mysql_num_rows($r1);
										
										while ( $ar1=mysql_fetch_array($r1) ) {
										echo '<li id="imMnMnNode3" class="imMnMnFirst">
												<a href="menu.php?id='.$ar1['0'].'">
													<span class="imMnMnBorder">
													<span class="imMnMnTxt"><span class="imMnMnImg"></span>'.$ar1['tit'].'</span>
													</span>
												</a>
											</li>';
										}
									}
								echo '</ul>
							</li>';
}?>