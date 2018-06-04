import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ChartsModule } from 'ng2-charts/ng2-charts';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { InventoryRoutingModule } from './inventory-routing.module';

@NgModule({
  imports: [
    CommonModule,
    InventoryRoutingModule,
    ChartsModule
  ],
  declarations: []
})
export class InventoryModule { }
