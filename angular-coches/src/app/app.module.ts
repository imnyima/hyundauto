import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';

import { AppComponent } from './app.component';
import { HttpClientModule } from '@angular/common/http';
import { CocheListComponent } from './components/coche-list/coche-list.component';

// [App-Angular-Coches]
// 1. Definir el controlador general del proyecto
@NgModule({
  declarations: [
    AppComponent,
    CocheListComponent
  ],
  imports: [
    BrowserModule,
    HttpClientModule, 
  ],
  providers: [],
  bootstrap: [AppComponent]
})
export class AppModule { }
