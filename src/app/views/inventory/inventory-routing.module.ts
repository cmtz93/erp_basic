import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';

const routes: Routes = [
	{
    path: '',
    data: {
      title: 'Inventory'
    },
    children: [
      {
        path: 'categories',
        loadChildren: './categories/categories.module#CategoriesModule',
      },
      /*{
        path: 'manufacturers',
        loadChildren: './manufacturers/manufacturers.module#ManufacturerModule',
        data: {
          title: 'Manufacturers'
        }
      }*/
    ]
  }
];

@NgModule({
  imports: [RouterModule.forChild(routes)],
  exports: [RouterModule]
})
export class InventoryRoutingModule { }
