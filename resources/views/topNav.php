<?php
$HostName = 'localhost';
$Database = 'my_ecom';
$UserName = 'root';
$Password = '';

$result = mysqli_connect($HostName, $UserName, $Password, $Database,);
$cat = mysqli_query($result, 'select * from categories');
$arr=[];
while($row = mysqli_fetch_assoc($cat))
{
    $arr[$row['id']]['category_name']= $row['category_name'];
    $arr[$row['id']]['parent_category_id']= $row['parent_category_id'];
}
// echo "<pre>";
// print_r($arr);
// die();
$html='';
$count=0;
function buildTreeView($arr1, $parent, $level=0, $prelevel=-1){
  global $count;
    global $html;
    foreach($arr1 as $id=>$data)
    {
        if($parent==$data['parent_category_id'])
        {

            if($level>$prelevel)
            {
                $html.='<ul class="nav navbar-nav">';
            }
            if($level==$prelevel)
            {
             // echo "123</br>";
            // $html.='1';
                $html.='</li>';
            }
            $html.=' <li><a href="#">'.$data['category_name'].'';
            if($level>$prelevel)
            {
                $prelevel=$level;
            }
           $level++;

           buildTreeView($arr1, $id, $level, $prelevel);
           $level--;
           echo $level;
        }
       // die();
       // echo" cjjcvhjcv</n>";
    }
    if($level==$prelevel){
        $html.='</li></ul>';
    }
    return $html;
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Font awesome -->
    <link href="frontend/css/font-awesome.css" rel="stylesheet">
    <!-- Bootstrap -->
    <link href="frontend/css/bootstrap.css" rel="stylesheet">
    <!-- SmartMenus jQuery Bootstrap Addon CSS -->
    <link href="frontend/css/jquery.smartmenus.bootstrap.css" rel="stylesheet">
    <!-- Product view slider -->
    <link rel="stylesheet" type="text/css" href="frontend/css/jquery.simpleLens.css">
    <!-- slick slider -->
    <link rel="stylesheet" type="text/css" href="frontend/css/slick.css">
    <!-- price picker slider -->
    <link rel="stylesheet" type="text/css" href="frontend/css/nouislider.css">
    <!-- Theme color -->
    <link id="switcher" href="frontend/css/theme-color/default-theme.css" rel="stylesheet">
    <!-- <link id="switcher" href="frontend/css/theme-color/bridge-theme.css" rel="stylesheet"> -->
    <!-- Top Slider CSS -->
    <link href="frontend/css/sequence-theme.modern-slide-in.css" rel="stylesheet" media="all">

    <!-- Main style sheet -->
    <link href="frontend/css/style.css" rel="stylesheet">

    <!-- Google Font -->
    <link href='https://fonts.googleapis.com/css?family=Lato' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Raleway' rel='stylesheet' type='text/css'>
    <script type="text/javascript" src="frontend/js/jquery.smartmenus.js"></script>
  <!-- SmartMenus jQuery Bootstrap Addon -->
  <script type="text/javascript" src="frontend/js/jquery.smartmenus.bootstrap.js"></script>
  <script src="frontend/js/sequence.js"></script>
  <script src="frontend/js/sequence-theme.modern-slide-in.js"></script>
  <!-- Product view slider -->
  <script type="text/javascript" src="frontend/js/jquery.simpleGallery.js"></script>
  <script type="text/javascript" src="frontend/js/jquery.simpleLens.js"></script>
  <!-- slick slider -->
  <script type="text/javascript" src="frontend/js/slick.js"></script>
  <!-- Price picker slider -->
  <script type="text/javascript" src="frontend/js/nouislider.js"></script>
  <!-- Custom js -->
  <script src="frontend/js/custom.js"></script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->


  </head>
  <body>
       <!-- wpf loader Two -->
    <!-- <div id="wpf-loader-two">
      <div class="wpf-loader-two-inner">
        <span>Loading</span>
      </div>
    </div> -->
    <!-- / wpf loader Two -->
  <!-- SCROLL TOP BUTTON -->
    <a class="scrollToTop" href="#"><i class="fa fa-chevron-up"></i></a>
  <!-- END SCROLL TOP BUTTON -->
  <!-- menu -->
  <section id="menu">
    <div class="container">
      <div class="menu-area">
        <!-- Navbar -->
        <div class="navbar navbar-default" role="navigation">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
          </div>
          <div class="navbar-collapse collapse">
            <!-- Left nav -->
            <?php
            echo buildTreeView($arr, 0);
            ?>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>
  </section>
  </body>
</html>
