// [App-Angular-Coches]
// 3. Defino el servicio intermediario endpoint <-> modelo


import { Injectable } from '@angular/core'
// Importamos el servicio http para definir el endpoint
import { HttpClient } from "@angular/common/http"
// Importamos la clase observable para la API (cors)
import { Observable } from "rxjs"
// Importamos el modelo para la entidad coche
import { Coche } from "../models/coche.model"

@Injectable({
  providedIn: 'root'
})
export class CocheService {

  // Definimos la variable del endpoint
  private apiUrl = "http://127.0.0.1:8000/coches/consultar"

  constructor(private http: HttpClient) { }

  // Definimos un método para obtener datos del endpoint
  getCoches(): Observable<Coche[]> {
    return this.http.get<Coche[]>(this.apiUrl)
  }

}
