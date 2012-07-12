{include file='header.tpl' section='screening'}

Welcome {$identity->first_name} {$identity->last_name}. <p />

This section allows you to test two approaches for sanctions screening. <p />

<ul>
<li><a href="/screening/checkadhoc">Adhoc customer screening</a></li>
<li><a href="/screening/uploadfile">Data file-based screening</a></li>
</ul>
 
{include file='footer.tpl'}