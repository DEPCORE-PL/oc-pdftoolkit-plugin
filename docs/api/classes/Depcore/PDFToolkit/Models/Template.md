***

# Template

Template Model



* Full name: `\Depcore\PDFToolkit\Models\Template`
* Parent class: [`Model`](../../../Model.md)

**See Also:**

* https://docs.octobercms.com/3.x/extend/system/models.html - 



## Properties


### timestamps



```php
public $timestamps
```






***

### fillable



```php
protected $fillable
```






***

### table



```php
public string $table
```






***

## Methods


### getModel

Returns an instance of the generable template class.

```php
public getModel(): \Depcore\PDFToolkit\Models\ToolkitTemplate
```

This method instantiates and returns a new object of the class specified by the `$class` property.
The returned object must implement the `ToolkitTemplate` interface and use the `ToolkitTemplate` trait.







**Return Value:**

An instance of the generable template class.




***


***
> Automatically generated on 2025-07-06
