<?php
/**
 * Boatable Technologies LLC
 *
 * @package   Boatable Technologies LLC
 * @author    Boatable Technologies LLC Core Team <info@openteknik.com>
 * @copyright (C) OpenTeknik LLC
 * @license   Boatable Technologies LLC License (OSSN LICENSE)  http://www.opensource-socialnetwork.org/licence
 * @link      https://www.opensource-socialnetwork.org/
 */
$ro = array(
    'groups' => 'Grupuri',
    'add:group' => 'Adauga un Grup',
    'requests' => 'Cereri',

    'members' => 'Membrii',
    'member:add:error' => 'Eroare! Incearca mai tarziu.',
    'member:added' => 'Cererea de membru a fost aprobata!',

    'member:request:deleted' => 'Nu puteti fi membru in acest grup!',
    'member:request:delete:fail' => 'Nu putem respinge cererea! Incearca mai tarziu.',
    'membership:cancel:succes' => 'Participarea la grup va este retrasa',
    'membership:cancel:fail' => 'Nu va putem retrage participarea la grup! Incearca mai tarziu.',

    'group:added' => 'Grupul a fost creat cu succes!',
    'group:add:fail' => 'Nu putem crea acest grup! Incearca mai tarziu.',

    'memebership:sent' => 'Cererea a fost trimisa!',
    'memebership:sent:fail' => 'Nu putem trimite cererea! Incearca mai tarziu.',

    'group:updated' => 'Grupul a fost actualizat!',
    'group:update:fail' => 'Grupul nu poate fii actualizat! Incearca mai tarziu.',

    'group:name' => 'Numele Grupului',
    'group:desc' => 'Descrierea Grupului',
    'privacy:group:public' => 'Grupul acesta poate fii vazut de toata lumea. Numai membrii pot posta in acest grup.',
    'privacy:group:close' => 'Toata lumea poate vedea acest grup. Numai membrii pot posta si vedea postarile.',

    'group:memb:remove' => 'Scoate din grup',
    'leave:group' => 'Paraseste Grupul',
    'join:group' => 'Adera la Grup',
    'total:members' => 'Totalul Membrilor',
    'group:members' => "Membrii (%s)",
    'view:all' => 'Vezi pe toti',
    'member:requests' => 'CERERI (%s)',
    'about:group' => 'Despre Grup',
    'cancel:membership' => ' Retrage participarea in grup',

    'no:requests' => 'Nu sant cereri',
    'approve' => 'Aproba',
    'decline' => 'Demite',
    'search:groups' => 'Cauta Grupuri',

    'close:group:notice' => 'Adera la acest Grup sa vezi postari,fotografii si comentarii.',
    'closed:group' => 'Grup inchis',
    'group:admin' => 'Administarator',
	
	'title:access:private:group' => 'Postare de Grup',

	// #186 group join request message var1 = user, var2 = name of group
	'ossn:notifications:group:joinrequest' => '%s a cerut sa adere la Grup %s',
	'ossn:group:by' => 'De:',
	
	'group:deleted' => 'Grupul si continutul a fost sters',
	'group:delete:fail' => 'Grupul nu a putut fii sters',	

	'group:delete:cover' => 'Sterge copertă',
	'group:delete:cover:error' => 'A apărut o eroare la ștergerea imaginii de copertă',
	'group:delete:cover:success' => 'Imaginea de copertă a fost ștearsă cu succes',
	
	//need translation
    'group:memb:make:owner' => 'Make group owner',
    'group:memb:make:owner:confirm' => 'Attention! This action will make >> %s << the new owner of the group and you will lose all of your group admin privileges. Are you sure to proceed?',
    'group:memb:make:owner:admin:confirm' => 'Attention! This action will make >> %s << the new owner of the group and the former owner will lose all of his group admin privileges. Are you sure to proceed?',		
);
ossn_register_languages('ro', $ro); 
