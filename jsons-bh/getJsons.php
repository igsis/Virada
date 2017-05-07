<?php
date_default_timezone_set('America/Sao_Paulo');

require __DIR__ . '/MapasSDK/vendor/autoload.php';
require __DIR__ . '/api-config.php.template';

use MapasSDK as sdk;

$mapas = new MapasSDK\MapasSDK(MAPAS_URL, API_PUBLIC_KEY, API_PRIVATE_KEY);

$mapas->debugRequest = SDK_DEBUG_REQUEST;
$mapas->debugResponse = SDK_DEBUG_RESPONSE;

$project_id = PROJECT_ID;

$date_from = DATE_FROM;
$date_to = DATE_TO;

$project_ids = $mapas->getChildrenIds('project', PROJECT_ID, true);

echo "\nbaixando eventos...";
$events = $mapas->findEntities(
        'event',
        'id,name,subTitle,shortDescription,description,classificacaoEtaria,terms,traducaoLibras,descricaoSonora,project.id,project.name,project.singleUrl',
        [
            '@files' => '(avatar.viradaSmall,avatar.viradaBig):url',
            'project' => sdk\IN($project_ids),
            '@permissions' => 'view'
        ]);

$events_by_id = array();

$event_ids = [];

foreach ($events as $e) {
    $events_by_id[$e->id] = $e;
    $event_ids[] = $e->id;
}

$result_events = array();

$spaces = [];
$space_ids = [];
if($event_ids){

    //"eventOccurrence/find?@select=id,space.id,eventId,rule&event=IN($event_ids)&@order=_startsAt"
    $occurrences = $mapas->findEntities(
            'eventOccurrence',
            'id,space.id,eventId,rule,space.id',
            [
                'event' => sdk\IN($event_ids),
                '@order' => '_startsAt',
                '@permissions' => 'view'
            ]);

    $space_ids = [];

    $count = 0;
    foreach ($occurrences as $occ) {
        $rule = $occ->rule;
        $e = clone $events_by_id[$occ->eventId];
        $e->id = $occ->id;
        $e->eventId =  $occ->eventId;

        if(!in_array($occ->space->id, $space_ids)){
            $space_ids[] = $occ->space->id;
        }

        $e->spaceId = $occ->space->id;
        $e->startsAt = $rule->startsAt;
        $e->startsOn = $rule->startsOn;

        $datetime = new DateTime("{$rule->startsOn} {$rule->startsAt}");

        $e->price = $rule->price;

        $e->timestamp = $datetime->getTimestamp();

        $e->duration = @$rule->duration;

        if($e->duration == 1440){
            $e->duration = '24h00';
        }

        $e->acessibilidade = array();
        if($e->traducaoLibras == 'Sim')
            $e->acessibilidade[] = 'Tradução para LIBRAS';

        if($e->descricaoSonora == 'Sim')
            $e->acessibilidade[] = 'Descrição sonora';


        $small_image_property = '@files:avatar.viradaSmall';
        $big_image_property = '@files:avatar.viradaBig';

        if (property_exists($e, $small_image_property)) {
            $e->defaultImage = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$big_image_property->url);
            $e->defaultImageThumb = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$small_image_property->url);
            $e->image768 = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$small_image_property->url);
            $e->image800 = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$big_image_property->url);
            $e->image1024 = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$big_image_property->url);
            $e->image1280 = str_replace(REPLACE_IMAGES_URL_FROM, REPLACE_IMAGES_URL_TO, $e->$big_image_property->url);
        } else {
            $e->defaultImage = '';
            $e->defaultImageThumb = '';
        }

        $result_events[] = $e;
    }

    if($space_ids){
        echo "\nbaixando espaços...";
        $spaces = $mapas->findEntities(
            'space',
            'id,name,shortDescription,endereco,location',
            [
                '@files' => '(avatar.viradaSmall,avatar.viradaBig):url',
                '@order' => 'name',
                '@permissions' => 'view',
                'id' => sdk\IN($space_ids)
            ]);
    }

}

file_put_contents(__DIR__ . '/events.json', json_encode($result_events));
file_put_contents(__DIR__ . '/spaces.json', json_encode($spaces));
