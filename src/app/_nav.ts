export const navigation = [
  {
    name: 'Dashboard',
    url: '/dashboard',
    icon: 'icon-speedometer',
    badge: {
      variant: 'info',
      text: 'NEW'
    }
  },
  {
    name: 'Inventory',
    url: '/inventory',
    icon: 'icon-grid',
    children: [
      {
        name: 'Categories',
        url: '/inventory/categories',
        icon: 'icon-frame'
      },
      {
        name: 'Manufacturers',
        url: '/inventory/manufacturers',
        icon: 'icon-chemistry'
      },
      {
        name: 'Products',
        url: '/inventory/products',
        icon: 'icon-diamond'
      },
    ]
  }
];
