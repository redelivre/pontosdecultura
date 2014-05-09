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
		$term_obj = get_term_by('name', $term, $taxonomy);
		
		if($term_obj === false)
		{
			echo "Term: {$term}, não encontrado, tax: $taxonomy, Post: $postID<br/>";
			return;
		}
		
		if($postID > 0)
		{
			wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
		}
		else //Debug?
		{
			echo "wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );";
			echo " Term name: $term_obj->name<br/>";
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
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && trim($rel[$col1]) != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
	}
	
	public static function identitario($postID,$taxonomy,$col1)
	{
		$col1 = Tratar::FormatText($col1);
	
		$rel = array(
				Tratar::FormatText("Culturas Populares") => "Culturas Populares",
				Tratar::FormatText("Grupos Artísticos e Culturais Independentes") => "Grupos Artísticos e Culturais Independentes",
				Tratar::FormatText("Infância e Adolescência") => "Infância e Adolescência",
				Tratar::FormatText("Juventude") => "Juventude",
				Tratar::FormatText("Culturas Afrobrasileiras") => "Culturas Afrobrasileiras",
				Tratar::FormatText("Povos e Comunidades Tradicionais") => "Povos e Comunidades Tradicionais",
				Tratar::FormatText("Grupos com Vulnerabilidade Extrema") => "Grupos com Vulnerabilidade Extrema",
				Tratar::FormatText("Culturas Indígenas") => "Culturas Indígenas",
				Tratar::FormatText("Mulheres") => "Mulheres",
				Tratar::FormatText("Pessoas com Deficiência") => "Pessoas com Deficiência",
				Tratar::FormatText("Pessoas em sofrimento psíquico") => "Pessoas em Sofrimento Psíquico",
				Tratar::FormatText("LGBT") => "LGBT",
				Tratar::FormatText("Idosos") => "Idosos",
				Tratar::FormatText("Apresentação de grupos folclóricos; palestras temáticas; oficina de dança popular;artesanato; música(pífano);teatro; informática; exibição de filmes e documentários.") => "Culturas Populares",
				Tratar::FormatText("Com a dança e a capoeira é possivel identificar uma pessoa ou um grupo") => "Culturas Afrobrasileiras",
				Tratar::FormatText("Curso de artesanato, informática, jornalismo comunitário, grafite, audiovisual.") => "Culturas Populares",
				Tratar::FormatText("Dança/Artesanato") => "Culturas Populares",
				Tratar::FormatText("Educação Musical") => "Culturas Populares",
				Tratar::FormatText("Ensinando instrumentos musicais que são próprios da linguagem do Choro e praticando a linguagem própria desse estilo musical") => "Culturas Populares",
				Tratar::FormatText("Escola livre de educação musical.") => "Culturas Populares",
				Tratar::FormatText("Oficinas de música.") => "Culturas Populares",
				Tratar::FormatText("O PROJETO CASA DO BRINCANTE É UMA INICIATIVA DE PRESERVAÇÃO DO PATRIMÔNIO IMATERIAL NO QUE SE REFERE À EXPRESSÃO CONGADA E SUAS VARIAÇÕES.") => "Culturas Populares",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => "Culturas Populares",
				Tratar::FormatText("RESGATE DA MEMÓRIA CULTURAL") => "Culturas Populares",
				Tratar::FormatText("sim") => "",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
	}
	
	public static function publicoalvo($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("estudantes") => "Estudantes",
				Tratar::FormatText("Infância e Adolescência") => "Infância e Adolescência",
				Tratar::FormatText("Juventude") => "Juventude",
				Tratar::FormatText("Público em geral") => "Público em Geral",
				Tratar::FormatText("Afro-Brasileiras") => "Afro-Brasileiras",
				Tratar::FormatText("Segmentos Populares") => "Segmentos Populares",
				Tratar::FormatText("Grupos Artísticos e Culturais Independentes") => "Grupos Artísticos e Culturais Independentes",
				Tratar::FormatText("idosos") => "Idosos",
				Tratar::FormatText("Outros") => "Outros",
				Tratar::FormatText("mulheres") => "Mulheres",
				Tratar::FormatText("Indígenas") => "Indígenas",
				Tratar::FormatText("Quilombolas") => "Quilombolas",
				Tratar::FormatText("Pessoas com deficiência") => "Pessoas com deficiência",
				Tratar::FormatText("LGBT") => "LGBT",
				Tratar::FormatText("Povos de Terreiro") => "Povos de Terreiro",
				Tratar::FormatText("População de Rua") => "População de Rua",
				Tratar::FormatText("Ribeirinhos") => "Ribeirinhos",
				Tratar::FormatText("Pescadores") => "Pescadores",
				Tratar::FormatText("População em regime prisional") => "População em regime prisional",
				Tratar::FormatText("Crianças") => "Infância e Adolescência",
				Tratar::FormatText("Imigrantes") => "Imigrantes",
				Tratar::FormatText("adolescentes") => "Infância e Adolescência",
				Tratar::FormatText("Adultos") => "Público em Geral",
				Tratar::FormatText("Pessoas em sofrimento psíquico") => "Pessoas em sofrimento psíquico",
				Tratar::FormatText("comunidade em geral") => "Público em Geral",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => "Público em Geral",
				Tratar::FormatText("adolescentes e adultos") => "Público em Geral",
				Tratar::FormatText("adolescentes e jovens em situação de vulnerabilidade") => "Infância e Adolescência",
				Tratar::FormatText("adolescentes na faixa de 15 a 17 anos") => "Infância e Adolescência",
				Tratar::FormatText("Artesanato e informática: adultos.") => "Público em Geral",
				Tratar::FormatText("Ciganas") => "Ciganas",
				Tratar::FormatText("comunidade") => "Público em Geral",
				Tratar::FormatText("crianças/adolescentes") => "Infância e Adolescência",
				Tratar::FormatText("Crianças a partir de 8 anos") => "Infância e Adolescência",
				Tratar::FormatText("CRIANÇAS DE 06 A 16 ANOS") => "Infância e Adolescência",
				Tratar::FormatText("crianças e adolescentes com a faixa etária de 7 a 14 anos") => "Infância e Adolescência",
				Tratar::FormatText("Dança") => "Público em Geral",
				Tratar::FormatText("Detentores de cohecimentos tradicionais detro do processo de continuidade de tradições em torno da congada.") => "Público em Geral",
				Tratar::FormatText("Filhos e parentes de dançantes integrantes de agremiações tradicionais de congada") => "Público em Geral",
				Tratar::FormatText("Integrantes das Agremiações carnavalescas de Ribeirão Preto") => "Público em Geral",
				Tratar::FormatText("jovens") => "Juventude",
				Tratar::FormatText("Jovens") => "Juventude",
				Tratar::FormatText("Moradores de comunidades que abrigam agremiações de congada") => "Público em Geral",
				Tratar::FormatText("Oficinas para fortalecimento da identidade cultural afro-brasileira.") => "Afro-Brasileiras",
				Tratar::FormatText("Participam diretamente das oficinas: Crianças, adolescentes jovens.") => "Juventude",
				Tratar::FormatText("participam indiretamente atraves de participação nas apresentações: comunidade em geral.") => "Público em Geral",
				Tratar::FormatText("PROFESSORES DO ENSINO FUNDAMENTAL") => "Público em Geral",
				Tratar::FormatText("PROFESSORES ENSINO MÉDIO") => "Público em Geral",
				Tratar::FormatText("40 crianças e adolescentes  na faixa etária de 06 a 14 anos") => "Infância e Adolescência",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function artescenicas($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("dança") => "Dança",
				Tratar::FormatText("Teatro") => "Teatro",
				Tratar::FormatText("Circo") => "Circo",
				Tratar::FormatText("Mímica") => "Mímica",
				Tratar::FormatText("Ópera") => "Ópera",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("capoeira") => "Dança",
				Tratar::FormatText("Desfiles de Animais") => "Circo",
				Tratar::FormatText("Exibição Cinematográfica") => array("Distribuição Cinematográfica" => "audiovisual"),
				Tratar::FormatText("música") => array("Música em Geral" => "musica"),
				Tratar::FormatText("MÚSICA") => array("Música em Geral" => "musica"),
				Tratar::FormatText("Oficina de Teatro") => "Teatro",
				Tratar::FormatText("OFICINA DE TRANSMISSÃO DE CONHECMENTOS EM DANÇAS TRADICIONAIS COM MESTRES DE CONGADA") => "Dança",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function audiovisual($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Multimídia") => "Multimídia",
				Tratar::FormatText("Difusão") => "Difusão",
				Tratar::FormatText("Formação/Pesquisa/Informação") => "Formação/Pesquisa/Informação",
				Tratar::FormatText("Eventos") => "Eventos",
				Tratar::FormatText("Exibição Cinematográfica") => "Exibição Cinematográfica",
				Tratar::FormatText("Infra-estrutura Técnica Audiovisual") => "Infra-estrutura Técnica Audiovisual",
				Tratar::FormatText("Videofonografia") => "Videofonografia",
				Tratar::FormatText("Produção Cinematográfica") => "Produção Cinematográfica",
				Tratar::FormatText("Preservação/Restauração da Memória Cinematográfica") => "Preservação/Restauração da Memória Cinematográfica",
				Tratar::FormatText("Produção Radiofônica") => "Produção Radiofônica",
				Tratar::FormatText("Distribuição Cinematográfica") => "Distribuição Cinematográfica",
				Tratar::FormatText("Rádios/Tvs Educativas") => "Rádios/Tvs Educativas",
				Tratar::FormatText("Produção Televisiva") => "Produção Televisiva",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("Música Popular") => array("Música Popular" => "musica"),
				Tratar::FormatText("Oficina de Percussão") => array("Música Instrumental" => "musica"),
				Tratar::FormatText("PRODUÇÃO DE UM DOCUMENTÁRIO SOBRE OS GRUPOS TRADICIONAIS E AS PRINCIPAIS FESTAS QUE ENVOLVEM AS CONGADAS EM MOGI DAS CRUZES") => "Produção Cinematográfica",
				Tratar::FormatText("PRODUÇÃO DE VÍDEO OFICINAS COM MESTRES DE CONGADA E MOÇAMBIQUE PARA A INTERNET.") => "Produção Cinematográfica",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function musica($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Música Popular") => "Música Popular",
				Tratar::FormatText("Música em Geral") => "Música em Geral",
				Tratar::FormatText("Música Instrumental") => "Música Instrumental",
				Tratar::FormatText("Orquestra") => "Orquestra",
				Tratar::FormatText("Música Erudita") => "Música Erudita",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("Atividades culturais que trabalham no contraturno escolar  de crianças e adolescentes e tambem atendem casos de terceira idade como terapia ocupacional, lazer,  socialização, etc..") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("Aulas de música e iniciação musical") => "Música em Geral",
				Tratar::FormatText("canto coral") => "Música em Geral",
				Tratar::FormatText("Canto e coral") => "Música em Geral",
				Tratar::FormatText("CULTURA POPULAR: CAROÇO, CACURIÁ, COCO E BOI") => array("Folclore" => "patrimoniocultural"),
				Tratar::FormatText("Dança") => array("Dança" => "artescenicas"),
				Tratar::FormatText("desenho artístico e graffite") => array("Plásticas" => "artesvisuais"),
				Tratar::FormatText("Disseminação Cultura Música") => "Música em Geral",
				Tratar::FormatText("Educação Musical") => "Música em Geral",
				Tratar::FormatText("Educação musical e aulas de instrumentos musicais para crianças, jovens , adultos e terceira idade.") => "Música em Geral",
				Tratar::FormatText("Ensino musical voltado para o choro como forma de resgate cultural na cidade de Mogi das Cruzes") => "Música em Geral",
				Tratar::FormatText("Eventos Musicais") => "Música em Geral",
				Tratar::FormatText("EXPOSIÇÃO CONGADA POPULAR BRASILEIRA COM PEÇAS DE GRUPOS TRADICIONAIS DE CONGADA, MARUJADA E MOÇAMBIQUE") => "Música em Geral",
				Tratar::FormatText("inclusão digital") => "Música em Geral",
				Tratar::FormatText("Musicalização Infantil") => "Música em Geral",
				Tratar::FormatText("OFICINA DE TRANSMISSÃO DE CONHECIMENTOS MUSICAIS: RÍTMOS DAS CONGADAS.") => "Música em Geral",
				Tratar::FormatText("oficina de violão") => "Música Instrumental",
				Tratar::FormatText("Teclado") => "Música Instrumental",
				Tratar::FormatText("Violão") => "Música Instrumental",
				Tratar::FormatText("violão/teclado/percussão") => "Música Instrumental",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function artesvisuais($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Exposição") => "Exposição",
				Tratar::FormatText("Exposição Itinerante") => "Exposição Itinerante",
				Tratar::FormatText("Fotografia") => "Fotografia",
				Tratar::FormatText("Cartazes") => "Cartazes",
				Tratar::FormatText("Plásticas") => "Plásticas",
				Tratar::FormatText("Gráficas") => "Gráficas",
				Tratar::FormatText("Gravura") => "Gravura",
				Tratar::FormatText("Filatelia") => "Filatelia",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("Artesanato") => array("Artesanato" => "patrimoniocultural"),
				Tratar::FormatText("Artes Integradas") => "",
				Tratar::FormatText("EXPOPSIÇÃO COM BANNERS 80X120cm MOSTRANDO A HISTÓRIA DE CADA AGREMIAÇÃO DO PROJETO CASA DO BRINCANTE") => "Exposição",
				Tratar::FormatText("EXPOSIÇÃO \"CONGADA POPULAR BRASILEIRA\" COM PEÇAS DE GRUPOS TRADICIONAIS DE CONGADA, MARUJADA E MOÇAMBIQUE") => "Exposição",
				Tratar::FormatText("Folclore") => array("Folclore" => "patrimoniocultural"),
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function patrimoniocultural($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Folclore") => "Folclore",
				Tratar::FormatText("Artesanato") => "Artesanato",
				Tratar::FormatText("Acervo") => "Acervo",
				Tratar::FormatText("Afro Brasileira") => "Afro Brasileira",
				Tratar::FormatText("Histórico") => "Histórico",
				Tratar::FormatText("Ecológico") => "Ecológico",
				Tratar::FormatText("Indígena") => "Indígena",
				Tratar::FormatText("Acervo Museológico") => "Acervo Museológico",
				Tratar::FormatText("Museu") => "Museu",
				Tratar::FormatText("Arquitetônico") => "Arquitetônico",
				Tratar::FormatText("Arqueológico") => "Arqueológico",
				Tratar::FormatText("Realização de Oficinas de carater cultural") => array("Oficinas, seminários, palestras, cursos, congressos, treinamentos" => "humanidades"),
				Tratar::FormatText("Capoeira") => "Afro Brasileira",
				Tratar::FormatText("Criação de nova geração de músicos chorões na cidade de Mogi das Cruzes.") => array("Música Popular" => "musica"),
				Tratar::FormatText("Edição de partituras originais de compositores de choro da cidade de Mogi das Cruzes.") => "Acervo",
				Tratar::FormatText("Incentivo à continuidade de tradições históricas da congada: Coroação do Rei do Congo") => "Folclore",
				Tratar::FormatText("Incentivo à continuidade de tradições individuais de grupos de congada: 08 agremiações e suas datas comemorativas") => "Folclore",
				Tratar::FormatText("Preservação de peças históricas de antigos dançantes: instrumentos tradicionais, adornos e vestimentas.") => "Acervo",
				Tratar::FormatText("RESGATE DA CULTURA POPULAR BRASILEIRA") => "Histórico",
				Tratar::FormatText("Valorização e resgate de chorões e cantores  da velha guarda") => "Histórico",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function humanidades($postID,$taxonomy,$col1,$col2=false,$col3=false)
	{
		$col1 = Tratar::FormatText($col1);
		$col2 = Tratar::FormatText($col2);
		$col3 = Tratar::FormatText($col3);
	
		$rel = array(
				Tratar::FormatText("Acervo Bibliográfico") => "Acervo Bibliográfico",
				Tratar::FormatText("Arquivo") => "Arquivo",
				Tratar::FormatText("Biblioteca") => "Biblioteca",
				Tratar::FormatText("História") => "História",
				Tratar::FormatText("Obras de Referência") => "Obras de Referência",
				Tratar::FormatText("Evento literário") => "Evento literário",
				Tratar::FormatText("Edição de Livros") => "Edição de Livros",
				Tratar::FormatText("Periódicos") => "Periódicos",
				Tratar::FormatText("Filosofia") => "Filosofia",
				Tratar::FormatText("Criação de atividades que fomentem público direcionado para esse estilo musical.") => "Oficinas, seminários, palestras, cursos, congressos, treinamentos",
				Tratar::FormatText("Educação musical  visando desenvolvimento interdisciplinar de alunos de ensino fundamental e  melhora da auto estima e socialização de alunos envolvidos com o projeto") => "Oficinas, seminários, palestras, cursos, congressos, treinamentos",
				Tratar::FormatText("Escolas") => "Biblioteca",
				Tratar::FormatText("Formatação de dossiês sobre dados da cultura e costumes que envolvem a congada e suas variações") => "Edição de Livros",
				Tratar::FormatText("Inglês") => "Acervo Bibliográfico",
				Tratar::FormatText("Pesquisa de campo sobre cultura afrodescendente em Mogi das Cruzes") => "",
				Tratar::FormatText("PRESERVAÇÃO DA CULTURA POPULAR: MODOS E COSTUMES") => "História",
				Tratar::FormatText("Skate") => "",
				Tratar::FormatText("Valorização e prática do choro por parte das novas gerações") => "História",
		);
		if(array_key_exists($col1, $rel) && is_array($rel[$col1]) && method_exists('Tratar', reset($rel[$col1])))
		{
			Tratar::{reset($rel[$col1])}($postID, reset($rel[$col1]), key($rel[$col1]));
		}
		elseif(array_key_exists($col1, $rel) && $rel[$col1] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col1]);
		}
		if(array_key_exists($col2, $rel) && is_array($rel[$col2]) && method_exists('Tratar', reset($rel[$col2])))
		{
			Tratar::{reset($rel[$col2])}($postID, reset($rel[$col2]), key($rel[$col2]));
		}
		elseif(array_key_exists($col2, $rel) && $rel[$col2] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col2]);
		}
		if(array_key_exists($col3, $rel) && is_array($rel[$col3]) && method_exists('Tratar', reset($rel[$col3])))
		{
			Tratar::{reset($rel[$col3])}($postID, reset($rel[$col3]), key($rel[$col3]));
		}
		elseif(array_key_exists($col3, $rel) && $rel[$col3] != "")
		{
			Tratar::insert($postID, $taxonomy, $rel[$col3]);
		}
	}
	
	public static function tipo($postID,$taxonomy,$col1)
	{
		if($col1 == 'Rede Intemunicipal')
		{
			$col1 = 'Rede Intermunicipal';
		}
		elseif($col1 == 'Ponto de Cultura  Indígena')
		{
			$col1 = 'Ponto de Cultura Indígena';
		}
		
		Tratar::insert($postID, $taxonomy, $col1);
	}
	
	public static function territorio($postID,$taxonomy,$col1,$col2 = false, $uf_row = false)
	{
		$str = $col1;
		if(empty($col1))
		{
			if(empty($col2))
			{
				echo "Território não encontrado: $col1, $col2";
				return;
			}
			else 
			{
				$str = $col2;
			}
		}
		
		$str = str_replace(")", "", $str);
		$cidadeuf = preg_split("/[(-\/]/", $str);
		
		if(count($cidadeuf) != 2 && $uf_row !== false)
		{
			$cidadeuf[] = $uf_row;
		}
		
		if(count($cidadeuf) != 2 && $col2 !== false)
		{
			$str = $col2;
			$str = str_replace(")", "", $str);
			$cidadeuf = preg_split("/[(-\/]/", $str);
			
			if(count($cidadeuf) != 2 && $uf_row !== false)
			{
				$cidadeuf[] = $uf_row;
			}
		}
		
		$uf = false;
		
		if(count($cidadeuf) > 1)
		{
			$uf = trim($cidadeuf[1]);
		}
		
		$cidade = trim($cidadeuf[0]);
		$cudade_slug = sanitize_title($cidade);
		
		if($uf !== false)
		{
			$uf_slug = sanitize_title($uf);
	
			$term_obj = get_term_by('slug', $uf_slug, $taxonomy);
			
			if($term_obj === false)
			{
				echo "Term: {$uf_slug}, não encontrado, tax: $taxonomy, Post: $postID<br/>";
				return;
			}
			
			if($postID > 0)
			{
				wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
			}
			else //Debug?
			{
				echo "wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );";
				echo " Term name: $term_obj->name<br/>";
			}
		}
		
		if(!empty($cudade_slug))
		{
			$term_obj = get_term_by('slug', $cudade_slug, $taxonomy);
			
			if($term_obj === false)
			{
				echo "Term: {$cudade_slug}, não encontrado, tax: $taxonomy, Post: $postID<br/>";
				return;
			}
			
			if($postID > 0)
			{
				wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );
			}
			else //Debug?
			{
				echo "wp_set_object_terms( $postID, intval($term_obj->term_id), $taxonomy, true );";
				echo " Term name: $term_obj->name<br/>";
			}
		}
		
	}
	
}

?>