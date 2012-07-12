{include file='header.tpl' section='account'}

Welcome {$identity->first_name} {$identity->last_name}. <p />
 

<form method="post" action="{geturl action='screening'}">
    <fieldset>
        <input type="hidden" name="redirect" value="{$redirect|escape}" />
        <div>
            <a href="/screening/index">Press to see sanctions screening in action.</a>
        </div>
    </fieldset>
</form>
{include file='footer.tpl'}