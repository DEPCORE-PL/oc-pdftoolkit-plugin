***

# ToolkitTemplate

Trait ToolkitTemplate

Adds form, registrar, and media features to PdfTemplate.
Provides reusable methods and properties for PDF toolkit templates.
Intended to be used within classes that require PDF template manipulation functionality.

* Full name: `\Depcore\PDFToolkit\Classes\ToolkitTemplate`



## Properties


### classPath



```php
private $classPath
```






***

### fields



```php
protected $fields
```






***

## Methods


### getName



```php
public static getName(): string
```



* This method is **static**.
* This method is **abstract**.







***

### image

Converts a form image path into a PDF template-compatible path.

```php
public image(string $path): string
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$path` | **string** | The file path from the form input. |


**Return Value:**

The resolved path for PDF template usage.




***

### getFields

Retrieves the fields associated with the template.

```php
public getFields(): array
```

The fields are defined in <templateclassname>/fields.yaml.







**Return Value:**

The list of fields for the template.




***

***
> Automatically generated on 2025-06-21

