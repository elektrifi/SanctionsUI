{include file='header_elektrifi.tpl'}

		<!-- BEGIN: CONTENT -->
		<div id="ja-contentwrap">
		<div id="ja-content">

<div class="article-content">
<h2>Blaze Sanctions Screening Demo</h2>

 This demo is an introduction to the capabilities of Elektrifi's Sanctions Screening service.
 <ul>
 	<li>You can test security and access control by logging in to the service.</li>
 	<li>You can manually key in a selection of your test data to check how the scoring system works.</li>
	<li>You can upload a file of your test customer data to see how the production processes work.</li>
 </ul>
 We've applied just a few restrictions to the demo compared to the production service:  
 <ul>
 	<li>You'll use a demo account rather than set up your own individual account.</li>
 	<li>You won't assume an administration role.</li>
	<li>You can upload a small file (< 10K) of your test customer data.</li>	
 </ul>    
 Now let's login to start the demo...<p />
 
        <div dojoType="dijit.Dialog" id="formDialog" title="Elektrifi Blaze Sanctions Screening Login" execute="alert('submitted w/args:\n' + dojo.toJson(arguments[0], true));">
            <table>
                <tr>
                    <td>
                        <label for="username">
                            Username:
                        </label>
                    </td>
                    <td>
                        <input dojoType="dijit.form.TextBox" type="text" name="username" id="username" 
							value="demoUser" size="25" maxlength="25" readonly="true">
                    </td>
                </tr>
                <tr>
                    <td>
                        <label for="passwordname">
                            Password:
                        </label>
                    </td>
                    <td>
                        <input dojoType="dijit.form.TextBox" type="password" name="password" id="password" 
						value="lk23_yo91#" size="25" maxlength="25" readonly="true">
                    </td>
                </tr>
                <tr>
                    <td align="center" colspan="2">
                        <button dojoType="dijit.form.Button" type="submit" onClick="return dijit.byId('formDialog').isValid();">
                            Login
                        </button>
                        <button dojoType="dijit.form.Button" type="button" onClick="dijit.byId('formDialog').hide();">
                            Reset
                        </button>
                    </td>
                </tr>
            </table>
        </div>
        <!--
		<button id="buttonThree" dojoType="dijit.form.Button" type="button">
            Login
        </button>
		-->
   
 		<script>  
		dojo.xhrPost({
    		content : {
        		login : dojo.byId('username').value,
        		password : dojo.byId('password').value
    		},
    		url: '/Login/DoLogin/',
		    load: function(response, ioArgs) {
        		if ('url:' == response.substr(0, 4)) {
            		location.href = response.substr(4);
        		} else {
            		alert(response);
        		}
    		}
		});   
		</script>
</div>

<span class="article_separator">&nbsp;</span>
		</div>
		</div>
		<!-- END: CONTENT -->

				<!-- BEGIN: LEFT COLUMN -->
		<div id="ja-col1">

					<div class="moduletable_menu">
					<!-- <h3></h3> -->
					<ul class="menu"><li class="item1"><a href="http://ec2-46-51-171-85.eu-west-1.compute.amazonaws.com/joomla/"><span>Home</span></a></li>
					<!-- li id="current" class="active item27"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=50&amp;Itemid=27"><span>Our Products</span></a></li><li class="parent item53"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=53&amp;Itemid=53"><span>Our Services</span></a></li><li class="item60"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=20&amp;Itemid=60"><span>Our Support</span></a></li><li class="item50"><a href="/joomla/index.php?option=com_content&amp;view=category&amp;id=1&amp;Itemid=50"><span>News</span></a></li><li class="item37"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=55&amp;Itemid=37"><span>Contact Us</span></a></li><li class="item61"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=56&amp;Itemid=61"><span>About Us</span></a></li> -->
					</ul>		</div>
			
			<!-- 
			
			<div class="moduletable_menu">

					<h3>Key Concepts</h3>
					<ul class="menu"><li class="item40"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=26&amp;Itemid=40"><span>Storing Data At Scale</span></a></li><li class="item38"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=24&amp;Itemid=38"><span>Processing Data At Scale</span></a></li><li class="item43"><a href="/joomla/index.php?option=com_content&amp;view=article&amp;id=43&amp;Itemid=43"><span>Querying Data At Scale</span></a></li></ul>		</div>

			</div>
			<br />
			-->
		<!-- END: LEFT COLUMN -->
		
		</div>

		
	</div>

	</div>
</div>
</div>

{include file='footer_elektrifi.tpl'}