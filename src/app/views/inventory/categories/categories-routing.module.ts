import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { CategoriesComponent } from './categories.component';

const routes: Routes = [	
	{
    path: '',
    data: {
      title: 'Categories'
    },
    children: [
      {
        path: '',
        component: CategoriesComponent,
        data: {
          title: 'List'
        }
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
export class CategoriesRoutingModule { }
