<?php
const VNEXPRESS_RSS_FEED_SPORT = 'https://vnexpress.net/rss/tin-moi-nhat.rss';

function parse_rss_feed($title, $description, $pubDate, $generator, $link, $items) {

    return array(
        'title' => $title,
        'description' => $description,
        'pubDate' => $pubDate,
        'link' => $link,
        'generator' => $generator,
        'items' => $items
    );

}

function fetch_rss_feed($uri) {
    $content = file_get_contents($uri);
    $xml_root = simplexml_load_string($content);
//    var_dump($xml_document);
    $xml = $xml_root->channel[0];
    $items = [];
//    echo count($xml->item);
    foreach($xml->item as $item)

        array_push($items, array(
            'title' => $item->title,
            'description' => $item->description,
            'pubDate' => $item->pubDate,
            'link' => $item->link,
            'guid' => $item->guid,
        ));
    return parse_rss_feed($xml->title, $xml->description, $xml->pubDate, $xml->generator, $xml->link, $items);
}
$feeds = fetch_rss_feed(VNEXPRESS_RSS_FEED_SPORT);
//foreach($feeds as $key => $v){
//    echo $key;
//    if($key == 'items'){
//        foreach($v as $item) {
//            echo $item['title'], $item['description'], $item['pubDate'], $item['link'], $item['guid'], "\n";
//        }
//    }
//}

$feeds_to_json = json_encode($feeds);

echo $feeds_to_json;
