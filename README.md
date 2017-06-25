This is a proyecto to generate random youtube

## How to use this template

Upload the web service connect with the youtube api in youtubeApi.php:

$Key = 'you api key youtube';


Connect the ionic project to the web service in the file src\providers\http\http.ts:

return this.http.get('https://tetrisu.000webhostapp.com/youtubeApi.php?lan='+lan+"&dur="+dur+"&cat="+cat+"&sea="+sea).map(res => res.json());

### You can test the result by installing the apk

Take the name after `ionic2-starter-`, and that is the name of the template to be used when using the `ionic start` command below:

```bash
$ sudo npm install -g ionic cordova
$ ionic start mySideMenu sidemenu
```

Then, to run it, cd into `mySideMenu` and run:

```bash
$ ionic cordova platform add ios
$ ionic cordova run ios
```

Substitute ios for android if not on a Mac.

