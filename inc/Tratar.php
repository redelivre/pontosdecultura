<?php

class Tratar
{
	
	public static function tiracento($texto)
	{
		$trocarIsso = 	array('à','á','â','ã','ä','å','ç','è','é','ê','ë','ì','í','î','ï','ñ','ò','ó','ô','õ','ö','ù','ü','ú','ÿ','À','Á','Â','Ã','Ä','Å','Ç','È','É','Ê','Ë','Ì','Í','Î','Ï','Ñ','Ò','Ó','Ô','Õ','Ö','Ù','Ü','Ú','Ÿ',);
		$porIsso = 		array('a','a','a','a','a','a','c','e','e','e','e','i','i','i','i','n','o','o','o','o','o','u','u','u','y','A','A','A','A','A','A','C','E','E','E','E','I','I','I','I','N','O','O','O','O','O','U','U','U','Y',);
		$titletext = str_replace($trocarIsso, $porIsso, $texto);
		return $titletext;
	}
	
	public static function FormatText($str)
	{
		$str = trim($str);
		$str = strtolower($str);
		$str = Tratar::tiracento($str);
		$str = str_replace('"', '', $str);
		return $str;
	}
	
	public static function insert($postID, $taxonomy, $term)
	{
		//$term = Tratar::FormatText($term);
		
		$term_obj = get_term_by('name', $term, $taxonomy);
		
		if($term_obj === false)
		{
			PontosSettingsPage::log("Term: {$term}, não encontrado, tax: $taxonomy, Post: $postID<br/>");
			return;
		}
		
		if($postID > 0)
		{
			wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
		}
		else //Debug?
		{
			PontosSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
			PontosSettingsPage::log(" Term name: $term_obj->name<br/>");
		}
		
	}
	
	public static function tematico($postID,$taxonomy,$col1)
	{
		$col1 = Tratar::FormatText($col1);
	
		$rel = array(
				Tratar::FormatText("Cultura, Infância e Adolescência") => ("Cultura, Infância e Adolescência"),
				Tratar::FormatText("Cultura e Direitos Humans") => ("Cultura e Direitos Humans"),
				Tratar::FormatText("Conhecimento e Tradições Orais") => ("Conhecimento e Tradições Orais"),
				Tratar::FormatText("Cultura Digital") => ("Cultura Digital"),
				Tratar::FormatText("Escola Viva") => ("Escola Viva"),
				Tratar::FormatText("Interações Estéticas") => ("Interações Estéticas"),
				Tratar::FormatText("Economia Criativa e Solidária") => ("Economia Criativa e Solidária"),
				Tratar::FormatText("Leitura e Cidadania") => ("Leitura e Cidadania"),
				Tratar::FormatText("Educação Patrimonial") => ("Educação Patrimonial"),
				Tratar::FormatText("Grupos Itinerantes") => ("Grupos Itinerantes"),
				Tratar::FormatText("Cultura e Saúde") => ("Cultura e Saúde"),
				Tratar::FormatText("Mídia Livre") => ("Mídia Livre"),
				Tratar::FormatText("Cultura e Terceira Idade") => ("Cultura e Terceira Idade"),
				Tratar::FormatText("*") => (""),
				Tratar::FormatText("A dança e a capoeira são algumas das possibilidades de se trabalhar o movimento expressivo") => (""),
				Tratar::FormatText("Culturas Populares") => (""),
				Tratar::FormatText("DANÇA E TOQUE DE CACURIÁ, CAROÇO, COCO, BOI") => ("Conhecimento e Tradições Orais"),
				Tratar::FormatText("Difundindo, valorizando e pondo em prática o genero musical Choro e suas vertentes na música brasileira.") => (""),
				Tratar::FormatText("Infância e Adolescência") => (""),
				Tratar::FormatText("Orquestra") => (""),
				Tratar::FormatText("Realização de Oficinas de carater cultural") => (""),
				Tratar::FormatText("sim") => (""),
				Tratar::FormatText("Tradição sertaneja") => ("Conhecimento e Tradições Orais"),
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			$func = reset($rel[$col1]);
			Tratar::$func($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && trim($rel[$col1]) != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
	}
	
	public static function territorio($postID,$taxonomy,$col1, $uf_row = false)
	{
	
		$uf = $uf_row;
	
		$cidade = trim($col1);
		$cidade_slug = sanitize_title($cidade);
	
		if($uf !== false)
		{
			$uf_slug = sanitize_title($uf);
	
			$term_obj = get_term_by('slug', $uf_slug, $taxonomy);
				
			if($term_obj !== false)
			{
				if($postID > 0)
				{
					wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
				}
				else //Debug?
				{
					PontosSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
					PontosSettingsPage::log(" Term name: $term_obj->name<br/>");
				}
			}
			else 
			{
				PontosSettingsPage::log("Term: UF: {$uf_slug}, não encontrado, tax: $taxonomy, Post: $postID, cols: $col1, $col2<br/>");
				
			}
		}
	
		if(!empty($cidade_slug))
		{
			$term_obj = get_term_by('slug', $cidade_slug, $taxonomy);
				
			if($term_obj !== false)
			{
				if($postID > 0)
				{
					wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
				}
				else //Debug?
				{
					PontosSettingsPage::log("wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );");
					PontosSettingsPage::log(" Term name: $term_obj->name<br/>");
				}
			}
			else
				{
					PontosSettingsPage::log("Term: Cidade: {$cidade_slug}, não encontrada, tax: $taxonomy, Post: $postID, cols: $col1, $col2, cidade: $cidade, cidade_slug: $cidade_slug<br/>");
				}
		}	
	}	
}

?>