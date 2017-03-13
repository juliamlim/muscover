<?php
class Gracenote {
    
    private $clientId, $clientTag, $userId, $apiUrl;
    private $replaceValue;
    private $replaceString = ['[clientId]','[clientTag]','[userId]'];
    
    public function __construct($clientId, $clientTag, $userId) {
        $this->clientId = $clientId;
        $this->clientTag = $clientTag;
        $this->userId = $userId;
        
        $this->replaceValue = [ $this->clientId, $this->clientTag, $this->userId ];
    }
    private function getUrl($url){
        $this->apiUrl = str_replace($this->replaceString,$this->replaceValue, $url);
        
        return $this->apiUrl;
    }
    public function getGenres() {
        $url = "https://c[clientId].web.cddbp.net/webapi/xml/1.0/radio/fieldvalues?client=[clientId]-[clientTag]&user=[userId]&fieldname=radiogenre";
        
        $genreUrl = $this->getUrl($url);
        $xml = simplexml_load_file($genreUrl); //retrieve URL and parse XML content
        
        //$genres = $xml->xpath('/RESPONSES/RESPONSE/GENRE');
        
/*      25982 => "Latin" ('radio' => '')
        36060 => Blues" ('radio' => '')
        36061 => "Classical" ('radio' => '')
        25984 => "World" ('radio' => '')
        36055 => "Electronica" ('radio' => 'a9d1cad2a0ded7f0ac9865ef377acff7')
        36059 => "Country & Western" ('radio' => '')
        36064 => "Comedy, Spoken & Other" ('radio' => '')
        25978 => "Traditional Pop" ('radio' => '')
        25971 => "Folk" ('radio' => '')
        36051 => "Punk" ('radio' => '6aee8bf236783ba3f7d64a16d18318de')
        36062 => "New Age" ('radio' => 'ccd54819d86c77a0475a11120626b0df')
        25964 => "Rock" ('radio' => 'e6112d309cfc47e8f2395948eaf8dbfe')
        36057 => "Soul/R&B" ('radio' => '5f9d5af11e4cd09fde0327c09f421268')
        36063 => "Soundtrack" ('radio' => '')
        36065 => "Reggae" ('radio' => '')
        25976 => "Gospel & Christian ('radio' => '')
        25980 => "Children's ('radio' => '')
        25961 => "Alternative" ('radio' => '')
        36053 => "Metal" ('radio' => '852189ac6f4d16876b5b11a52754b03a')
        36058 => "Rap/Hip-Hop" ('radio' => 'f3ce9e60afeb8b35e64a9b0bfbf76249')
        36056 => "Pop" ('radio' => '83f2b16864f653f738e88114dc2b5ce0')
        36054 => "Dance & House" ('radio' => '')
        25965 => "Oldies" ('radio' => '')
        25974 => "Jazz" ('radio' => 'c320a5ed280ed3d79a9573d7b5c1d729')
        36052 => "Indie" ('radio' => 'a5709a7dbfa0e075e8e4374a9f65c989')         */
        
        $genres = [
            [36052, 'Indie','a5709a7dbfa0e075e8e4374a9f65c989'],
            [36056,'Pop','83f2b16864f653f738e88114dc2b5ce0'],
            [36058,'Hip-Hop','f3ce9e60afeb8b35e64a9b0bfbf76249'],
            [25964,'Rock','e6112d309cfc47e8f2395948eaf8dbfe'],
            [36057,'Soul','5f9d5af11e4cd09fde0327c09f421268'],
            [36051,'Punk','6aee8bf236783ba3f7d64a16d18318de'],
            [36055,'Electronic','a9d1cad2a0ded7f0ac9865ef377acff7'],
            [25974,'Jazz','c320a5ed280ed3d79a9573d7b5c1d729']
        ];
        
        return $genres;
    }
    
    public function getMoods($radio){
        $url = "https://c[clientId].web.cddbp.net/webapi/xml/1.0/radio/lookahead?client=[clientId]-[clientTag]&user=[userId]&radio_id=[radioId]&return_profile=mood";        
        
        $this->replaceString[] = '[radioId]';
        $this->replaceValue[] = $radio;
        
        $moodsUrl = $this->getUrl($url);
        $xml = simplexml_load_file($moodsUrl);
        
        $moods = [];
        
        foreach($xml->RESPONSE->RADIO->RADIOPROFILE->PROFILEITEM as $mood) {
            $moods[] = ['id'=> $mood->MOOD->attributes()->ID,'mood'=>$mood->MOOD,'value'=>intval($mood->VALUE)];
        }
        function build_sorter($key) {
            return function ($a, $b) use ($key) {
                return strnatcmp($b[$key],$a[$key]);
            };
        }
        usort($moods, build_sorter('value'));
        
        return $moods;
    }
    
    public function getTracks($genre,$mood) {
        $url = "https://c[clientId].web.cddbp.net/webapi/xml/1.0/radio/recommend?client=[clientId]-[clientTag]&user=[userId]&seed=(genre_[genreId])&select_extended=cover&return_count=3&cover_size=small&filter_mood=[moodId]&focus_popularity=[popular]&focus_similarity=0&max_tracks_per_artist=1";
        
        $this->replaceString[] = '[genreId]';
        $this->replaceValue[] = $genre;
        
        $this->replaceString[] = '[moodId]';
        $this->replaceValue[] = $mood;
        
        $popular = rand(0,1000);
        $this->replaceString[] = '[popular]';
        $this->replaceValue[] = $popular;
        
        $tracksURL = $this->getUrl($url);
        $xml = simplexml_load_file($tracksURL);
        
        $tracks = [];
        
        foreach($xml->RESPONSE->ALBUM as $a) {
            
            $artist = (empty($a->TRACK->ARTIST)) ? $a->ARTIST : $a->TRACK->ARTIST ;
            
            $tracks[] = ['id' => $a->TRACK->GN_ID, 'artist' => $artist, 'track' => $a->TRACK->TITLE,'cover' => $a->URL];
        }
        
        return $tracks;
    }
    public function getRecomend($radio, $track) {
        $url = "https://c[clientId].web.cddbp.net/webapi/xml/1.0/radio/event?https://c[clientId].web.cddbp.net/webapi/xml/1.0/radio/lookahead?client=[clientId]-[clientTag]&user=[userId]&radio_id=[radioId]&event=track_like_[trackID]&select_extended=cover&return_count=8&cover_size=small";
        
        $this->replaceString[] = '[radioId]';
        $this->replaceValue[] = $radio;
        
        $this->replaceString[] = '[trackID]';
        $this->replaceValue[] = $radio;
        
        $rmdURL = $this->getUrl($url);
        $xml = simplexml_load_file($rmdURL);
        
        
    }
}
?>