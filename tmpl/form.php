<form class="cptg-form">

	<p>
		<label>
			{{ data.labels.type_singular }}<br />
			<input type="text" class="cptg-field-post-type-singular" value="{{ data.type_singular }}" />
		</label>
	</p>

	<p>
		<label>
			{{ data.labels.type_plural }}<br />
			<input type="text" class="cptg-field-post-type-plural" value="{{ data.type_plural }}" />
		</label>
	</p>

<?php /*
	<p>
		<label>
			{{ data.labels.label_singular }}<br />
			<input type="text" class="cptg-field-label-singular" value="{{ data.label_singular }}" />
		</label>
	</p>

	<p>
		<label>
			{{ data.labels.label_plural }}<br />
			<input type="text" class="cptg-field-label-plural" value="{{ data.label_plural }}" />
		</label>
	</p>
*/ ?>

</form>
