import { Injectable } from '@angular/core';
import { environment } from 'environments/environment';

import { HttpClient, HttpResponse, HttpHeaders, HttpParams } from '@angular/common/http';
import { Observable } from 'rxjs/Observable';

const API_URL = environment.apiUrl;

const httpOptions = {
    headers: new HttpHeaders({ 'Content-Type': 'application/json' })
};

@Injectable()
export class CategoryService {

	api: string = 'inventory/categories';

  constructor(private http: HttpClient) { 
  	this.api = API_URL + this.api;
  }

  // API: GET /categories
  public list(ctx: any = null) {
    let params = new HttpParams()
      .set('page', ctx.current_page)
      .set('perPage', ctx.per_page)
      .set('parent', 'true')
      .set('filter', ctx.filter)
    return this.http.get(this.api, { headers: httpOptions.headers, params: params } )
  }

  // API: POST /categories
  public create(category) {
   	return this.http.post(this.api, category, httpOptions)
  }

  // API: GET /categories/:id
  public get(id: number) {
    return this.http.get(this.api + `/${id}`, httpOptions)
  }

  // API: PUT /categories/:id
  public update(category) {
    return this.http.put(this.api + `/${category.id}`, category, httpOptions)
  }

  // DELETE /categories/:id
  public destroy(id: number) {
    return this.http.delete(this.api + `/${id}`, httpOptions)
  }
}
