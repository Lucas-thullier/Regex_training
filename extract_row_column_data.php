<?php
// Récupération de la page web
$options_array = [
	CURLOPT_URL => "https://www.insee.fr/fr/statistiques/4487876?sommaire=4487854#tableau-FigMutR02_radio1",
	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_SSL_VERIFYPEER => 0,
	CURLOPT_SSL_VERIFYHOST => 2
	];
$curl = curl_init();
curl_setopt_array($curl, $options_array);
$exec = curl_exec($curl);
curl_close($curl);

// Transformation du html brut en document DOM
$dom = new DOMDocument();
@ $dom->loadHTML($exec);

// Positionnement au niveau de la table voulu
$table = $dom->getElementById("produit-tableau-FigMutR84_radio1");
$thead = $table->getElementsByTagName("thead")[0];
$tbody = $table->getElementsByTagName("tbody")[0];

// Initialisation du tableau qui contiendra les données finales
$day_years_data = array();

// Récupération et attribution de la clé-jours au tableau final
preg_match_all("#21-\w+#", $tbody->nodeValue, $rawdata);
foreach ($rawdata[0] as $key => $value) {
	$day_years_data[$value] = array();
}

// Récupération et attribution des clés années au tableau final
$rawdata = null;
preg_match_all("#\d{4}#", $thead->nodeValue, $rawdata);
foreach ($day_years_data as $key => $value) {
	foreach ($rawdata[0] as $key2 => $value2) {
		$day_years_data[$key] += [$value2 => null];
	}
}

// Récupération et attribution des valeurs de données au tableau final
$rawdata = null;
$tbody_content = preg_replace("#\s+#", " ", $tbody->nodeValue);
preg_match_all("#21-[a-z]+\s((\d+\s)+)#", $tbody_content, $rawdata);

foreach ($rawdata[1] as $key => $value) {
	preg_match_all("#\d{3}#", $value, $tri_dimensional_data_array[$key]);
}
$compteur = 0;
$compteur2 = 0;
foreach ($day_years_data as $key => $value) {
	foreach ($day_years_data[$key] as $key2 => $value2) {
		$day_years_data[$key][$key2] = $tri_dimensional_data_array[$compteur][0][$compteur2];
		$compteur2++;
	}
	$compteur2=0;
	$compteur++;
}
var_dump($day_years_data);