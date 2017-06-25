This is a proyecto to generate random youtube

## How to use this template

Upload the web service connect with the youtube api in youtubeApi.php:

$Key = 'you api key youtube';


Connect the ionic project to the web service in the file src\providers\http\http.ts:

return this.http.get('https://tetrisu.000webhostapp.com/youtubeApi.php?lan='+lan+"&dur="+dur+"&cat="+cat+"&sea="+sea).map(res => res.json());

### You can test the result by installing the apk

Random Youtube.apk

