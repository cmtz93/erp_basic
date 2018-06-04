import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule, ReactiveFormsModule } from '@angular/forms';

import { CategoriesRoutingModule } from './categories-routing.module';
import { CategoriesComponent } from './categories.component';
import { CategoryService } from './category.service';

import { NgbModule } from '@ng-bootstrap/ng-bootstrap';

@NgModule({
  imports: [
    CommonModule,
    CategoriesRoutingModule,
    NgbModule,
    FormsModule
  ],
  declarations: [CategoriesComponent],
  providers: [
  	CategoryService
  ]
})
export class CategoriesModule { }
