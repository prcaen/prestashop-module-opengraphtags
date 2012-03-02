{assign var='module' value=$module_opengraphtags_header}
<!-- MODULE {$module.module_name} -->
{foreach $module.metas item=meta name=metaLoop}
	<meta property="{$meta.property}" content="{$meta.content}"/>
{/foreach}
<!-- / MODULE {$module.module_name} -->