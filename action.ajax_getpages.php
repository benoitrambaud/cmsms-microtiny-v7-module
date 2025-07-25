<?php
#CMS - CMS Made Simple
#(c)2004 by Ted Kulp (ted@cmsmadesimple.org)
#Visit our homepage at: http://www.cmsmadesimple.org

if (!isset($gCms)) exit;
if (!check_login(FALSE)) exit; // admin only.... but any admin

// Nettoyer le tampon de sortie et définir l'en-tête au début
if (ob_get_level() > 0) ob_clean();
header('Content-Type: application/json; charset=utf-8');

// Initialiser la variable de sortie comme un tableau vide pour garantir une réponse JSON valide
$output = [];

// Récupérer et nettoyer les paramètres
$term = trim(strip_tags(get_parameter_value($_REQUEST, 'term')));
$alias = trim(strip_tags(get_parameter_value($_REQUEST, 'alias')));

if ($alias) {
    // --- Recherche par alias (pour pré-remplir le formulaire d'édition) ---
    $query = 'SELECT content_name, content_alias, id_hierarchy FROM ' . CMS_DB_PREFIX . 'content
              WHERE content_alias = ? AND active = 1';
    $row = $db->GetRow($query, [$alias]);
    
    if ($row) {
        // Un alias est unique, on renvoie un seul objet
        $output = [
            'label' => "{$row['content_name']} ({$row['id_hierarchy']})",
            'value' => $row['content_alias']
        ];
    }
    // Si $row est faux, $output reste un tableau vide, ce qui est OK.

} else if ($term) {
    // --- Recherche par terme (pour l'autocomplétion) ---
    $searchTerm = "%{$term}%";
    $query = 'SELECT content_name, content_alias, id_hierarchy FROM ' . CMS_DB_PREFIX . 'content
              WHERE (content_name LIKE ? OR menu_text LIKE ? OR content_alias LIKE ?)
              AND active = 1
              ORDER BY default_content DESC, hierarchy ASC';
    $rows = $db->GetArray($query, [$searchTerm, $searchTerm, $searchTerm]);

    if (is_array($rows) && count($rows) > 0) {
        foreach ($rows as $row) {
            $output[] = [
                'label' => "{$row['content_name']} ({$row['id_hierarchy']})",
                'value' => $row['content_alias']
            ];
        }
    }
    // Si $rows est vide, $output reste un tableau vide, ce qui est OK.
}

// Toujours encoder et afficher la sortie, puis quitter.
// Si rien n'a été trouvé, cela affichera "[]" (un tableau JSON vide valide).
echo json_encode($output);
exit;

#
# EOF
#
?>