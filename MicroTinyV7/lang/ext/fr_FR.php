<?php
$lang['admindescription'] = 'Met à jour l\'éditeur MicroTiny de base vers TinyMCE v7. Fournit une expérience d\'édition moderne et complète avec une intégration avancée pour les liens et les fichiers de CMSMS.';
$lang['browse'] = 'Parcourir';
$lang['cancel'] = 'Annuler';
$lang['class'] = 'Classe';
$lang['cmsms_linker'] = 'Lien vers une page CMSMS';
$lang['css_styles_help'] = 'Les styles CSS mentionnés ici seront ajoutés à une boite de sélection déroulante dans l\'éditeur. Laisser le champ de saisie vide ne permettra pas l\'apparition de la boîte déroulante (par défaut).';
$lang['css_styles_help2'] = 'Les styles peuvent être simplement le nom de la classe, ou une classe avec un nouveau nom à afficher.
Ils doivent être séparés soit par des virgules soit par des sauts de ligne.
<br>Exemple : monstyle1, Mon nom de style=monstyle2
<br>Résultat : une boite de sélection avec 2 entrées, \'monstyle1\' et \'Mon nom de style\' résultant de l\'insertion de monstyle1, et monstyle2 respectivement.
<br>Note : il n\'y a PAS de vérification de l\'existence effective des styles. Ils sont utilisés sans contrôle.';
$lang['css_styles_text'] = 'Styles CSS&nbsp;';
$lang['description'] = 'Description&nbsp;';
$lang['dimensions'] = 'L x H';
$lang['dimension'] = 'Dimensions';
$lang['dirinfo'] = 'Changer ce dossier de travail par&nbsp;';
$lang['edit_image'] = 'Éditer image';
$lang['edit_profile'] = 'Éditer le profil&nbsp;';
$lang['error_cantchangesysprofilename'] = 'Vous ne pouvez pas changer le nom d\'un profil du système';
$lang['error_missingparam'] = 'Un paramètre requis était manquant';
$lang['error_nopage'] = 'Aucune page alias sélectionnée';
$lang['example'] = 'Exemple éditeur MicroTiny';
$lang['filepickertitle'] = 'Fichiers CMSMS';
$lang['friendlyname'] = 'Éditeur WYSIWYG MicroTinyV7';
$lang['fileview'] = 'Vue fichiers&nbsp;';
$lang['filename'] = 'Nom des fichiers';
$lang['filterby'] = 'Filtrer par&nbsp;';
$lang['height'] = 'Hauteur';
$lang['help'] = <<<EOT
<h3>À quoi sert ce module ?</h3>
<p><strong>MicroTinyV7</strong> est un remplacement moderne et puissant pour le module MicroTiny de base. Il met à jour l'éditeur vers la dernière version stable de <a href="https://www.tiny.cloud" target="_blank">TinyMCE</a>, offrant une expérience d'édition WYSIWYG complète et riche en fonctionnalités pour la gestion de contenu dans CMS Made Simple.</p>
<p>Il s'intègre parfaitement avec les blocs de contenu des pages, les formulaires d'administration des modules, et supporte l'édition en frontend, offrant significativement plus de puissance et une meilleure expérience utilisateur que l'éditeur original.</p>
<p>Pour utiliser MicroTinyV7, vous devez le sélectionner comme votre éditeur WYSIWYG dans vos préférences utilisateur. Veuillez vous rendre dans "Mes Préférences > Préférences Utilisateur" et choisir "MicroTinyV7" dans le menu déroulant "Éditeur WYSIWYG à utiliser".</p>

<h3>Fonctionnalités améliorées</h3>
<p>Ce module n'est pas une simple mise à jour de version ; c'est une refonte complète de l'expérience d'édition avec une intégration profonde dans l'écosystème CMSMS :</p>
<ul>
  <li><strong>Dernier moteur TinyMCE v7 :</strong> Profitez d'une interface utilisateur moderne, de performances améliorées, et d'une API stable et puissante.</li>
  <li><strong>Sélecteur de liens CMSMS avancé :</strong> Un outil de création de liens internes entièrement réécrit avec une recherche de pages en direct et asynchrone pendant que vous tapez, ainsi qu'un processus d'édition intelligent.</li>
  <li><strong>Intégration complète du FilePicker :</strong> Utilise de manière transparente le module officiel FilePicker de CMSMS, incluant la navigation dans les répertoires et l'upload de fichiers, avec une résolution correcte des chemins d'URL.</li>
  <li><strong>Plugin Mailto professionnel :</strong> Un outil puissant pour créer et éditer les balises Smarty <code>{mailto}</code>. Il utilise des "placeholders" visuels dans l'éditeur (ex: 📧 email@adresse.com) qui sont convertis en balises Smarty pures à la sauvegarde, et inversement au chargement. La boîte de dialogue supporte tous les paramètres, y compris le sujet, cc, cci, le corps du message et l'encodage.</li>
  <li><strong>Style d'éditeur personnalisé :</strong> Une feuille de style dédiée est chargée dans l'éditeur pour styliser les éléments personnalisés comme les placeholders mailto, offrant une véritable sensation WYSIWYG.</li>
  <li><strong>Profils personnalisables :</strong> Conserve la capacité de configurer des profils distincts pour les éditeurs en Administration et en frontend.</li>
</ul>

<h3>Comment l'utiliser ?</h3>
  <ul>
    <li>Installez le module depuis le Gestionnaire de modules.</li>
    <li>Sélectionnez MicroTinyV7 comme votre éditeur WYSIWYG de choix dans "Mes Préférences > Préférences Utilisateur".</li>
    <li>(Optionnel) Personnalisez les profils Admin et Frontend sous "Extensions > MicroTinyV7".</li>
  </ul>

<h3>À propos de l'HTML, de TinyMCE, et de l'édition de contenu</h3>
  <ul>
    <li><strong>Environnement WYSIWYG :</strong>
       <p>Cet éditeur fournit un environnement de haute fidélité qui correspond étroitement au rendu final sur votre site web. Cependant, des différences peuvent toujours survenir en raison de feuilles de style complexes spécifiques au site ou de structures HTML avancées non représentées dans les menus de l'éditeur.</p>
    </li>

    <li><strong>Édition de contenu, pas conception de site :</strong>
      <p>Comme pour tout CMS, l'éditeur WYSIWYG est destiné à la gestion de contenu dans des zones prédéfinies de vos gabarits. C'est un outil puissant pour les éditeurs de contenu, pas un outil de conception de site web. La mise en page et le design complexes doivent être gérés dans les gabarits et les feuilles de style de votre site.</p>
    </li>

    <li><strong>Balises Smarty dans le contenu :</strong>
      <p>Bien que cet éditeur soit plus robuste, il est toujours recommandé d'éviter de mélanger de la logique Smarty complexe directement dans les zones de contenu WYSIWYG. Pour les pages nécessitant une logique Smarty importante, envisagez d'utiliser des blocs de contenu non-WYSIWYG et de restreindre l'accès en édition à des utilisateurs avertis.</p>
      <p>Le plugin Mailto personnalisé est une exception, car il est spécifiquement conçu pour gérer la balise <code>{mailto}</code> de manière conviviale.</p>
    </li>
  </ul>

<h3>À propos des images et des médias</h3>
  <p>Ce module s'intègre avec le module officiel <strong>FilePicker</strong> de CMSMS. Lorsque vous cliquez sur l'icône "Parcourir" dans les boîtes de dialogue Image ou Média, il ouvrira le FilePicker complet, vous permettant de naviguer, d'uploader et de sélectionner des fichiers. Cela offre une expérience beaucoup plus puissante et cohérente que le navigateur de fichiers original de MicroTiny.</p>

<h3>FAQ :</h3>
  <dl>
    <dt>Q : Comment puis-je ajouter d'autres plugins ou boutons à la barre d'outils ?</dt>
      <dd>R : Les barres d'outils et les plugins disponibles peuvent être configurés en modifiant les profils Admin et Frontend sous "Extensions > MicroTinyV7". Vous pouvez activer ou désactiver de nombreux plugins standards de TinyMCE et agencer les boutons pour répondre à vos besoins.</dd>
    <br/>
    <dt>Q : Je n'arrive pas à faire fonctionner l'éditeur MicroTinyV7 dans l'interface d'administration. Que puis-je faire ?</dt>
      <dd>R : Veuillez vérifier les points suivants :
        <ol>
          <li>Vérifiez le journal d'administration de CMSMS, le journal d'erreurs PHP de votre serveur, et la console JavaScript de votre navigateur pour des erreurs.</li>
          <li>Assurez-vous que MicroTinyV7 est sélectionné comme "Éditeur WYSIWYG à utiliser" dans vos préférences utilisateur.</li>
          <li>Vérifiez que le WYSIWYG n'est pas désactivé pour le bloc de contenu spécifique dans le gabarit de la page (ex: <code>{content wysiwyg=false}</code>).</li>
        </ol>
      </dd>
    <br/>
    <dt>Q : Comment insérer un saut de ligne (<code><br/></code>) au lieu d'un nouveau paragraphe ?</dt>
      <dd>R : Appuyez sur [Maj]+[Entrée] au lieu de simplement la touche [Entrée].</dd>
  </dl>

<h3>Cache :</h3>
  <p>Pour améliorer les performances, MicroTinyV7 génère et met en cache son fichier de configuration JavaScript. Ce cache est automatiquement rafraîchi lorsque les paramètres changent. Cette fonctionnalité peut être désactivée à des fins de débogage en ajoutant <code>\$config["mt_disable_cache"] = true;</code> à votre fichier config.php.</p>

<h3>Voir aussi :</h3>
<ul>
  <li>Les balises <code>{content}</code> et <code>{cms_textarea}</code> dans la section d'aide "Extensions > Balises".</li>
  <li>La <a href="https://www.tiny.cloud/docs/tinymce/7/" target="_blank">Documentation officielle de TinyMCE</a> pour plus d'informations sur l'éditeur lui-même.</li>
</ul>
EOT;
$lang['image'] = 'Image&nbsp;';
$lang['info_linker_autocomplete'] = 'Commencez par taper quelques caractères de la page alias, texte du menu ou titre désiré. Tous les noms correspondants seront affichés dans une liste.';
$lang['loading_info'] = 'Chargement ...';
$lang['mailto_image'] = 'Créer une image email';
$lang['mailto_text'] = 'Insérer/Modifier un lien email';
$lang['mailto_title'] = 'Insérer/Modifier un lien email';
$lang['msg_cancelled'] = 'Opération annulée';
$lang['mthelp_allowcssoverride'] = 'Si activé, spécifiera le nom d\'une feuille de style à utiliser (pour le WYSIWYG MicroTiny ) à la place de la feuille de style par défaut indiqué ci-dessus';
$lang['mthelp_dfltstylesheet'] = 'Associer une feuille de style avec l\'éditeur utilisant ce profil. Permet au contenu de l\'éditeur WYSIWYG d\'avoir un rendu proche de l\'aspect du site.';
$lang['mthelp_profileallowimages'] = 'Laisser l\'éditeur intégrer des images et des vidéos dans la zone de texte. Avec certains gabarits, les éditeurs de contenu peuvent ne pas être en mesure de sélectionner des images ou vidéos pour les zones spécifiques d\'une page Web';
$lang['mthelp_profileallowtables'] = 'Laisser l\'éditeur intégrer et manipuler les tableaux. Remarque : ne devrait pas être utilisé pour contrôler la mise en page, mais uniquement pour les données organisées sous forme de tableaux.';
$lang['mthelp_profilelabel'] = 'Une description de ce profil. La description ne peut être modifiée pour des profils système.';
$lang['mthelp_profilename'] = 'Le nom de ce profil. Le nom des profils système ne peut pas être modifié.';
$lang['mthelp_profilemenubar'] = 'Indique si la barre de menu doit être activée dans les profils visibles. La barre de menus a généralement plus d\'options que la barre d\'outils.';
$lang['mthelp_profilestatusbar'] = 'Cette sélection indique si la barre d\'état au bas de la zone WYSIWYG doit être activée. La barre d\'état affiche des informations importantes pour les éditeurs avancés, ainsi que d\'autres informations utiles.';
$lang['mthelp_profileresize'] = 'Cette sélection indique si la zone WYSIWYG peut être redimensionnée. Pour pouvoir redimensionner la barre d\'état doit être activée.';
$lang['newwindow'] = 'Nouvelle fenêtre';
$lang['none'] = 'Aucun';
$lang['ok'] = 'OK&nbsp;';
$lang['prompt_linker'] = 'Entrer le titre de la page';
$lang['prompt_linktext'] = 'Texte du lien';
$lang['prompt_profiles'] = 'Profils utilisateurs';
$lang['prompt_selectedalias'] = 'Alias de page sélectionné';
$lang['profiledesc___admin__'] = 'Ce profil est utilisé par tous les utilisateurs autorisés qui ont choisi d\'utiliser cet éditeur';
$lang['profiledesc___frontend__'] = 'Ce profil est utilisé pour l\'éditeur WYSIWYG autorisé sur site Web (Frontend)';
$lang['profile_admin'] = 'Utilisateurs de l’administration';
$lang['profile_allowcssoverride'] = 'Permettre aux blocs de passer outre la feuille de style sélectionnée&nbsp;';
$lang['profile_allowimages'] = 'Autoriser les images&nbsp;';
$lang['profile_allowresize'] = 'Autoriser le redimensionnement&nbsp;';
$lang['profile_allowtables'] = 'Autoriser les tableaux&nbsp;';
$lang['profile_dfltstylesheet'] = 'Feuille de style pour l\'éditeur&nbsp;';
$lang['profile_frontend'] = 'Utilisateurs sur le site Web (Frontend)';
$lang['profile_label'] = 'Label&nbsp;';
$lang['profile_name'] = 'Nom du Profil&nbsp;';
$lang['profile_menubar'] = 'Affiche une barre de menu&nbsp;';
$lang['profile_showstatusbar'] = 'Affiche une barre d\'état&nbsp;';
$lang['prompt_name'] = 'Nom&nbsp;';
$lang['prompt_target'] = 'Cible';
$lang['prompt_class'] = 'Attribut de classe';
$lang['prompt_email'] = 'Adresse email';
$lang['prompt_insertmailto'] = 'Insérer/Modifier un lien email';
$lang['prompt_anchortext'] = 'Texte à afficher';
$lang['prompt_rel'] = 'Attribut rel (type de relation)';
$lang['prompt_texttodisplay'] = 'Texte à afficher';
$lang['savesettings'] = 'Sauvegarder les ajustements';
$lang['settings'] = 'Paramètres';
$lang['settingssaved'] = 'Ajustements sauvegardés';
$lang['size'] = 'Taille';
$lang['submit'] = 'Soumettre';
$lang['switchgrid'] = 'Basculer l\'affichage en grille';
$lang['switchlist'] = 'Basculer l\'affichage en liste';
$lang['switchimage'] = 'Montrer les fichiers image';
$lang['switchvideo'] = 'Montrer les fichiers vidéo';
$lang['switchaudio'] = 'Montrer les fichiers audio';
$lang['switcharchive'] = 'Montrer les fichiers archive';
$lang['switchfiles'] = 'Montrer les fichiers';
$lang['switchreset'] = 'Montrer tous les fichiers';
$lang['tooltip_selectedalias'] = 'Ce champ est en lecture seule';
$lang['title_cmsms_linker'] = 'Créer un lien vers une page de contenu CMSMS';
$lang['title_cmsms_filebrowser'] = 'Sélectionner un fichier';
$lang['title_edit_profile'] = 'Éditer le profil';
$lang['tmpnotwritable'] = 'La configuration n\'a pas pu être sauvegardée dans le dossier tmp ! Merci de corriger !';
$lang['tab_general_title'] = 'Général';
$lang['tab_advanced_title'] = 'Avancé';
$lang['type'] = 'Type&nbsp;';
$lang['usestaticconfig_help'] = 'Génère un fichier de configuration statique. Fonctionnera mieux sur certains serveurs (par exemple lors de l\'exécution de PHP avec CGI)';
$lang['usestaticconfig_text'] = 'Utiliser le fichier de configuration statique&nbsp;';
$lang['width'] = 'Largeur';
$lang['view_source'] = 'Vue source HTML';
$lang['youareintext'] = 'Dossier actuel&nbsp;';
?>