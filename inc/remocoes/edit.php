<h2><?php _e('Configurar campos das remoções', 'pontosdecultura'); ?></h2>

<div style="display: none;">
	<div id="remocoes-stored-values"><?php
		echo htmlspecialchars(json_encode($current));
	?></div>
	<div class="remocoes-value" id="remocoes-default-value">
		<input type="hidden" value="%VALUE%"
			name="remocoes-custom[%ID%][values][]">
		<label>%VALUE%</label>
		<button class="remocoes-value-remove"><?php
			_e('Remover', 'pontosdecultura');
		?></button>
	</div>
	<?php foreach (PontosSettingsPage::getTypeData() as $t => $d): ?>
		<div class="remocoes-field" id="remocoes-default-<?php echo $t; ?>">
			<hr>
			<b><?php echo htmlspecialchars($d['label']); ?></b>
			<input type="hidden" value="<?php echo $t; ?>"
				name="remocoes-custom[%ID%][type]">
			<button type="button" class="remocoes-remove-field"><?php
				_e('Remover', 'pontosdecultura'); ?>
			</button>
			<br>
			<button type="button" class="remocoes-field-up">^</button>
			<button type="button" class="remocoes-field-down">v</button>
			<?php if (empty($d['unique'])): ?>
				<br>
				<label><?php _e('Nome*:', 'pontosdecultura'); ?></label>
				<input type="text" class="remocoes-required remocoes-custom-title"
					name="remocoes-custom[%ID%][title]">
				<br>
				<label><?php _e('Dica:', 'pontosdecultura'); ?></label>
				<input type="text" name="remocoes-custom[%ID%][tip]"
					class="remocoes-custom-tip">
				<br>
				<input type="checkbox" name="remocoes-custom[%ID%][required]"
					class="remocoes-custom-required">
				<label><?php _e('Obrigatório', 'pontosdecultura'); ?></label>
				<br>
				<input type="checkbox" name="remocoes-custom[%ID%][hide]"
					class="remocoes-custom-hide">
				<label><?php _e('Esconder', 'pontosdecultura'); ?></label>
				<br>
				<input type="checkbox" name="remocoes-custom[%ID%][advanced]"
					class="remocoes-custom-advanced">
				<label><?php _e('Usar na busca avançada', 'pontosdecultura');
					?></label>
				<br>
				<input type="checkbox" name="remocoes-custom[%ID%][multiple]"
					class="remocoes-custom-multiple">
				<label><?php _e('Múltiplas entradas', 'pontosdecultura'); ?></label>
				<br>
				<label><?php _e('Quem pode baixar:', 'pontosdecultura'); ?></label>
				<select name="remocoes-custom[%ID%][download]"
					class="remocoes-custom-download">
					<option value="admin"><?php
						_e('Apenas administrador', 'pontosdecultura');
					?></option>
					<option value="everyone"><?php
						_e('Todos', 'pontosdecultura');
					?></option>
				</select>
			<?php endif; ?>
			<?php if (!empty($d['can_be_tax'])): ?>
				<br>
				<input type="checkbox" name="remocoes-custom[%ID%][taxonomy]"
					class="remocoes-custom-taxonomy">
				<label><?php _e('Taxonomia', 'pontosdecultura'); ?></label>
				<br>
			<?php endif; ?>
			<?php if (in_array('values', $d['extra_data'], true)): ?>
				<div class="remocoes-value-editor">
					<form class="remocoes-value-form">
						<label><?php _e('Valor*:', 'pontosdecultura'); ?></label>
						<input type="text" class="remocoes-value-name">
						<button class="remocoes-value-add"><?php
							_e('Adicionar', 'pontosdecultura');
						?></button>
						<input type="hidden" class="remocoes-value-id" value="%ID%">
					</form>
					<div class="remocoes-values remocoes-not-empty">
					</div>
				</div>
			<?php endif; ?>
			<?php if (in_array('rows', $d['extra_data'], true)): ?>
				<br>
				<label><?php _e('Linhas*:', 'pontosdecultura'); ?></label>
				<input type="text"
					class="remocoes-number remocoes-required remocoes-not-zero
						remocoes-custom-rows"
					name="remocoes-custom[%ID%][rows]" value="16">
			<?php endif; ?>
			<?php if (in_array('cols', $d['extra_data'], true)): ?>
				<br>
				<label><?php _e('Colunas*:', 'pontosdecultura'); ?></label>
				<input type="text"
					class="remocoes-number remocoes-required remocoes-not-zero
						remocoes-custom-cols"
					name="remocoes-custom[%ID%][cols]" value="32">
			<?php endif; ?>
		</div>
	<?php endforeach; ?>
</div>

<h3><?php _e('Importar/Exportar configuração', 'pontosdecultura'); ?></h3>
<form id="remocoes-export-fields-form" method="post">
	<input type="submit" name="remocoes-export"
		value="<?php _e('Exportar para arquivo', 'pontosdecultura'); ?>">
</form>
<form enctype="multipart/form-data" method="POST"
	id="remocoes-import-fields-form">
	<?php _e("Arquivo a importar:", "pontosdecultura"); ?>
	<input name="remocoes-import-file" type="file">
	<input type="submit" name="remocoes-import"
		value="<?php _e('Importar', 'pontosdecultura') ?>">
</form>

<h3><?php _e('Opções Gerais', 'pontosdecultura'); ?></h3>
<form id="remocoes-builtin-names-form" method="post">
	<label><?php _e('Nome do campo de título:', 'pontosdecultura'); ?></label>
	<input type="text" name="remocoes-post-title"
		value="<?php echo esc_attr(get_option('remocoes_post_title',
			__('Título', 'pontosdecultura'))); ?>">
	<br>
	<label><?php _e('Nome do campo de descrição:', 'pontosdecultura'); ?></label>
	<input type="text" name="remocoes-post-content"
		value="<?php echo esc_attr(get_option('remocoes_post_content',
			__('Descrição', 'pontosdecultura'))); ?>">
	<br>
	<label><?php _e('Nome do campo de mapa:', 'pontosdecultura'); ?></label>
	<input type="text" name="remocoes-map-title"
		value="<?php echo esc_attr(get_option('remocoes_map_title',
			__('Localize a remoção no mapa', 'pontosdecultura'))); ?>">
	<br>
	<input type="submit" name="remocoes-builtin-names"
		value="<?php _e('Salvar', 'pontosdecultura'); ?>">
</form>

<form id="remocoes-add-field-form">
	<h3><?php _e('Adicionar novo campo', 'pontosdecultura'); ?></h3>
	<p style="color: red;"><?php
		_e('Renomear campos pode tornar os dados inacessíveis.',
				'pontosdecultura'); ?></p>
	<select name="type" id="remocoes-add-field-type">
	<?php foreach (PontosSettingsPage::getTypeData() as $t => $d): ?>
		<option value="<?php echo $t ?>"><?php
			echo htmlspecialchars($d['label']);
		?></option>
	<?php endforeach; ?>
	</select>
	<button id="remocoes-add-field-submit"><?php
		_e('Adicionar', 'pontosdecultura');
	?></button>
</form>

<form id="remocoes-fields-form" method="post">
	<div id="remocoes-custom-fields" class="remocoes-not-empty">
	</div>
	<p id="remocoes-error-required"
		style="visibility: hidden; color: red; font-weight: bold;"><?php
		_e('Todos os campos com * são obrigatórios', 'pontosdecultura');
	?></p>
	<input type="submit" value="<?php _e('Salvar', 'pontosdecultura'); ?>">
</form>
