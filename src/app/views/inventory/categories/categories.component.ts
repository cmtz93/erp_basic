import { Component, OnInit } from '@angular/core';
import { DomSanitizer } from '@angular/platform-browser';
import { CategoryService } from './category.service';

@Component({
  selector: 'app-categories',
  templateUrl: './categories.component.html',
  styles: []
})
export class CategoriesComponent implements OnInit {

  constructor(
    private sanitizer: DomSanitizer,
    private service: CategoryService
  ) { }

  ngOnInit() {
    this.getAll()
  }

  getAll() {
    this.isBusy = true
    this.service.list(this.metadata)
      .subscribe(
        response => { this.setResponse(response) },
        err => { console.log(err) },
        () => { console.log('Finished'); this.isBusy = false }
        )
  }

  destroy(item) {
    this.service.destroy(item.id)
      .subscribe(
        response => { this.getAll() },
        err => { console.log(err) },
        () => { console.log('Deleted'); }
        )
  }






  setResponse(response) {
    this.items = response.data
    this.metadata = response.meta_data
    window.scrollTo(0, 0)
    this.sortBy = null
  }

  metadata: any = {
    current_page : 1,
    total: 10,
    per_page: 10,
    from: 1,
    to: 10,
    last_page: 1,
  }
  filter:any = {}

  showFilter: boolean = false;
  toggleFilter() {
    this.showFilter = !this.showFilter
  }

  sortBy: string = null
  sortDesc: boolean = false

  pageOptions: any = [ 10, 25, 50, 100 ]

  title: string = 'List of Categories';

  fields: any = [
    {
      key: 'id',
      label: 'ID',
      sortable: true,
      type: Number
    },
  	{
  		key: 'name',
  		label: 'Name',
      sortable: true,
      type: String,
      filter: {
        type: 'text',
      }
  	},
  	{
  		key: 'parent.name',
  		label: 'Parent',
      default: 'No parent',
  	},
  	{
  		label: 'Status',
  		render: this.renderStatus,
  	},
  	{
  		label: 'Actions',
  		render: false,
  	}
  ];
  isBusy: boolean = true
  items: any = []

  renderStatus(item) {
  	if (item.status) {
  		return '<span class="badge badge-success">Activo</span>'
  	} else {
  		return '<span class="badge badge-danger">Inactivo</span>'
  	}
  }

  renderItems(item, field) {
  	if (field.render && field.render instanceof Function) {
  		return this.sanitizer.bypassSecurityTrustHtml(field.render(item))
  	} else if(typeof field.key === 'string') {
      if (field.key.includes('.')) {
        let keys = field.key.split('.')
        let print = item
        for (var i = 0; i < keys.length; i++) {
          if (item[keys[i]]) {
            print = print[keys[i]]
          } else {
            return field.default || null
          }
        }
        item[field.key] = print
        return print
      } 
  		return item[field.key]
  	}
  }
  
  pageChange(event: any): void {
    this.getAll()
    //console.log('Page changed to: ' + this.metadata.current_page);
  }

  sortChange(field) {
    if (field.sortable) {
      // sort
      if (this.sortBy == field.key) {
        this.sortDesc = !this.sortDesc
      } else {
        this.sortBy = field.key
        this.sortDesc = true 
      }
      let k = this.sortBy
      if (field.type === Number) {
        this.items.sort((a,b) => { return this.sortDesc ? a[k] - b[k] : b[k] - a[k] })
      } else if (field.type === String) {
        this.items.sort((a,b) => { return this.sortDesc ? a[k].localeCompare(b[k]) : b[k].localeCompare(a[k]) })
      }
    }
  }

}
