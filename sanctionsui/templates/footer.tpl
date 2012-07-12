            </div>
        </div>

        <div id="left-container" class="column">
            <div class="box">
                Elektrifi's Blaze Sanctions Screening solution consists 
                of a user interface like this connected to a set of Web services.
                <p /> 
                This means the screening process can be very easily integrated into 
                your existing systems using technologies that your IT team probably 
                already have in place.
                <p />
                You can operate Elektrifi's screening system manually by uploading 
                your files of data through our web-based interface or you can automate 
                the whole process directly from your own systems. 
                <p />
                If available, you can even use your own in-house web screens, your own 
                Visual Basic/C#/Java front-end application or link directly  
                from your business systems using secure messaging.   
            </div>
        </div>

        <div id="right-container" class="column">
            <div class="box">
                {if $authenticated}
                    Logged in as
                    {$identity->first_name|escape} {$identity->last_name|escape}
                    (<a href="{geturl controller='account' action='logout'}">logout</a>).<p />
                    <a href="{geturl controller='account' action='details'}">Update details</a>.
                {else}
                    You are not logged in.<p />
                    <a href="{geturl controller='account' action='login'}">Log in</a> or
                    <a href="{geturl controller='account' action='register'}">register</a> now.
                {/if}
            </div>
        </div>

        <div id="footer">
            Copyright © 2011 Elektrifi, a division of Elinea Consulting Ltd. All Rights Reserved.
        </div>
    </body>
</html>
