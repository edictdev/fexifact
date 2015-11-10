{include file="header.tpl"}

<div id="flexifactwrap">
    <div class="rbuttons">
        <a class="btn"
           href="{$WWWROOT}artefact/flexifact/edit/edit.php">{str section="artefact.flexifact" tag="newflexifact"}</a>
    </div>
    <div id="filterform">{$filterform|safe}</div>
    {if !$flexifact.data}
        <div class="message">{$strnoflexifactaddone|safe}</div>
    {else}
        <div id="flexifactlist" class="fullwidth listing">
            {$flexifact.tablerows|safe}
        </div>
        {$flexifact.pagination|safe}
    {/if}
</div>
{include file="footer.tpl"}