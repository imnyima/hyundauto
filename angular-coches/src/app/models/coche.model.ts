export class Coche {
    matricula: string;
    id_modelo: number;
    precio: number;
    estado: boolean;
    kms: number;
    fecha: Date;

    constructor(matricula: string, id_modelo: number, precio: number, estado: boolean, kms: number, fecha: Date){
        this.matricula = matricula;
        this.id_modelo = id_modelo;
        this.precio = precio;
        this.estado = estado;
        this.kms = kms;
        this.fecha = fecha;
    }
}
