<link rel="stylesheet" href="{$module_dir}/backend/css/{$module_name}.backend.configure.style.css">
<script src="{$module_dir}/backend/js/{$module_name}.backend.configure.script.js"></script>
<h2>{$display_name}</h2>
{if !$simpleXML_loaded}
	<div class="error">
		<img src="../img/admin/error2.png">{$simpleXML_needed}
	</div>
{/if}
<form action="{$action}" method="post" enctype="multipart/form-data">
	<fieldset>
		<legend><img src="{$module_dir}/logo.gif" alt="" title="">{$settings}</legend>
		{foreach from=$configs item=config name=configLoop}
			<label>{$config.title}</label>
			<div class="margin-form">
				{if $config.type == 'boolean'}
					<input type="radio" name="{$config.name}" id="{$config.name}_yes" value="1" {if $config.value == 1}checked="checked"{/if} />
					<label for="{$config.name}_yes" class="t"><img src="../img/admin/enabled.gif" alt="{$enabled}" title="{$enabled}"></label>
					<input type="radio" name="{$config.name}" id="{$config.name}_no" value="0" {if $config.value == 0}checked="checked"{/if} />
					<label for="{$config.name}_no" class="t"><img src="../img/admin/disabled.gif" alt="{$disabled}" title="{$disabled}"></label>
				{elseif $config.type == 'text'}
					<input type="text" name="{$config.name}" id="{$config.name}" value="{$config.value}" />
				{elseif $config.type == 'textarea'}
					<textarea name="{$config.name}" id="{$config.name}" rows="10" cols="50">{$config.value}</textarea>
				{elseif $config.type == 'image'}
					<input type="file" name="{$config.name}" id="{$config.name}" />
				{elseif $config.type == 'select'}
					<select name="{$config.name}" id="{$config.name}">
					{foreach $config.options item=option name=configOptionsLoop}
						<option value="{$option.value}" {if $config.value eq $option.value}selected="selected"{/if}>{$option.name}</option>
					{/foreach}
					</select>
				{/if}
				{if isset($config.help)}
					<em class="help">{$config.help}</em>
				{/if}
				<div class="clear">&nbsp;</div>
			</div>
		{/foreach}
		<center><input type="submit" name="submit_{$module_name}" value="{$save}" class="button"></center>
	</fieldset>
</form>