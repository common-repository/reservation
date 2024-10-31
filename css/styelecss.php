<?php
//header("Content-type: text/css");

?>
<style>
@import url("https://use.fontawesome.com/releases/v5.8.1/css/all.css")
html{font-size:14!important;}
.wrap {
    max-width: 1355px!important;
}

.xdsoft_datepicker.active {
    min-width: 222px!important;
}
.navotar {font-family:arial!important;font-size:14px;margin:20px 0px;max-width: 1155px;width: 100%;margin: 0 auto;}
.navotar button, input, select, optgroup, textarea {
    color: #111;
    font-family: arial!important;
}
#country, #state, #cviheletype, #locationplan,
#droplocationplan{
 background-color: #fff;
}

input[type="text"], input[type="email"], input[type="url"], input[type="password"], input[type="search"], input[type="number"], input[type="tel"], input[type="range"], input[type="date"], input[type="month"], input[type="week"], input[type="time"], input[type="datetime"], input[type="datetime-local"], input[type="color"], textarea {
	display: initial!important;
}

#bsetio{cursor: no-drop;}
.navotarlink{color:<?php if(!empty(get_option('form_link_color') )){echo esc_attr(get_option('form_link_color')); }else{ echo"#333333";} ?>!important;}
.tfield{margin:0px auto;width: 96%;}
.t_text_fields{width: 100%;height: 35px;border: 1px solid #E4E4E4;font-size: 14px;font-family: arial;border-radius: 0px;}
.quantity{display:none;}
.err{color:red;font-size:11px;padding-left:15px;}
.falsemsg{width:100%;height:100px;margin:50px auto;color:red;text-align: center;}
.navotar .col-md-5{width:500px;}
.navotar .col-md-6{width:50%;float:left;padding-left: 15px;}
.navotar  .res_block{width:<?php if(!empty(get_option('searchWidth') )){echo esc_attr(get_option('searchWidth')); }else{ echo"700";} ?>px;height:<?php if(!empty(get_option('searchHeight') )){echo esc_attr(get_option('searchHeight')).'px'; }else{ echo"auto";}?>;
background:<?php if(!empty(get_option('box_form_background'))){echo esc_attr(get_option('box_form_background'));}else{ echo "#CECEE8";}?>;font-size: 14px;font-family: arial;float:left;}
// .navotar  .tblk{min-height:80px;}
.navotar .tblk {min-height: 80px;width: 98%; margin: 0 auto;}
.navotar  .title_blk{width:50%;float:left;}
.navotar .title_blk p {font-weight: normal;font-style: arial;color: <?php echo esc_attr( get_option('mv_cr_section_color',"#0D5632") ); ?>;}
.navotar .res_fields2{margin-top:2px;}
.navotar .res_fields2 label{width:100%;font-weight: bold; color:<?php echo esc_attr( get_option('mv_cr_section_color',"#0D5632") ); ?>;font-size: <?php echo esc_attr( get_option('box_form_font_size',"14") ); ?>px;}
.navotar .textfields {width:94% !important;height: 35px;border: 1px solid #E4E4E4;font-size:14px;font-family: arial;border-radius: 0px;}
.navotar .res_fields,.res_fields2 {float: left;width: 100%;}
.navotar .res_fields label{width:100%;font-weight: bold;color:<?php echo esc_attr( get_option('mv_cr_section_color',"#0D5632") ); ?>;font-size: <?php echo esc_attr( get_option('box_form_font_size',"14")); ?>px;}
.navotar .title_icon {background: <?php echo esc_attr( get_option('box_title_background','#2D00C4') ); ?>;height: 40px;width: 100%; padding: 7px 0 0 15px;color: <?php echo esc_attr( get_option('form_heading_color') ); ?>;font-size: <?php echo esc_attr( get_option('box_form_heading_size','16') ); ?>px;font-weight: bold;float:left;margin-bottom: 5px; border-right: 0px solid transparent;}
.navotar .dropof{font-size:<?php echo esc_attr( get_option('box_form_font_size',"14") ); ?>px;color:<?php echo esc_attr( get_option('mv_cr_section_color',"#0D5632") ); ?>}
#chk{margin-left:0px;}
.navotar .vtype {margin-right: 0px;width: 50%;text-align: left;margin-top: 15px; float: right;}
#cviheletype {width: 100% !important;}
 .vtype {  width: 25% !important;float: right;margin-top: 15px;}
.navotar .vtype label{width:100%; font-weight: bold; color:<?php echo esc_attr( get_option('mv_cr_section_color',"#0D5632") ); ?>; float: left;font-size: <?php echo esc_attr( get_option('box_form_font_size','14') ); ?>px;}
.navotar select {height: 33px; padding:0; border: 1px solid #E4E4E4;font-size: <?php echo esc_attr( get_option('box_form_font_size','14') ); ?>px;font-family: arial;}
.navotar .title_blk p {margin-bottom: 0; margin-left: 15px;font-size: <?php echo esc_attr( get_option('box_form_font_size','14') ); ?>px;}
.navotar .search{background:#00AEEF;border-radius:0px;border:1px solid #00AEEF;}
.navotar .save {text-align: right;margin-top: 26px;}
.navotar .monu{text-align:center;}
.navotar .ftr{width:100%;}
.navotar .ftr { width: 100%; margin-top: 10px;float: left;}
.navotar .input-group-addon { position: absolute; margin-left: -20px;margin-top: 4px;}

.navotar .btn {display: inline-block;padding: 7px 13px;font-size: 14px;font-weight: normal;line-height: 1.42857143;border: 1px solid transparent;background: <?php echo esc_attr( get_option('box_button_background','#3D19AA') ); ?>;margin: 22px;color: #ffffff;margin-right: 22px !important;border-radius: 0px;text-transform: none;font-family:arial;}
.navotar .btn:focus{outline: thin dotted;color: #ffffff !important;}
#boxsearch{float:left;}
.navotar .checkbox{color: #383737;}

.navotar .navo-footer{width:100%;text-align:center;float:left;background:<?php if(!empty(get_option('box_form_background'))){echo esc_attr(get_option('box_form_background'));}else{ echo "#CECEE8";}?>;}

.navotar a:focus{color: #fff;text-decoration: underline;}
.navotar a:hover{color: #fff;text-decoration: underline;}
.navotar .input-group-addon span {font-size: 16px;padding-top: 7px;}
.navotar translate span {font-size: 14px;}
.bags {
    width: 23%;
    float: left;
    font-size: 12px;
    text-align: center;
}

.paylater2 {
    width: 100%;
    float: left;
    display: flex;
}
.vehicleType_1 {
    width: 20%;
    text-align: center;
}
.seats_1 {
    width: 25%;
    text-align: center;
}
.baggages_1 {
    width: 25%;
    text-align: center;
}
.doors_1 {
    width: 17%;
    text-align: center;
}

.errormsg {
    font-size: 10px;
    color: red;
}






.navotar .main { float:left;width:100%;margin-top:7px;border-top: solid;}
.navotar .main1 {float:left;width:49%;margin-top: 4px;margin-bottom: 10px;margin-left:7px;padding:0px;text-align:right;}
.navotar .right { background-color:#F3F3F3;float:left; width:20%;margin-top:7px;border:1px solid #DDDDDD}
.navotar .right1 { float:left;width:50%;margin-top:7px;}
.navotar div#header{background-color:<?php if(!empty(get_option('list_background_color'))){ echo get_option('list_background_color');}else{echo'#ff0000'; } ?>;text-align:center;height:50px;}
.navotar div#headernext{background-color:<?php if(!empty(get_option('list_header_color'))){ echo get_option('list_header_color');}else{echo'#eeeeee';} ?>;width: 100%;padding-bottom: 9px;overflow: auto;}
.navotar #scddiv { max-width: 1155px;width: 100%;margin: 0px auto;height:40px;text-align:center;padding:20px 0px;}
.navotar .navigate{max-width: 1155px;width: 100%;margin: 12px auto;min-height: 28px;}
.navotar .mainblock{max-width: 1155px;width: 100%;margin: 0px auto;overflow: hidden;}


.navotar .main section{margin: 7px 0px;background-color:<?php if(!empty(get_option('list_background_color'))){ echo get_option('list_background_color');}else{echo'#e9e9e9'; } ?>;overflow: auto;padding: 5px 5px 0px 5px;width: 100%;}


.navotar div.smallheader{width:20%;float:left;font-size: <?php echo esc_attr( get_option('list_heading_size') ); ?>px;font-weight: bold;color:<?php echo esc_attr( get_option('list_heading_size') ); ?>px;}
.navotar div.arrowicon{width:5%;float:left;}
.navotar #carleft{width:85%;float:left;}
.navotar div#carright{width:15%;float:right;}
.navotar span{ font-size: 14px;}
.navotar strong {font-size: <?php echo esc_attr( get_option('list_heading_size') ); ?>px;}
.navotar span#sup{width:50%;float:right;margin-top: -9px;}
.navotar .dsn {font-size: 10px;float: right;margin-top: 5px;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;}
.navotar h4#ftsize { font-size: 13px;}
.navotar .image{width:40%;float: left;}
.navotar .image img{width:100%;}
.navotar .desc {width: 60%;  float: left;}
.navotar #tblstl{font-size:10px;width:100%;position:relative;margin-left: -57px;}
.navotar td#tdstl { font-size: 18px;}
.navotar div#pyltr { border-bottom: groove;font-size: 10px;font-size: 14px;font-weight: bold;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;}
.navotar button.btndsg {background-color: <?php echo esc_attr( get_option('list_btn_color') ); ?>; height: 40px;  border-width: 0px; width:100%;color: white;border-radius: 0px;padding-top: 10px;}
.navotar div#cad {padding: 1px 0px;float: left;font-size:17px; min-height:39px;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;width: 100%;}
.navotar .pull-right.payltr {position: relative;margin: -124px 0px 0px 0px;}

.navotar div#divleft{float:left;padding-left: 10px;padding-bottom:5px;width: 100%;font-size:<?php echo esc_attr( get_option('list_heading_size','14') ); ?>px;color:<?php echo esc_attr( get_option('list_heading_color') ); ?>;}

.navotar span#spandesign{width:100%;float:left;color:<?php echo esc_attr( get_option('list_subheading_color') ); ?>;font-size:<?php echo esc_attr( get_option('list_sub_title_size') ); ?>px;}
.navotar div#vehiclepart1 { position: relative;float: left; width: 55%; padding-top: 14px;line-height: 23px;padding-left: 17px;}
.navotar .stl { float: right;margin-right: 227px;float:left;width:60%; margin-left:253px;margin-top:7px;border-bottom: groove;padding:0 20px;}
.navotar .perday{width: 100%;float: left;font-size: 13px !important;}
.blkone {width: 50%; float: left;padding: 10px 0px;}
.navotar div#tbltype{float:left;width:50%;position: relative;font-size:12px;font-weight: bold;}
.navotar .maindpl {float:left;width:100%;background-color:#fbfbfb;; margin: 4px 0px;line-height: 27px;padding-left: 10px;border: 1px solid #e2e2e2;display: none;}
.navotar div#tbltype1 {float: left; width: 100%;font-size: 13px;line-height: 20px; padding-bottom: 10px;}

.navotar div#divleftnext {float: left; padding-left: 10px;padding-bottom: 5px;font-size: <?php echo esc_attr( get_option('list_sub_title_size','15' )); ?>px;line-height: 18px;width: 100%;color:<?php if( !empty( get_option('list_font_color')) ){ echo get_option('list_font_color');}else{echo'#333';} ?>;}

.iconspec ul li{font-size: <?php echo esc_attr( get_option('list_sub_title_size','15' )); ?>px !important;}
.icontext{font-size: <?php echo esc_attr( get_option('list_sub_title_size','15' )); ?>px !important;}
.pric{font-size: <?php echo esc_attr( get_option('list_sub_title_size','15' )); ?>px!important;}

.navotar .iconspec {
    width: 98%;
    float: left;
    margin: 10px;
}
.navotar .iconspec ul{width:100%;margin:0px;padding:0px;}
.navotar .iconspec ul li{list-style:none;display:block;width:26%;float:left;font-size: 12px;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;}
.navotar div#divleftnext a {font-size: 12px;font-weight:bold;text-decoration:none;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;}
.navotar div#divleftnext a {font-size: 12px;font-weight:bold;text-decoration:none;color:<?php echo esc_attr( get_option('list_font_color') ); ?>;}
.sidetop { border-bottom: 1px solid #C4C4C4; padding: 10px;color: #7D7D7D;}
.filterone { padding: 10px;border-bottom: 1px solid #ddd;color:<?php echo esc_attr( get_option('list_font_color') ); ?>; font-size: 14px;}
.navotar [type="checkbox"], [type="radio"] { margin: 0px 6px 0 0;}
.centwe{text-align:right;}
.navotar .feature{width:60%;float:left;}
.navotar .spec{width:40%;float:left;}
.navotar .grid_main .Carinfo:nth-child(3n) {
    margin-right: 0px !important;
}

<!-- grid view-->
.grid_main { border-top: 3px solid #6D6D6D;}
.navotar .grid_main{max-width: 1155px;width: 100%;border-top:3px solid #6D6D6D;}
.navotar .grid_main .Carinfo { width: 31%;float: left;margin:15px 40px 0 0px !important;padding: 15px;border: 1px solid #e2e2e2; background:<?php echo esc_attr( get_option('list_background_color','#e9e9e9') );?>;}
.navotar .grid_main .carname {width: 70%;float: left;}
.navotar .grid_main .details {width: 20%;float: right;text-align: right;color: red;padding-right: 3px;cursor: pointer;
text-decoration: underline;}
.Carinfo:nth-child(3n) {margin-right: 0px !important;margin-left: 0px;}

.navotar .grid_main .image {width: 60%;padding: 3px;float: right;height: 132px; margin-bottom: 10px;}
.navotar .grid_main img {width: 100%;}
.navotar div#nissan {font-size: <?php echo esc_attr( get_option('list_normal_size','14') ); ?>px; width:100%;line-height: 25px;color:<?php echo esc_attr( get_option('list_subheading_color','#333333') ); ?>;}
.navotar div#nissan span {font-size: <?php echo esc_attr( get_option('list_heading_size','18') ); ?>px; color:<?php echo esc_attr( get_option('list_heading_color','#ff0000') ); ?>;}
.navotar div#tiida {font-size: <?php echo esc_attr( get_option('list_heading_size','18') ); ?>px;width:100%;line-height: 25px;}
.navotar div#tiida span {font-size: <?php echo esc_attr( get_option('list_heading_size','18') ); ?>px;color:#ff0000; }
.navotar div#automatic {font-size: <?php echo esc_attr(get_option('list_normal_size','14' ) ); ?>px;width:100%;line-height: 25px;color:<?php echo esc_attr( get_option('list_subheading_color','#333333') ); ?>;}
.navotar div#automatic span{font-size: <?php echo esc_attr( get_option('list_heading_size','18') ); ?>px;color:<?php echo esc_attr( get_option('list_heading_color','#ff0000') ); ?>;}
.navotar .grid_main .paylater {position: relative;width: 100%;border-top: groove;float: left;padding-top: 12px;}
.navotar .grid_main .perday {width: 50%;float: left;height: 60px;}
.navotar .grid_main .total {width: 50%;float: left;height: 60px;}
.navotar .grid_main #btn {background-color: red;border-radius: 15px;width: 100%;height: 30px;border-width: 1px;color: white;border-color: red;outline:none;   }
.navotar .grid_main button#btn1 {background: <?php if(!empty(get_option('list_header_color'))){ echo esc_attr(get_option('list_header_color'));}else{echo'#f2f2f2'; } ?>;
	color:<?php if(!empty(get_option('list_font_color'))){ echo esc_attr(get_option('list_font_color'));}else{echo'#333333'; } ?>;border-radius: 15px;width: 100%;height: 30px;padding-top:8px;outline:none;   }
.navotar .grid_main button#btn1:hover{background-color:<?php echo esc_attr( get_option('list_btn_color'),"#4447ED" ); ?>;}
.navotar .grid_main button.btn2 {background-color:<?php echo esc_attr( get_option('list_btn_color'),"#4447ED" ); ?>;width: 100%;height: 30px;margin-top: 12px;color: white;padding-top: 6px;border:1px solid <?php echo esc_attr( get_option('list_btn_color'),"#4447ED" ); ?>;outline:none;font-size: <?php echo esc_attr( get_option('list_normal_size')."14" ); ?>px;   }
.navotar .grid_main .txt {text-align: center;padding: 5px;color:<?php echo esc_attr( get_option('list_subheading_color'),"#4447ED" ); ?>;}
.mybtnc {float: left;width: 100%;height: 67px;}
.navotar .main_grid section {margin: 7px 0px; background-color: #fbfbfb;overflow: auto;width: 100%;}
.navotar .grid_main .Carinfo.last {margin-right: 0px;}




.navotar #headdiv {max-width: 1155px;width: 100%;margin: 12px auto;overflow: initial;}
.navotar .addextras {width: 50%;float: left;    font-weight: bold;}
.navotar button#setbtn {float: right;background-color: green;border: 0px;height: 26px;width: 150px;font-size: 10px;color: white;margin-right: 59px;}
.navotar button#setbtnlast {float: right;background-color: green;border: 0px;height: 26px;width: 150px;font-size: 10px;color: white;margin: 13px 204px 0px 0px;}
.navotar div#equipment {padding: 52px 0px 12px 1px;text-align: center;font-weight: bold;width: 1012px;margin-left: 163px;font-size: 20px;border-bottom: 1px groove black;}
.navotar div#equidetail {width: 1000px;margin-left: 163px;padding: 9px 0px 1px 14px;border-bottom: 2px groove #f8f1f1;height: 33px;}
.navotar .cadinfo {width: 35%;float: left;height: 25px;}
.navotar div .cadinfo a {color: green;font-size: 13px;}
.navotar div .cadinfoadd a {color: green;font-size: 13px;text-decoration: none;}
.navotar .cadinfoadd {width: 14%;float: left;height: 25px;text-align: right;padding-right: 0px;}




.navotar .locdetail {width: 307px;height: 330px;margin-top: 33px;padding: 15px;border: 1px groove white;}
.navotar div#locmin {height:42px;border-bottom:1px groove #d9d3d3;margin: 0px ;font-size:13px;padding: 4px 0px 40px 9px;}
.navotar div#locmin1 {height: 40px;margin-top: 0px 0px 0px 14px;font-size: 13px;padding: 7px 0px 0px 9px;}
.navotar div#rloc {font-weight: bold;}
.navotar div#Itinerary {font-weight: bold;font-size: 19px;width: 80%;float: left;}
.navotar div#dtl {width: 18%;float: left;text-align: right;color: blue;}
.navotar div#rloc1 {font-weight: bold;width: 80%;float: left;}
.navotar div#locmindiv {height: 42px;border-bottom: 1px groove #d9d3d3;margin-top: 0px 0px 0px 14px;font-size: 13px;padding: 7px 0px 0px 9px;background-color: #ece8e8;}
.navotar .modifydet1 {width: 100%;height: 25px;}
.navotar .modifydet2 {width: 94%;height: 120px;margin-left: 13px;}
.navotar div#leftdivfirst {width: 20%;float: left;padding: 9px;margin: 19px;border-bottom: 1px groove #fff8f8;}
.navotar div#leftdivsec {width: 10%;float: left;padding: 9px;margin: 19px;border-bottom: 1px groove #fff8f8;}
.navotar div#leftdivmid1 {width: 25%;float: left;padding: 0px 0px 0px 19px;}
.navotar div#leftdivmid2 {width: 25%;float: left;padding: 0px 0px 0px 19px;border-left: 1px groove #fff8f8;}
.navotar div#ftclr {color: #fb042f;}
.navotar div#ftsize {font-size: 12px;padding: 4px 0px 0px 0px;}.navotar div#timesz {font-size: 15px;}.navotar .linewithtext {width: 100%;margin-left: 11px;}.navotar hr#lineset {width: 79%;float: left;margin-left: 12px;}
.navotar div#linetext {float: left;color: #e85151;margin-left: 13px;width: 18%;}.navotar div#boxdiv {padding-bottom: 25px;float: left;max-width:<?php echo esc_attr( get_option('rectsearchWidth'),"700" ); ?>px;width: 100%;min-height:<?php echo esc_attr( get_option('rectsearchHeight'),"286" ); ?>px;background-color:<?php echo esc_attr( get_option('rec_form_background'),"#eaeaf1" ); ?>;border: 1px groove white;}
.navotar div#carrent {color: <?php echo esc_attr( get_option('rec_form_heading_color'),'#ff0000' ); ?>;padding-left: 5px;padding: 6px 1px 0px 15px;font-weight: bold;font-size:<?php echo esc_attr( get_option('rec_form_heading_size'),'15' ); ?>px; background:<?php if(get_option('rec_title_background')){ echo get_option('rec_title_background');}else{ echo "#ff0000";} ?>}
.navotar div#location {font-size: <?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;padding: 8px;font-weight: bold;margin-left: 10px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.navotar input#inputset {border-radius: 4px;width: 96%;margin: 0px 6px 0px 14px;float: left;padding: 7px 17px 8px 10px;border: 1px groove white;border-bottom: 2px groove red;height: 35px;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.navotar div#dropdwnset {padding: 6px;font-size: <?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;margin-left: 6px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.navotar .inputboxset {width: 100%;height: auto;float: left;}
.navotar div#divset {
    width: 25%;
    float: left;
    padding: 6px 30px 0 2px;
}
.navotar input.setinput {padding: 3px;margin: 12px;width: 100%;height:35px;font-family:arial;border: 1px solid #e7e7e7;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.navotar select#setinputbig {padding: 0px;margin: 12px;width: 100px;height:35px;border:  1px solid #e7e7e7;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;background: #fbfbfb;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}

.navotar .setinputbig {padding: 0px;margin: 12px;width: 100px;height:35px;border:  1px solid #e7e7e7;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;background: #fbfbfb;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}

.navotar div#labelset {padding: 0px 0px 0px 12px;font-size: <?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;font-weight:bold;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.navotar i.fa.fa-arrow-right.icon {padding: 15px 0px 0px 29px;}.navotar div#srcbar {height: 62px;width: 100%;float: left;}
.navotar div#inputscr {width: 100%;float: left;margin: -5px 0 0 14px;}
#srcbar button.btn.btn-primary.srcbtn {width: 17%;height: 35px; margin: 35px 0 3px 81px!important;color: #ffffff;background-color: <?php echo esc_attr( get_option('rec_button_background'),"#ff0000" ); ?>;}
.navotar button.btn.btn-primary.srcbtn {width: 85%;height: 35px; margin: 45px 0 3px 0px;color: #ffffff;background-color: <?php echo esc_attr( get_option('rec_button_background'),"#ff0000" ); ?>;}
#srcbar .txtboxy {height: 35px;width: 65%!important;font-family:arial;margin: 2px 1px 3px 8px;border: 1px groove #f9f2f2;padding: 1px 1px 1px 7px;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
#inputscr .txtboxy {height: 35px;width: 70%;font-family:arial;margin: 2px 1px 3px 8px;border: 1px groove #f9f2f2;padding: 1px 1px 1px 7px;font-size:<?php echo esc_attr( get_option('rec_form_font_size'),'14' ); ?>px;color:<?php echo esc_attr( get_option('rec_section_color'),"#333333" ); ?>;}
.blockhide{display:none;}.blockhide2{display:none;float: left;width: 100%;}.navotar #menudiv {border: 1px groove #d8d5d5;height: 40px;border-radius:0px;padding: 8px 1px 5px 13px;font-weight: bold;}
.navotar .linkset {color: black;text-decoration: none;padding: 3px;font-size: 13px;}.navotar .tbldiv {width: 100%;float: left;border: 1px groove #f1efef;margin: 18px 1px 1px 1px;padding: 12px 1px 10px 12px;}
.navotar .settingdiv {width:100%;padding: 20px;float:left;}.navotar .settingdivhide {width: 94%;padding: 20px;background-color: #f3f3f3;float:left;}
.navotar .datasettxt {width: 15%;float: left;}.navotar .dataset {width: 15%;float: left;text-align: right;}.navotar .datasetleft {width: 55%;float: left;font-weight: bold;}
.navotar a#anext {text-decoration: none;color: red;}
.navotar button#bset {width: 57%;height: 41px;background-color: white;border: 1px groove #f1efef;margin: -12px 1px 1px 1px;}
.navotar i.fa.fa-check-circle.icons {color: #dcdcdc;font-size: 18px;}
.navotar button#btns {float: right;margin: 15px 0px 0px 0px;height: 35px;width: 153px;background-color: red;border: 0px;color: white;}
/* Summary Block */
.navotar #menudiv {width: 98%;}i.fa.fa-angle-right.iconset {font-size: 14px;color: black;}
.navotar .linkset {color: black;text-decoration: none;padding: 3px;font-size: 13px;}
.navotar .maincontent {width: 100%;float:left;}
.navotar .leftpart {width: 66%;float: left; }
.navotar .rightpart {width: 32%;float: left;border: 1px groove #fdfafa;margin: 15px 1px 1px 10px;padding: 15px;}
.navotar .rightset {width: 100%;padding: 6px 0px;float: left;}
.navotar .rightsethead {width: 100%;font-weight: bold;font-size: 18px;float: left;}
.rdetail{margin-top: 30px;}
.navotar .rightdiv {width: 50%;float: left;line-height: 29px;}
.navotar .rightsettotal {width: 100%;padding: 6px;font-weight: bold;float: left;border-top: 2px groove #060606;border-bottom: 2px groove #353434;}
.navotar img#imgset {width: 100%;}.navotar .divalign {width: 25%;padding: 14px;float: left;}
.navotar .divalignright {padding: 24px 15px 1px 0px;float: right;line-height: 38px;text-align: center;}
.navotar .divaligncenter {width: 35%;padding: 14px;float: left;}.navotar .detailcar {width: 100%;border: 1px groove #fdfafa;float: left;margin: 14px 1px 1px 4px;}
.navotar div#icondiv {width: 25%;float: left}.navotar div#txtday {font-size: 20px;}.navotar div#txtpay {font-size: 14px;}.navotar button#btnsetting {background-color: red;border: 0px;height: 35px;width: auto;color: white;font-size: 14px;padding:10px;}
.navotar button#btn1setting {background-color: red;border: 0px;height: 35px;width: 150px;color: white;font-size: 14px;    margin: 14px 1px 1px 1px;float: right;}
.navotar div#setcomp {font-size: 19px;font-weight: bold; padding: 5px;color: red;}.navotar div#compset {font-weight: bold;font-size: 15px;padding: 5px;}
.navotar .icon {width: 19px;color: white;text-align: center;padding: 3px;}.navotar div#icontxt { padding: 4px 1px 1px 3px;font-size: 13px;text-align: center;width: 100%;}
.navotar .formdiv {width: 100%;border: 1px groove #fdfafa;float: left;margin: 14px 1px 1px 4px;background: #f2f2f2;}.navotar .contactdiv {font-weight: bold;font-size: 18px;padding: 10px 1px 1px 16px;}
.navotar .formset {width: 100%;float: left;}.navotar .textset {width: 46%; padding: 10px 0px; font-size: 14px; font-weight: bold; float: left; margin-right: 20px; margin-left: 10px;}
.navotar input#inputdiv {width: 100%;height: 40px;margin: 5px;border-radius: 0px;border:1px solid #e3e3e3;}.navotar label#labeldiv {padding: 1px 1px 2px 5px;font-weight: bold;}
.navotar select#inputdiv1 {width: 100%;height: 38px;margin: 1px 1px 1px px;margin: 5px;}.datasets{width: 15%;float: left;text-align: center;}
.icons {border-radius: 50%;color: #fff;width: 21px;height: 21px;}#bset {border: 1px solid #C7C7C7; text-decoration: none; padding: 5px 20px;}
.datasetleft .icons {border-radius: 50%;color: #fff;width: 21px;height: 21px;text-align: center;background: none;}
/* -- quantity box -- */
.navotar .quantity { display:none; }.navotar .quantity .input-text.qty {width: 35px;height: 30px;padding: 0 5px;text-align: center;background-color: transparent;border: 1px solid #cfcfcf;}
.navotar .quantity.buttons_added {text-align: right;position: relative;white-space: nowrap;vertical-align: top;float: left;width: 12%; }
.navotar .quantity.buttons_added input {display: inline-block;margin: 0; vertical-align: top;box-shadow: none;}.navotar .quantity.buttons_added .minus,
.navotar .quantity.buttons_added .plus {border-radius: 0px!important;padding: 7px 10px 8px; height: 30px; background-color: #ffffff;border: 1px solid #cfcfcf;cursor:pointer;}
.navotar .quantity.buttons_added .minus {border-right: 0;color:#333333; }.navotar .quantity.buttons_added .plus {border-left: 0; color:#333333;}
.navotar .quantity.buttons_added .minus:hover,.navotar .quantity.buttons_added .plus:hover {background: #eeeeee; }.navotar .quantity input::-webkit-outer-spin-button,
.navotar .quantity input::-webkit-inner-spin-button {-webkit-appearance: none;-moz-appearance: none;margin: 0; }.navotar .quantity.buttons_added .minus:focus,
.navotar .quantity.buttons_added .plus:focus { outline: none; }.navotar .input-text.qty.text {height: 30px;width: 30px!important;text-align: center; border-radius: 0px;}
#icondiv .icons{border-radius: 50%;color: #fff;width: 25px;height: 25px;background: #333;text-align: center;margin: 0px auto;}
/*term and condition */
.btn2 {background: <?php echo esc_attr( get_option('list_btn_color') ); ?>;width: 100%;padding: 10px 122px;;color: #fff;}.btn1 {float: left;padding: 2px;}.blk101 {width: 27%;float: left;padding: 20px 0px;}
.headingsetting{font-size:15px;float:left;width:15%;padding: 5px;}.section1{width:100%;}.divalignfirst{width:73%;float:left;font-size: 16px;font-weight: bold;}
.headingsetdes {width: 67%;float: left;padding: 5px;text-align: justify;}.tctype {float: left;width: 6%;text-align: center;padding: 5px;	}
.tcversion{float: left;width: 6%;text-align: center;padding: 5px;}.tblheaddiv {width: 100%;float: left;background: #f00;color: #fff;}.headingsettinghide {float: left;width: 6%;font-size: 14px;text-align: center;}
#btndiv {width: 100%;float: left;text-align: center;margin: 15px 0 0 0;}.anext{ color: #f00 !important;}.anext:hover{color: #f00!important;}


.getitnow { width: 40%; float: left; font-size: <?php echo esc_attr( get_option('list_heading_size','12') ); ?>px; font-weight: bold;color:<?php echo esc_attr( get_option('list_heading_color','#525252') ); ?>;}

.getitnowright { width: 100%; float: right; font-size: 16px; font-weight: bold;margin-right: 15px;}


.gtext { text-align: center; padding: 30px 0 0 0px;}
.pric { text-align: center; font-size: 20px;color:<?php if( !empty( get_option('list_font_color')) ){ echo get_option('list_font_color');}else{echo'#333';} ?>;}
.samex {text-align: right; padding: 12px 0px;color:<?php if( !empty( get_option('list_font_color')) ){ echo get_option('list_font_color');}else{echo'#333';} ?>;}
.smal{font-size:12px;padding-bottom: 29px;color:<?php if( !empty( get_option('list_font_color')) ){ echo get_option('list_font_color');}else{echo'#333';} ?>;}
.datasets label {display:inline-block; background:#ccc;margin:0 0 .5em 0;padding: 3px 9px;cursor: pointer;user-select: none;}
.datasets input[type=checkbox] { position: absolute;top: -9999px;left: -9999px;}
.btndsg {text-decoration: none !important;padding: 7px 14px; background: <?php echo esc_attr( get_option('list_btn_color','#ff0000') ); ?>; color: #fff !important; float: right;margin-right: 0px;}


#btnsetting {padding: 8px 20px;background: #f00;color: #fff;text-decoration:none;}
#btn1setting { border-radius: 0px; background: #f00;border: 1px solid #f00; padding: 10px 10px;color: #fff;font-size: 14px;float: right;margin: 20px 30px;}
#btns {float: right;margin:10px 64px 0px 0px; background: #f00;border: 1px solid #f00; color: #fff;border-radius: 0px; padding: 11px 15px;}
.summary td,.summary th{text-align:left;}.summary{ border-collapse: collapse;width: 100%;}.summary td, .summary th {border: 1px solid #ddd; padding: 8px;}
.summary tr:nth-child(even){background-color: #f2f2f2;}.summary tr:hover {background-color: #ddd;}
.summary th { padding-top: 12px; padding-bottom: 12px; text-align: left;color: #333;}.btn2:visited{color:#fff;}.btn2:active {color:#fff;}.btn2:hover {color:#fff;}
/* hide div  */
.navotar .hidediv {
    background: <?php if(!empty(get_option('list_header_color'))){ echo esc_attr(get_option('list_header_color'));}else{echo'#f2f2f2'; } ?>;
    border-color: #fafafa;
	color:<?php if(!empty(get_option('list_font_color'))){ echo esc_attr(get_option('list_font_color'));}else{echo'#333333'; } ?>;
    float: left;
    position: relative;
    z-index: 1;
  width: 100%;
    top: -320px;
}
#btn1_1 {
    background: <?php if(!empty(get_option('list_header_color'))){ echo esc_attr(get_option('list_header_color'));}else{echo'#f2f2f2'; } ?>;
	color:<?php if(!empty(get_option('list_font_color'))){ echo esc_attr(get_option('list_font_color'));}else{echo'#333333'; } ?>;
    border-radius: 15px;
    width: 100%;
    height: 29px;
    padding-top: 8px;
    outline: none;
}
#setinputbig {
    width: 100% !important;
    float: left;
    text-align: center;
    position: relative;
}
.messages {

    width: 100%;
    background: #f00;
    color: #fff;
    padding: 6px 18px;
    margin-top: 10px;

}
#checkpromo {
    width: 80%;
}
.select {width: 49%; margin-top: 5px; height: 40px !important;}
#state {width: 100%;margin-top: 5px; height: 39px;}
.navotar .close {width: 100%;float: right;text-align: right;color: red;height: 40px;padding-right: 3px;}
.navotar .details1 {width: 20%;float: right;text-align: right;color: red;height: 98px;padding-right: 3px;}
.navotar .type {width: 33%;float: left;height: 30px;text-align:center;font-size: 13px;}
.navotar .capacity {width: 40%;float: left;height: 30px;text-align:center;font-size: 13px;}

.topbarnew { {width: 26%;float: left;height: 30px;text-align:center;font-size: 13px;}
.navotar .paylater1 {position: relative;width: 100%;float: left;padding-top: 6px;height:35px;background-color: gainsboro;color: #333;}
.topbarnew p border: 1px solid #dedede;padding: 2px 3px; height: 40px;background: #f7f7f7;width: 99%;}
.redish{color:red;font-size: 14px !important;}
.blockfield { width: 12.8%;float:left;}
.topbarnew p {
    margin-top: 7px;
}
.topbarnew p {
    margin-top: 7px;
    padding-left: 10px;
}
.blockfield input {width: 90%;}
.blockfieldbtn{width: 10%;float:left;}
.blockfieldbtn .newbtn { background: #ff0000;color: #fff;border-radius: 0px; margin-top: 25px;height: 44px;padding: 2px 15px;}

.newsearch {background: <?php if(!empty(get_option('list_header_color'))){ echo esc_attr(get_option('list_header_color'));}else{echo'#f2f2f2'; } ?>;float: left;height: 100px; padding: 10px 10px; margin: 15px 0px; border: 1px solid #e5e5e5;}
.newselect{height: 43px !important;width: 90%;font-family: arial;}
a.btn2:hover {text-decoration: none; color:white;}
.navotar .detailcar {
    border: 1px groove #fdfafa;
    float: left;
    margin: 10px 1px 1px 4px;
}
.textsets {
    width: 98%;
    padding: 0px 0px 0px 8px;
}
.xdsoft_datetimepicker .xdsoft_ xdsoft_noselect {
	
	width: 221px;
}

.termssection1{width: 100%;float: left;height: 38px;background: #f2f2f2;padding: 3px 10px;}
.condition {float: left;width: 100%; background: #f9f9f9; margin-top: 10px;padding: 3px 10px;}
.btn.btn-info.continuous {float: right;margin: 20px 0px 0px 0px;}
.rite{text-align:right;}

#extra, #subfare,#taxsome {

    font-weight: bold;

}


.jumbotron {
    text-align: center;
    height: 100%;
    margin: 0 auto;
    padding: 151px 0px 0 0;
}
.jumbotron h1 {
    font-size: 63px;
    color: inherit;
}
.jumbotron p {
    margin-bottom: 15px;
    font-size: 21px;
    font-weight: 200;
}
	.navotar .half .btn {
    margin-right: 15px !important;
}
.btn-sm {
    line-height: 1.5;
    text-decoration: none;
    background-color: #0000f9;
    color: #fff;
    padding: 5px 10px;
}
.navotar .vtype {
    margin-right: 15px !important;
}
<?php
if(esc_attr( get_option('dropoffon') =='On')){ ?>
.input_age {
    width: 50%;
    float: left;
	padding-left:15px !important;
}
<?php }else{ ?>
.input_age {
    width: 100%;
    float: left;
}

<?php } ?>
	#btndiv .btn2{background-color: <?php echo esc_attr( get_option('list_btn_color') ); ?>!important;}
	
	.half{width: 50%;padding-left: 15px;float: left;}
	.navorect-footer {
		text-align: center;
		float: left;
		width: 100%;
		margin-top: 20px;
	}
	.rightdivset {
    float: right;
}

#recterrordrop,#rectpromoerr {
    float: left;
    width: 100%;
}

.selectbtn {
    width: 100%;
    margin: 0 auto;
    float: right;
    margin-right: 15px;
}
#country {
    width: 100%;
    margin-top: 5px;
    height: 39px;
}
#extramis{width:100%;}
</style>



