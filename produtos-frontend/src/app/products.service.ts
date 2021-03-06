import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Injectable } from '@angular/core';
import { Product } from './product';

@Injectable({
  providedIn: 'root'
})
export class ProductsService {

  baseUrl: string;
  headers: HttpHeaders;

  constructor(private http: HttpClient) {
      this.baseUrl = "http://localhost/produtos/public/produtos";
      this.headers = new HttpHeaders().set('Content-Type', 'application/json')
                                      .set('Accept', 'application/json')
                                      .set('Access-Control-Allow-Origin', '*')
                                      .set('Access-Control-Allow-Headers', '*')
                                      .set('Access-Control-Allow-Methods', 'GET,POST,PUT,PATCH,DELETE,OPTIONS');
  }

  getAll() {
    return this.http.get<Product[]>(this.baseUrl, {headers: this.headers});
  }

  getOne(id: number) {
    let url: string = this.baseUrl + '/' + id;
    return this.http.get<Product>(url, {headers: this.headers});
  }

  insert(product: Product) {
    return this.http.post<any>(this.baseUrl, product, {headers: this.headers});
  }

  update(product: Product) {
    return this.http.put<any>(this.baseUrl + '/' + product.id, product, {headers: this.headers});
  }

  delete(id: number) {
    let url: string = this.baseUrl + '/' + id;
    return this.http.delete<Product>(url, {headers: this.headers});
  }
}
