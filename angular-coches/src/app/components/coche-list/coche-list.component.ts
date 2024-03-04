import { Component, OnInit } from '@angular/core'

// Metemos el servicio y el modelo para los coches
import { CocheService } from "../../services/coche.service"
import { Coche } from "../../models/coche.model"

// [App-Angular-Coches]
// 4. Definimos el controlador del componente que pinta la tabla
@Component({
  selector: 'app-coche-list',
  templateUrl: './coche-list.component.html',
  styleUrls: ['./coche-list.component.css']
})
export class CocheListComponent implements OnInit {

  // Definimos un atributo que será el array de coches
  coches: Coche[] = []

  // En el constructor introduzco el servicio
  // Al arrancar el componente, usa el servicio y llama al endpoint
  constructor(private cocheService: CocheService){}

  // El método ngOnInit es el que se ejecuta al iniciar el componente
  ngOnInit(): void {
    // Voy a usar una función flecha y tengo el array con los datos
    this.cocheService.getCoches().subscribe(data => {
      this.coches = data
    })
  }
}
