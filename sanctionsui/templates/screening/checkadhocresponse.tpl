{include file='header.tpl' section='screening'}

<script type="text/javascript">
    dojo.require("dojox.data.QueryReadStore");
    dojo.require("dojox.grid.Grid");
    dojo.require("dojo.parser");
</script>             

<!--   body class="tundra"> -->
    <div dojoType="dojox.data.QueryReadStore" jsId="activeStore", url="records"></div>
    <div dojoType="dojox.grid.data.DojoData" jsId="model" rowsPerPage="20″ store="activeStore"></div>
    <table id="activePastes" dojoType="dojox.grid.Grid" model="model" style="height:300px; width:700px;">
        <thead>
            <tr>
                <th field="id">Id</th>
                <th field="title">Title</th>
                <th field="description">Description</th>
                <th field="posted_date">Posted</th>
            </tr>
        </thead>
    </table>
<!--  /body> -->
checkadhoc response goes here...<p />

<small>{$json}</small>

{include file='footer.tpl'}