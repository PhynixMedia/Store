# Package for Ecommerce Store
## This package should communicate with Feramy.
```angular2html
This package depends on store bridge to communicate with 
Feramy RMS. Products and other related items will be 
fetched directly from Feramy RMS
```

```angular2html

route('store.view') // GET METHOD // /store/list
route('store.search'); // GET METHOD
route('store.product.details', ['id'=>$id, 'name'=>$name]) // GET METHOD /store/category/127/selected/SALADS
route('store.category.view') // GET METHOD
route('store.category.products') // GET METHOD

```

