<ul>
	<li class='update'>
		<?php echo $l->t('Updating ownCloud to version %s, this may take a while.', array($_['version'])); ?><br /><br />
	</li>
</ul>
<script>
	$(document).ready(function () {
		OC.EventSource.requesttoken = oc_requesttoken;
		var updateEventSource = new OC.EventSource(OC.webroot+'/core/ajax/update.php');
		updateEventSource.listen('success', function(message) {
			$('<span>').append(message).append('<br />').appendTo($('.update'));
		});
		updateEventSource.listen('error', function(message) {
			$('<span>').addClass('error').append(message).append('<br />').appendTo($('.update'));
		});
		updateEventSource.listen('failure', function(message) {
			$('<span>').addClass('error').append(message).append('<br />').appendTo($('.update'));
			$('<span>')
				.addClass('error bold')
				.append('<br />')
				.append(t('core', 'The update was unsuccessful. Please report this issue to the <a href="https://github.com/owncloud/core/issues" target="_blank">ownCloud community</a>.'))
				.appendTo($('.update'));
		});
		updateEventSource.listen('done', function(message) {
			$('<span>').addClass('bold').append('<br />').append(t('core', 'The update was successful. Redirecting you to ownCloud now.')).appendTo($('.update'));
			setTimeout(function () {
				window.location.href = OC.webroot;
			}, 3000);
		});
	});
</script>