<?php

require_once dirname(__FILE__).'/HTMLPurifier.standalone.php';

$iniciativa = new Iniciativas();

$buttonLabel = __('Colocar minha iniciativa no mapa', 'pontosdecultura');

$publish = array_key_exists('publish', $_POST) && ($_POST['publish'] == 'Publish' || $_POST['publish'] == 'Publish Iniciativa' || $_POST['publish'] == $buttonLabel );

$post_type = '';
if ( !isset($_GET['post_type']) )
	$post_type = 'mapa';
elseif ( in_array( $_GET['post_type'], get_post_types( array('show_ui' => true ) ) ) )
	$post_type = $_GET['post_type'];
else
	wp_die( __('Invalid post type') );

$post_type_object = get_post_type_object( $post_type );

$language_code = array_key_exists('icl_post_language', $_POST) ? $_POST['icl_post_language'] : 'es';

if ( ! is_user_logged_in() )
{?>
<div class="login-entry <?php echo Iniciativas::NEW_INICIATIVA_PAGE ?>" >
	<div class="container">
		<div class="row">
			<div class="col-lg-12 sections-description">
				<h2 class="text-center"><?php bloginfo('description'); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-lg-12 sections-advise">
				<h2 class="text-center"><?php echo __('É necessário estar logado para acessar essa área. Faça o login ou, se ainda não tiver uma conta, clique em ', 'pontosdecultura'); ?><a href="<?php echo get_bloginfo('url').'/wp-login.php?action=register&redirect_to='.Iniciativas::get_new_url(); ?>"><?php _e('"Cadastre-se aqui"', 'pontosdecultura'); ?></a></h2>
			</div>
		</div>
	
		<div class="row">
			<div class="col-md-4 col-lg-4 col-md-offset-4  col-lg-offset-4">
				<div class="text-center block-center">
				 <?php wp_login_form( ); ?> 
			</div>
			</div>
		</div>
		<div class="login-register"><a href="<?php echo get_bloginfo('url').'/wp-login.php?action=register&redirect_to='.Iniciativas::get_new_url(); ?>"><?php _e('Cadastre-se aqui', 'pontosdecultura'); ?></a></div>
	</div>
</div>
<?php
}
else 
{

	$attach_id = array();
	$attach = array();
	
	$has_thumbnail = false;
	$has_thumbnail2 = false;
	$has_thumbnail3 = false;
	$has_thumbnail4 = false;
	
	//$title = $post_type_object->labels->add_new_item;
	$title = "Preencha os campos abaixo com informações sobre sua pesquisa continuada em artes cênicas ou performativas.";
	
	$editing = true;
	$post = null;
	if($publish && array_key_exists('post_ID', $_POST) && $_POST['post_ID'] > 0)
	{
		$post = get_post($_POST['post_ID']);
	}
	else 
	{
		$post = $iniciativa->get_default_post_to_edit( $post_type, $publish );
	}
	
	$post_ID = $post->ID;
	
	if($publish && $post_ID == 0) wp_die('Something is wrong!!!');
	
	$user_ID = get_current_user_id();
	
	$form_extra = '';
	
	$message = array();
	
	$notice = false;
	
	$purifier = new HTMLPurifier();
	
	if($publish)
	{
		/* Save Fields and Custom Fields */
		foreach ($iniciativa->getFields() as $key => $field)
		{
			if(array_key_exists('save', $field) && $field['save'] == false ) /* do not save especial fields */
			{
				continue;
			}
			
			if( (array_key_exists('required', $field) && $field['required']) && (! array_key_exists($field['slug'], $_POST) || empty($_POST[$field['slug']]) ))
			{
				$message[] = '<span class="error-msn-pre">'.__('*O campo obrigatório').': '.'</span><div onclick="iniciativa_scroll_to_anchor(\''.$field['slug'].'\');">'.$field['title'].' '.__('não foi preenchido').'</div>';
				$notice = true;
			}
			else 
			{
				
				if(array_key_exists('buildin', $field) && $field['buildin'] == true)
				{
					if(array_key_exists('type', $field) && $field['type'] == 'wp_editor')
					{
						$post->{$field['slug']} = $purifier->purify(stripslashes($_POST[$field['slug']]));
					}
					else 
					{
						$post->{$field['slug']} = wp_strip_all_tags($_POST[$field['slug']]);
					}
				}
				else 
				{
					if( array_key_exists($field['slug'], $_POST) )
					{
						if(array_key_exists('type', $field) && $field['type'] == 'checkbox' && is_array($_POST[$field['slug']]))
						{
							update_post_meta($post_ID, $field['slug'], implode(',', $_POST[$field['slug']]));
						}
						else
						{
							update_post_meta($post_ID, $field['slug'], $_POST[$field['slug']]);
						}
					}
					elseif(array_key_exists('type', $field) && $field['type'] == 'dropdown-meses-anos')
					{
						if( array_key_exists($field['slug'].'-anos', $_POST) )
						{
							update_post_meta($post_ID, $field['slug'].'-anos', $_POST[$field['slug'].'-anos']);
						}
						if( array_key_exists($field['slug'].'-meses', $_POST) )
						{
							update_post_meta($post_ID, $field['slug'].'-meses', $_POST[$field['slug'].'-meses']);
						}
					}
				}
			}
		}
		
		$post->post_name = sanitize_title($post->post_title);
		
		wp_update_post($post);
		
		/* Save Language */
		global $sitepress;
		if(is_object($sitepress))
		{
			$sitepress->set_element_language_details($post_ID, 'post_'.get_post_type($post_ID), null , $language_code, null);
		}
		
		/* Save Categories */
		
		$args = array(
			'public'   => true,
		);
		$output = 'names'; // or objects
		$operator = 'and'; // 'and' or 'or'
		$taxonomies = get_taxonomies( $args, $output, $operator );
		
		foreach ($taxonomies as $taxonomy)
		{
			if(array_key_exists('taxonomy_'.$taxonomy, $_POST))
			{
				$result = wp_set_post_terms($post_ID, $_POST['taxonomy_'.$taxonomy], $taxonomy);
				if( is_object($result) && get_class($result) == 'WP_Error' )
				{
					$message[] = __('Erro ao gravar categorização', 'pontosdecultura').': '.$taxonomy;
					$notice = true;
				}
				
				unset($_POST['taxonomy_'.$taxonomy]);
			}
		}
		
		foreach ($_POST as $key => $value)
		{
			$input_pos = strpos($key, '_input'); 
			if( $input_pos > 0 && !empty($value) ) // input text
			{
				$taxonomy =  substr($key, 0, strpos($key, "_"));
				$term_id = substr($key, strlen($taxonomy) + 1, $input_pos - (strlen($taxonomy) + 1));
			
				$result = wp_set_post_terms($post_ID, $term_id, $taxonomy, true); // save term
				if( is_object($result) && get_class($result) == 'WP_Error' )
				{
					$message[] = __('Erro ao gravar categorização campo de texto outra/outro', 'pontosdecultura').': '.$taxonomy;
					$notice = true;
				}
				
				//save input value
				update_post_meta($post_ID, "_".$key, sanitize_text_field($value));
				
			}
			
		}
		
		/* Save Attached Content */
		
		if (!function_exists('wp_generate_attachment_metadata')){
			require_once(ABSPATH . "wp-admin" . '/includes/image.php');
			require_once(ABSPATH . "wp-admin" . '/includes/file.php');
			require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		}
		
		$has_thumbnail = true;
		$has_thumbnail2 = true;
		$has_thumbnail3 = true;
		$has_thumbnail4 = true;
		
		if ($_FILES) {
			foreach ($_FILES as $file => $array) {
				if ($_FILES[$file]['error'] !== UPLOAD_ERR_OK && $_FILES[$file]['error'] !== UPLOAD_ERR_NO_FILE )
				{
					switch($file)
					{
						case 'thumbnail':
							$message[] = __('Erro ao registrar imagem de destaque', 'pontosdecultura');
							$has_thumbnail = false;
							break;
						case 'thumbnail2':
							$message[] = __('Erro ao registrar segunda imagem', 'pontosdecultura');
							$has_thumbnail2 = false;
							break;
						case 'thumbnail3':
							$message[] = __('Erro ao registrar terceira imagem', 'pontosdecultura');
							$has_thumbnail3 = false;
							break;
						case 'thumbnail4':
							$message[] = __('Erro ao registrar foto do responsável', 'pontosdecultura');
							$has_thumbnail4 = false;
							break;
						default:
							$message[] = __('Erro ao registrar imagens', 'pontosdecultura');
							break;
					}
						
					$notice = true;
				}
				elseif( $_FILES[$file]['error'] == UPLOAD_ERR_OK )
				{
					$attach_id[$file] = media_handle_upload( $file, $post_ID );
					if( is_object($attach_id[$file]) && $attach_id[$file] instanceof WP_Error )
					{
						$message[] = __('Erro ao carregar imagens/anexos: ', 'pontosdecultura').$attach_id[$file]->get_error_message();
						$notice = true;
					}
					else 
					{
						$attach[$file] = wp_get_attachment_url($attach_id[$file]);
					}
				}
			}
		}
		foreach ($attach_id as $key => $value)
		{
			//and if you want to set that image as Post  then use:
			if($key == 'thumbnail' && $has_thumbnail)
			{
				if( ! update_post_meta($post_ID,'_thumbnail_id',$attach_id['thumbnail']))
				{
					$message[] = __('Erro ao gravar imagem de destaque', 'pontosdecultura');
					$notice = true;
				}
			}
			elseif($key == 'thumbnail2' && $has_thumbnail2)
			{
				if( ! update_post_meta($post_ID,'thumbnail2', $attach['thumbnail2'] ) )
				{
					$message[] = __('Erro ao gravar segunda imagem', 'pontosdecultura');
					$notice = true;
				}
			}
			elseif($key == 'thumbnail3' && $has_thumbnail3)
			{
				if( ! update_post_meta($post_ID,'thumbnail3', $attach['thumbnail3'] ) )
				{
					$message[] = __('Erro ao gravar terceira imagem', 'pontosdecultura');
					$notice = true;
				}
			}
			elseif($key == 'thumbnail4' && $has_thumbnail4)
			{
				if( ! update_post_meta($post_ID,'thumbnail4', $attach['thumbnail4'] ) )
				{
					$message[] = __('Erro ao gravar foto do responsável', 'pontosdecultura');
					$notice = true;
				}
			}
		}
		
		// Tratando campos especiais
		update_post_meta($post_ID, '_iniciativa-tem-fotos', $has_thumbnail || $has_thumbnail2 || $has_thumbnail3 ? 'S' : 'N');
		
		update_post_meta($post_ID, '_iniciativa-tem-links', array_key_exists('iniciativa-publicacoes', $_POST) && !empty($_POST['iniciativa-publicacoes']) ? 'S' : 'N' );
		
		
        /*
		var_dump($message);
		echo '<pre>';
		var_dump($_POST);
		echo '<br/>';
		var_dump($post);
		echo '<br/>';
		var_dump($attach_id);
		echo '</pre>';
		
        */
		
		if($notice == false && count($message) == 0)
		{?>
			<div class="home-entry <?php echo Iniciativas::NEW_INICIATIVA_PAGE ?> " >
				<div class="container">
					<div class="row">
						<div class="new-iniciativa-sucess"><?php _e('Sua pesquisa continuada foi cadastrada e aguarda aprovação de nossos moderadores. Em até 15 dias ela deve estar disponível no Mapa. Obrigado ;)'); ?>
						</div>
					</div>
				</div>
			</div><?php
			return ;
		}
	}
	
	$form_action = 'editpost';
	$nonce_action = 'update-post_' . $post_ID;
	$form_extra .= "<input type='hidden' id='post_ID' name='post_ID' value='" . esc_attr($post_ID) . "' />";
	


	?>
<div class="home-entry <?php echo Iniciativas::NEW_INICIATIVA_PAGE ?> " >

	<div class="container">
		<div class="row">
			<div class="col-lg-12 sections-description">
				<h2 class="text-center"><?php bloginfo('description'); ?></h2>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
	<?php //screen_icon(); ?>
	<h2 class="new-iniciativa"><?php
	echo esc_html( $title );
	if ( isset( $post_new_file ) && current_user_can( $post_type_object->cap->create_posts ) )
		echo ' <a href="' . esc_url( $post_new_file ) . '" class="add-new-h2">' . esc_html( $post_type_object->labels->add_new ) . '</a>';
	?></h2>
	<?php if ( $notice ) : ?>
	<div id="notice" class="error">
					<p><?php echo implode( ' ', $message ); ?></p>
				</div>
	<?php endif; ?>
	<?php if ( !$notice && count($message) > 0 ) : ?>
	<div id="message" class="updated">
					<p><?php echo implode( '<br/>', $message ); ?></p>
				</div>
	<?php endif; ?>
	<form name="post" action="" method="post" id="post"
					<?php do_action('post_edit_form_tag', $post); ?>
					enctype="multipart/form-data">
	<?php wp_nonce_field($nonce_action); ?>
	<input type="hidden" id="user-id" name="user_ID"
						value="<?php echo (int) $user_ID ?>" /> <input type="hidden"
						id="hiddenaction" name="action"
						value="<?php echo esc_attr( $form_action ) ?>" /> <input
						type="hidden" id="originalaction" name="originalaction"
						value="<?php echo esc_attr( $form_action ) ?>" /> <input
						type="hidden" id="post_author" name="post_author"
						value="<?php echo esc_attr( $post->post_author ); ?>" /> <input
						type="hidden" id="post_type" name="post_type"
						value="<?php echo esc_attr( $post_type ) ?>" /> <input
						type="hidden" id="original_post_status"
						name="original_post_status"
						value="<?php echo esc_attr( $post->post_status) ?>" /> <input
						type="hidden" id="referredby" name="referredby"
						value="<?php echo esc_url(stripslashes(wp_get_referer())); ?>" />
	<?php if ( ! empty( $active_post_lock ) )
	{?>
		<input type="hidden" id="active_post_lock"
						value="<?php echo esc_attr( implode( ':', $active_post_lock ) ); ?>" /><?php
	}
	if(function_exists('icl_get_current_language'))
	{?>
		<input type="hidden" id="icl_post_language" name="icl_post_language"
						value="<?php echo stripslashes(icl_get_current_language()); ?>" /><?php
	}
	if ( 'draft' != get_post_status( $post ) )
		wp_original_referer_field(true, 'previous');
	
	echo $form_extra;
	
	
	/*$fields = $iniciativa->getFields();
	foreach ($fields as $field)
	{
		Iniciativas::print_field($field);
	}
	$taxonomies = get_object_taxonomies( $post_type, 'objects' );
	foreach ($taxonomies as $taxonomy)
	{
		Iniciativas::print_field($taxonomy->name, array(
			'label' => $taxonomy->labels->name,
		));
	}*/
	
	$fields = $iniciativa->getFields();
	Iniciativas::print_field($fields['Data da atividade']);
	Iniciativas::print_field('territorio', array(
			'label' => 'Estado e Cidade',
			'required' => true,
			'type' => 'estadocidade'
	));
	Iniciativas::print_field($fields['Educador responsável']);
	Iniciativas::print_field($fields['post_title']);
	Iniciativas::print_field('acao', array(
			'label' => 'Ação em DH',
			'outro' => true,
			'type' => 'dropdown',
	));
	Iniciativas::print_field('eixo', array(
			'label' => 'Eixo',
			'outro' => true,
			'type' => 'dropdown',
	));
	Iniciativas::print_field($fields['Direito Violado/Abordado']);
	Iniciativas::print_field('sujeito', array(
			'label' => 'Sujeito de direito',
			'outro' => true,
			'type' => 'dropdown',
	));
	Iniciativas::print_field($fields['Elementos de DH']);
	Iniciativas::print_field($fields['Organizações/parcerias']);
	Iniciativas::print_field($fields['Nº de participantes']);
	Iniciativas::print_field($fields['Nº de masculino']);
	Iniciativas::print_field($fields['Nº de feminino']);
	//Iniciativas::print_field($fields['Sócio economico']);
	Iniciativas::print_field($fields['Nº de pessoas com deficiencia']);
	Iniciativas::print_field($fields['Nº de negro']);
	Iniciativas::print_field($fields['Nº de indios']);
	Iniciativas::print_field($fields['Nº de amarelos']);
	Iniciativas::print_field($fields['Nº de brancos']);
	Iniciativas::print_field($fields['Nº de crianças']);
	Iniciativas::print_field($fields['Nº de jovens']);
	Iniciativas::print_field($fields['Nº de adultos']);
	Iniciativas::print_field($fields['Nº de idosos']);
	Iniciativas::print_field($fields['1-grau-incompleto']);
	Iniciativas::print_field($fields['1-grau-completo']);
	Iniciativas::print_field($fields['Nº de 2 grau incompleto']);
	Iniciativas::print_field($fields['Nº de 2 grau completo']);
	Iniciativas::print_field($fields['Nº de 3 grau incompleto']);
	Iniciativas::print_field($fields['Nº de 3 grau completo']);
	//Iniciativas::print_field($fields['Data de chegada']);
	//Iniciativas::print_field($fields['Pendência']);
	//Iniciativas::print_field($fields['Data de pagamento']);
	
	
	?>
 	<br/>
 	<div class="images">
	 	<div class="images-thumbnail-block images-thumbnail">
			<label for="thumbnail" class="iniciativa-item-label">
				<div class="iniciativa-item-title"><?php _e('Image de Destaque', 'pontosdecultura'); ?>
				</div>
				<div class="iniciativa-item-tip-text">
					<?php _e('Imagem que será exibida em listagens', 'pontosdecultura'); ?>
				</div>
			</label>
			<input type="file" name="thumbnail" id="thumbnail"
				value="<?php ?>"
				onchange="displayPreview(this.files, 'thumbnail');" class="iniciativa-file-upload"><?php
			if($has_thumbnail && array_key_exists('thumbnail', $attach))
			{?>
				<img src="<?php echo $attach['thumbnail']; ?>"><?php
			}?>
		</div>
		<div class="images-thumbnail-block images-thumbnail2">
			<label for="thumbnail2" class="iniciativa-item-label">
				<div class="iniciativa-item-title"><?php _e('Anexo', 'pontosdecultura'); ?>
				</div>
				<div class="iniciativa-item-tip-text">
					<?php _e('&nbsp;', 'pontosdecultura'); ?>
				</div>
			</label>
			<input type="file" name="thumbnail2" id="thumbnail2"
				value="<?php echo array_key_exists('thumbnail2', $_REQUEST) ? esc_url($_REQUEST['thumbnail2']) : ''; ?>"
				onchange="displayPreview(this.files, 'thumbnail2');" class="iniciativa-file-upload"><?php
			if($has_thumbnail2 && array_key_exists('thumbnail2', $attach))
			{?>
				<img src="<?php echo $attach['thumbnail2']; ?>"><?php
			}?>
		</div>
	</div>
					<div class="publish-button-block">
						<input id="original_publish" type="hidden" value="Publish"
							name="original_publish"> <input id="publish"
							class="button button-primary button-large" type="submit"
							accesskey="p"
							value="<?php echo $buttonLabel; ?>"
							name="publish">
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<?php 
}

