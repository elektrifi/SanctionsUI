{include file='header.tpl' section='screening'}

<form method="post" action="{geturl action='checkadhoc'}">
    <fieldset>
        <input type="hidden" name="redirect" value="{$redirect|escape}" />

        <legend>Perform Ad hoc Check</legend>

		<div class="error"{if !$fp->hasError()} style="display: none"{/if}>
			We've found an error in the form below. <br />Please check
			the highlighted fields and resubmit the form.
		</div>
		
        <div class="row" id="form_checkadhoc_container">
            <label for="form_adhocname">Name to Screen:</label>
            <input type="text" id="form_checkadhoc" maxlength=50
                   name="adhocname" value="Robert Gabriel Mugabe"
                   onClick="this.value='';"
                   />
                   <!--  name="username" value="{$username|escape}" />  -->
            		<!--   {include file='lib/error.tpl' error=$errors.adhocname}-->
            {include file='lib/error.tpl' error=$fp->getError('adhocname')}	
        </div>

        <div class="submit">
            <input type="submit" value="Check This Entry" />
        </div>

        <div>
            <a href="{geturl action='uploadfile'}">Prefer to upload a file of data?</a>
        </div>
    </fieldset>
</form>

{include file='footer.tpl'}