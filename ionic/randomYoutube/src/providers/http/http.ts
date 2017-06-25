import { Injectable } from '@angular/core';
import { Http } from '@angular/http';
import 'rxjs/add/operator/map';

/*
  Generated class for the HttpProvider provider.

  See https://angular.io/docs/ts/latest/guide/dependency-injection.html
  for more info on providers and Angular DI.
*/
@Injectable()
export class HttpProvider {

  constructor(public http: Http) {
  }

  getJsonData(lan, dur, cat, sea){
    // you webservice
    return this.http.get('https://tetrisu.000webhostapp.com/youtubeApi.php?lan='+lan+"&dur="+dur+"&cat="+cat+"&sea="+sea).map(res => res.json());
  }

  getJsonDataBefore(dato){
    // you webservice
    return this.http.get('https://tetrisu.000webhostapp.com/youtubeApiNew.php?dato='+dato).map(res => res.json());
  }

}
