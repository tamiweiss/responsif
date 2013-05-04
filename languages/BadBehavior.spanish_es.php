<?php
/**********************************************************************************
* BadBehavior.english.php - PHP language file for Bad Behavior mod
* Version 1.5.11 by JMiller a/k/a butchs
* (http://www.eastcoastrollingthunder.com) 
*********************************************************************************
* This program is distributed in the hope that it is and will be useful, but
* WITHOUT ANY WARRANTIES; without even any implied warranty of MERCHANTABILITY
* or FITNESS FOR A PARTICULAR PURPOSE.
**********************************************************************************/

global $settings, $scripturl;

$txt['badbehavior_cversion_mod'] = '1.5.11';
$txt['badbehavior'] = 'Bad Behavior';
$txt['badbehavior_config'] = 'Panel de Administraci&oacute;n Bad Behavior';
$txt['badbehavior_admin'] = 'Administrar Bad Behavior';
$txt['badbehavior_admin_desc'] = 'Configurar y Administrar Bad Behavior';
$txt['badbehavior_settings_title'] = 'Configuraci&oacute;n';
$txt['badbehavior_settings_desc'] = 'Configurar el bloqueo autom&aacute;tico de spam en su web';
$txt['badbehavior_reports_desc'] = 'Examinar registros de spam bloqueado en su web';
$txt['badbehavior_about_title'] = 'Acerca de';
$txt['badbehavior_whitelist_title'] = 'Lista Blanca';
$txt['badbehavior_about_desc'] = 'Acerca de Bad Behavior';
$txt['badbehavior_version_c'] = 'Versi&oacute;n/Cr&eacute;ditos';
$txt['badbehavior_cversion'] = 'Versi&oacute;n SMF Port Modification';
$txt['badbehavior_coredesc'] = 'Bad Behavior consta de un n&uacute;cleo principal (Core Engine) y este Mod, que le permite trabajar en SMF. Sus respectivos autores son responsables de cada componente en particular.';
$txt['badbehavior_oview'] = 'El m&oacute;dulo Bad Behavior examina las solicitudes HTTP de los visitantes de su web y registra las solicitudes sospechosas para su revisi&oacute;n posterior. Las visitas sospechosas se muestran en el informe.';
$txt['badbehavior_minfo'] = 'Para m&aacute;s informaci&oacute;n, por favor visita <a href="http://www.bad-behavior.ioerror.us/">Bad Behavior</a>.';
$txt['badbehavior_msupport'] = 'Para apoyar al autor del Mod e inspirar futuras actualizaciones y mejoras.<br /><br /><a href="https://www.paypal.com/cgi-bin/webscr?cmd=_donations&business=UJTMMF8FKGLZ6&lc=US&item_name=butchs%2f%20continued%20updates&currency_code=USD&bn=PP%2dDonationsBF%3abtn_donateCC_LG%2egif%3aNonHosted"><img src="https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif" alt="PayPal - The safer, easier way to pay online!"></a>';
$txt['badbehavior_csupport'] = 'Para apoyar al autor del Core Engine, por favor considera hacer una donaci&oacute;n a fin de contribuir al desarrollo de Bad Behavior.';
$txt['badbehavior_stats_title'] = 'Estad&iacute;sticas';
$txt['badbehavior_logging_title'] = 'Registro';
$txt['badbehavior_security'] = 'Seguridad';
$txt['badbehavior_reverse_load'] = 'Proxy Inverso/Carga Equilibrada';
$txt['badbehavior_settings_sub'] = 'Configuraci&oacute;n de Bad Behavior';
$txt['enable_badbehavior'] = 'Activar Bad Behavior';
$txt['badbehavior_ooptions'] = 'SMF Sólo Opciones (no aprobado por autor del Core Engine)';
$txt['badbehavior_email_allow'] = 'Notificar al administrador cuando se elimina spam';
$txt['badbehavior_limitfirst'] = 'Limitar honeypot en el Foro';
$txt['badbehavior_email_allow_subtext'] = 'No Recomendado';
$txt['badbehavior_display_stats'] = 'Mostrar estad&iacute;sticas';
$txt['badbehavior_verbose'] = 'HTTP Detallado';
$txt['badbehavior_verbose_subtext'] = 'Registro DEBE estar habilitado';
$txt['badbehavior_logging'] = 'Registro';
$txt['badbehavior_logging_subtext'] = 'Recomendado';
$txt['badbehavior_strict'] = 'Control Estricto';
$txt['badbehavior_strict_subtext'] = 'No Recomendado';
$txt['badbehavior_offsite_forms'] = 'Formularios Externos';
$txt['badbehavior_eu_cookie'] = 'Administraci&oacute;n de cookies en la UE';
$txt['badbehavior_reverse_proxy'] = 'Activar Proxy Inverso';
$txt['badbehavior_reverse_proxy_header'] = 'Encabezado Proxy Inverso';
$txt['badbehavior_reverse_proxy_addresses'] = 'Direcci&oacute;n IP Proxy Inverso';
$txt['badbehavior_roundtripdns'] = 'Motor de B&uacute;squeda DNS';
$txt['badbehavior_cache_duration'] = 'Duraci&oacute;n Cach&eacute;';
$txt['badbehavior_core'] = ' Versi&oacute;n Core Engine Bad Behavior';
$txt['badbehavior_author'] = ' Autor Core:  <a href="http://www.bad-behavior.ioerror.us/">Michael Hampton</a>';
$txt['badbehavior_mauthor'] = 'Autor SMF Port Modification: <a href="http://www.eastcoastrollingthunder.com/">butchs</a>';
$txt['badbehavior_permitted'] = 'PERMITIDO';
$txt['badbehavior_denied'] = 'DENEGADO';
$txt['badbehavior_empty'] = 'No hay registros en ese rango';
$txt['badbehavior_log_title'] = 'Bad Behavior - Informes';
$txt['badbehavior_event_title'] = 'Bad Behavior - Detalles de eventos';
$txt['badbehavior_log_id'] = 'ID';
$txt['badbehavior_log_ip'] = 'IP';
$txt['badbehavior_log_date'] = 'FECHA';
$txt['badbehavior_log_method'] = 'M&Eacute;TODO';
$txt['badbehavior_log_uri'] = 'URI';
$txt['badbehavior_log_protocol'] = 'PROTOCOLO';
$txt['badbehavior_log_headers'] = 'CABECERAS';
$txt['badbehavior_log_agent'] = 'AGENTE';
$txt['badbehavior_log_enity'] = 'ENTIDAD';
$txt['badbehavior_log_key'] = 'CLAVE';
$txt['badbehavior_reason'] = ' RAZ&Oacute;N: ';
$txt['badbehavior_explain'] = 'EXPLICACI&Oacute;N: ';
$txt['badbehavior_error'] = 'ERROR: ';
$txt['badbehavior_report_all_title'] = 'TODAS las entradas';
$txt['badbehavior_report_permit_title'] = 'entradas PERMITIDAS';
$txt['badbehavior_report_denied_title'] = 'entradas DENEGADAS';
$txt['badbehavior_rec_disp'] = 'Mostrando registro(s)';
$txt['badbehavior_to'] = ' a ';
$txt['badbehavior_from'] = 'de ';
$txt['badbehavior_rec_tot'] = ' total ';
$txt['badbehavior_type_all'] = '(TODOS los registros).';
$txt['badbehavior_type_perm'] = '(solamente PERMITIDOS).';
$txt['badbehavior_type_den'] = '(solamente DENEGADOS).';
$txt['badbehavior_colin'] = ': ';
$txt['badbehavior_engines1'] = 'AltaVista';
$txt['badbehavior_engines2'] = 'Teoma/Ask Crawler';
$txt['badbehavior_engines3'] = 'Baidu';
$txt['badbehavior_engines4'] = 'Excite';
$txt['badbehavior_engines5'] = 'Google';
$txt['badbehavior_engines6'] = 'Looksmart';
$txt['badbehavior_engines7'] = 'Lycos';
$txt['badbehavior_engines8'] = 'MSN';
$txt['badbehavior_engines9'] = 'Yahoo';
$txt['badbehavior_engines10'] = 'Cull';
$txt['badbehavior_engines11'] = 'Infoseek';
$txt['badbehavior_engines12'] = 'Minor Search Engine';
$txt['badbehavior_search_engine'] = 'Motor de b&uacute;squeda ';
$txt['badbehavior_suspicious'] = 'Sospechoso';
$txt['badbehavior_harvester'] = 'Recolector';
$txt['badbehavior_comment_spammer'] = 'Spammer Comentador';
$txt['badbehavior_threat_level'] = 'Nivel de amenaza ';
$txt['badbehavior_age'] = 'Edad ';
$txt['badbehavior_days'] = ' d&iacute;as';
$txt['badbehavior_theadmin'] = 'el WEBMA5TER';
$txt['badbehavior_nospam'] = '+nospam@nospam.';
$txt['badbehavior_dot'] = '+nospam.nospam.';
$txt['badbehavior_dash'] = '+nospam-nospam.';
$txt['badbehavior_mailto'] = 'mailto:';
$txt['badbehavior_httpbl'] ='Project Honey Pot HTTP Blacklist';
$txt['badbehavior_httpbl_key'] ='Clave Acceso http:BL';
$txt['badbehavior_httpbl_threat'] ='Nivel de amenaza m&iacute;nimo';
$txt['badbehavior_httpbl_threat_subtext'] ='(25 es lo recomendado)';
$txt['badbehavior_httpbl_maxage'] ='N&uacute;mero de d&iacute;as m&aacute;ximo';
$txt['badbehavior_httpbl_maxage_subtext'] ='(30 es lo recomendado)';
$txt['badbehavior_httpbl_word'] ='Palabra de enlace Honeypot';
$txt['badbehavior_httpbl_link'] ='Ruta del enlace a Honeypot';
$txt['badbehavior_block_ua'] = 'Bloquear Agentes de Usuario en blanco';
$txt['badbehavior_httpBL_api'] = 'Debe introducir una clave de acceso http:BL v&aacute;lida, que contenga exactamente 12 caracteres alfab&eacute;ticos (no n&uacute;meros o s&iacute;mbolos). Deje el campo en blanco para deshabilitar esta funci&oacute;n.';
$txt['badbehavior_httpBL_link'] = 'Debe incorporar una ruta de enlace al Honeypot v&aacute;lida, o dejar el campo en blanco.';
$txt['badbehavior_httpBL_word'] = 'Introduzca solamente caracteres alfanum&eacute;ricos, guiones y espacios en la palabra de enlace Honeypot. (sin caracteres especiales ni s&iacute;mbolos).';
$txt['badbehavior_httpBL_threat'] = 'Debe introducir solamente un n&uacute;mero de 0 a 255 para el Nivel de amenaza.';
$txt['badbehavior_httpBL_maxage'] = 'Debe introducir solamente un n&uacute;mero de 1 a 60 para el N&uacute;mero de días m&aacute;ximo.';
$txt['badbehavior_log_timeformat'] = 'Formato horario usado en los registros';
$txt['badbehavior_log_24_hour_0'] = '24-horas';
$txt['badbehavior_log_12_hour_1'] = '12-horas';
$txt['badbehavior_httpBL_online'] = 'Project Honey Pot conectado.';
$txt['badbehavior_httpBL_offline'] = 'Project Honey Pot sin conexión!';
$txt['badbehavior_incorrect'] = 'Bad Behavior no est&aacute; instalado correctamente!';
$txt['badbehavior_ip'] = 'Direcci&oacute;n IP';
$txt['badbehavior_url'] = 'URL';
$txt['badbehavior_useragent'] = 'Agente de Usuario';
?>