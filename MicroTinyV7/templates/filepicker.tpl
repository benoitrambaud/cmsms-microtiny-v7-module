<!doctype html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta http-equiv="Content-type" content="text/html;charset=utf-8"/>
		<title>{$mod->Lang('filepickertitle')}</title>
		<link rel="stylesheet" type="text/css" href="{$mod->GetModuleURLPath()}/lib/css/filepicker.min.css" />
	</head>
	{strip}
	<body class="cmsms-filepicker">
		<div id="full-fp">
			<div class="filepicker-navbar">
				<div class="filepicker-navbar-inner">
					<div class="filepicker-view-option">
						<p><span class="filepicker-option-title">{$mod->Lang('fileview')}:&nbsp;</span>
							<span class="js-trigger view-list filepicker-button" title="{$mod->Lang('switchlist')}"><i class="cmsms-fp-th-list"></i></span>&nbsp;
							<span class="js-trigger view-grid filepicker-button active" title="{$mod->Lang('switchgrid')}"><i class="cmsms-fp-th"></i></span>
						</p>
					</div>
					{if !isset($type) || (isset($type) && ($type == 'file' || $type == 'any'))}
					<div class="filepicker-type-filter">
						<p><span class="filepicker-option-title">{$mod->Lang('filterby')}:&nbsp;</span>
							<span class="js-trigger filepicker-button" data-fb-type='image' title="{$mod->Lang('switchimage')}"><i class="cmsms-fp-picture"></i></span>&nbsp;
							<span class="js-trigger filepicker-button" data-fb-type='video' title="{$mod->Lang('switchvideo')}"><i class="cmsms-fp-film"></i></span>&nbsp;
							<span class="js-trigger filepicker-button" data-fb-type='audio' title="{$mod->Lang('switchaudio')}"><i class="cmsms-fp-music"></i></span>&nbsp;
							<span class="js-trigger filepicker-button" data-fb-type='archive' title="{$mod->Lang('switcharchive')}"><i class="cmsms-fp-zip"></i></span>&nbsp;
							<span class="js-trigger filepicker-button" data-fb-type='file' title="{$mod->Lang('switchfiles')}"><i class="cmsms-fp-file"></i></span>&nbsp;
							<span class="js-trigger filepicker-button active" data-fb-type='reset' title="{$mod->Lang('switchreset')}"><i class="cmsms-fp-reorder"></i></span>
						</p>
					</div>
					{/if}
				</div>
			</div>
			<div class="filepicker-container">
				<div class="filepicker-breadcrumb">
					<p title="{$mod->Lang('youareintext')}:"><i class="cmsms-fp-folder-open filepicker-icon"></i> {$startpath}</p>
				</div>
				<div id="filelist">
					<ul class="filepicker-list" id="filepicker-items">
						<li class="filepicker-item filepicker-item-heading">
							<div class="filepicker-thumb no-background">&nbsp;</div>
							<div class="filepicker-file-information">
								<h4 class="filepicker-file-title">{$mod->Lang('filename')}</h4>
							</div>
							<div class="filepicker-file-details">
								<span class="filepicker-file-dimension">
									{$mod->Lang('dimension')}
								</span>
								<span class="filepicker-file-size">
									{$mod->Lang('size')}
								</span>
								<span class="filepicker-file-ext">
									{$mod->Lang('type')}
								</span>
							</div>
						</li>
						{foreach $files as $file}
						<li class="filepicker-item{if $file.isdir} dir{else} {$file.filetype}{/if}" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}" data-fb-ext='{$file.ext}'>
							<div class="filepicker-thumb{if (isset($file.thumbnail) && $file.thumbnail != '') || $file.isdir} no-background{/if}">
							{if $showthumbnails && isset($file.thumbnail) && $file.thumbnail != ''}
								<a class="filepicker-file-action js-trigger-insert" href="{$file.fullurl}" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}">{$file.thumbnail}</a>
							{elseif $file.isdir}
								<a class="icon-no-thumb" href="{$file.chdir_url}" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}"><i class="cmsms-fp-folder-close"></i></a>
							{else}
								<a class="filepicker-file-action js-trigger-insert icon-no-thumb" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}" href="{$file.fullurl}">
									{if $file.filetype == 'image'}
										<i class="cmsms-fp-picture"></i>
									{elseif $file.filetype == 'video'}
										<i class="cmsms-fp-facetime-video"></i>
									{elseif $file.filetype == 'audio'}
										<i class="cmsms-fp-music"></i>
									{elseif $file.filetype == 'archive'}
										<i class="cmsms-fp-zip"></i>
									{else}
										<i class="cmsms-fp-file"></i>
									{/if}
								</a>
							{/if}
							</div>
							<div class="filepicker-file-information">
								<h4 class="filepicker-file-title">
								{if $file.isdir}
									<a class="filepicker-dir-action" href="{$file.chdir_url}" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}">{$file.name}</a>
								{else}
									<a class="filepicker-file-action js-trigger-insert" href="{$file.fullurl}" title="{if $file.isdir}{$mod->Lang('dirinfo')}: {/if}{$file.name}" data-fb-filetype='{$file.filetype}'>{$file.name}</a>
								{/if}
								</h4>
							</div>
							<div class="filepicker-file-details visuallyhidden">
								<span class="filepicker-file-dimension">
									{$file.dimensions}
								</span>
								<span class="filepicker-file-size">
									{if !$file.isdir}{$file.size}{/if}
								</span>
								<span class="filepicker-file-ext">
									{if !$file.isdir}{$file.ext}{else}dir{/if}
								</span>
							</div>
						</li>
						{/foreach}
					</ul>
				</div>
			</div>
		</div>
	</body>
	{/strip}

<script type="text/javascript">

// This function will be called to send the selected file URL back to TinyMCE.
function selectFileAndReturn(fileUrl) {
    if (!fileUrl) return;

    // Send a standard message object to the parent window (the editor dialog).
    window.parent.postMessage({
        mceAction: 'setFile',  // The action identifier our callback is waiting for
        url: fileUrl           // The URL of the chosen file
    }, '*');
}

// Wait for the document to be fully loaded.
document.addEventListener('DOMContentLoaded', function() {
    
    // --- CORRECTION: Use Event Delegation ---
    // We attach a single listener to a parent element that is always present.
    const filelistContainer = document.getElementById('filelist');



    if (filelistContainer) {
        filelistContainer.addEventListener('click', function(event) {
            
            // Find the link that was clicked, even if the click was on an icon inside it.
            const targetLink = event.target.closest('.js-trigger-insert');

            // If the click was not on a file insertion link, do nothing.
            if (!targetLink) {
                return;
            }

            // Prevent the link from navigating away from the page.
            event.preventDefault();

            // Get the file URL from the link's 'href' attribute.
            const fileUrl = targetLink.getAttribute('href');

            // Call our function to send the URL back to TinyMCE.
            selectFileAndReturn(fileUrl);
        });
    }
});
</script>

</html>
