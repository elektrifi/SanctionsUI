<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-gb" lang="en-gb">
<head>
<link rel="shortcut icon" href="/joomla/images/favicon.ico" />
  <meta http-equiv="content-type" content="text/html; charset=utf-8" />
  <meta name="robots" content="index, follow" />
  <meta name="keywords" content="elektrifi, blaze, elektrifi blaze, hadoop, lucene, ubuntu, mapreduce, hdfs, hbase" />
  <meta name="title" content="Blaze Sanctions Screening Demo" />
  <meta name="author" content="Jonathan Forbes" />

  <meta name="description" content="Elektrifi, shockingly powerful data processing." />
  <meta name="generator" content="Hand cranked" />
  <title>Blaze Sanctions Screening Demo</title>
  <link href="/joomla/templates/ja_purity/favicon.ico" rel="shortcut icon" type="image/x-icon" />
  <script type="text/javascript" src="/joomla/media/system/js/mootools.js"></script>
  <script type="text/javascript" src="/joomla/media/system/js/caption.js"></script>


<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/system/css/system.css" type="text/css" />
<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/system/css/general.css" type="text/css" />
<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/css/template.css" type="text/css" />

<script language="javascript" type="text/javascript" src="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/js/ja.script.js"></script>

<script language="javascript" type="text/javascript">
var rightCollapseDefault='show';
var excludeModules='38';
</script>
<script language="javascript" type="text/javascript" src="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/js/ja.rightcol.js"></script>

<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/css/menu.css" type="text/css" />
<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/styles/background/lighter/style.css" type="text/css" />
<link rel="stylesheet" href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/styles/elements/black/style.css" type="text/css" />

        <link rel="stylesheet" type="text/css" href="../include/dojoroot/dijit/themes/tundra/tundra.css"
        />
        <style type="text/css">
            body, html { font-family:helvetica,arial,sans-serif; font-size:90%; }
        </style>
		<style type="text/css">
			@import "../include/dojoroot/dijit/themes/tundra/tundra.css";
    		@import "../include/dojoroot/dojo/resources/dojo.css"
  		</style>
				
    <script type="text/javascript" src="../include/dojoroot/dojo/dojo.js" 
		djConfig="parseOnLoad: true">	
    </script>
    <script type="text/javascript">
        dojo.require("dijit.form.Button");
        dojo.require("dijit.Dialog");
        dojo.require("dijit.form.TextBox");
        dojo.require("dijit.form.DateTextBox");
        dojo.require("dijit.form.TimeTextBox");

        dojo.addOnLoad(function() {
            formDlg = dijit.byId("formDialog");
            // connect to the button so we display the dialog on click:
            dojo.connect(dijit.byId("buttonThree"), "onClick", formDlg, "show");
        });

        function checkData() {
            var data = formDlg.attr('value');
            console.log(data);
            if (data.sdate > data.edate) {
                alert("Start date must be before end date");
                return false;
            } else {
                return true;
            }
        }
    </script>
	
</head>

<!-- body id="bd" class="fs5 FF" -->
<body id="bd" class="tundra">
<a name="Top" id="Top"></a>
<ul class="accessibility">
	<li><a href="#ja-content" title="Skip to content">Skip to content</a></li>
	<li><a href="#ja-mainnav" title="Skip to main navigation">Skip to main navigation</a></li>
	<li><a href="#ja-col1" title="Skip to first column">Skip to first column</a></li>

	<li><a href="#ja-col2" title="Skip to second column">Skip to second column</a></li>
</ul>

<div id="ja-wrapper">

<!-- BEGIN: HEADER -->
<div id="ja-headerwrap">
	<div id="ja-header" class="clearfix" style="background: url(http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/templates/ja_purity/images/header/header2.jpg) no-repeat top right;">

	<div class="ja-headermask">&nbsp;</div>

			<h1 class="logo">

			<a href="/joomla/index.php" title="Elektrifi"><span>Elektrifi</span></a>
		</h1>
	
		<script type="text/javascript">var CurrentFontSize=parseInt('5');</script>
		</div>

	
	</div>
</div>
<!-- END: HEADER -->

<!-- BEGIN: MAIN NAVIGATION -->
<!-- END: MAIN NAVIGATION -->

<div id="ja-containerwrap-fr">
<div id="ja-containerwrap2">
	<div id="ja-container">
	<div id="ja-container2" class="clearfix">

		<div id="ja-mainbody-fr" class="clearfix">

