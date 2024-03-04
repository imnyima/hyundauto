// [App-Angular-Coches]
// 2. Definir la capa del modelo (mapea campos -> componente)
export class Coche {
    matricula: string;      // Primary Key
    caracteristicas: Caracteristicas
    fecha: Date
    modelo: string

    constructor(
        matricula:string, 
        caracteristicas: Caracteristicas, 
        fecha:Date, 
        modelo: string){
        this.matricula = matricula;
        this.caracteristicas = caracteristicas
        this.fecha = fecha
        this.modelo = modelo;
    }

    
}

export interface Caracteristicas {
    precio:number
    estado:boolean
    kms:number
}