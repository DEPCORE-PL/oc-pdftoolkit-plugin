***

# DebugTemplate

Class DebugTemplate

A PDF layout template used for debugging purposes within the PDF Toolkit plugin.
Extends the PdfLayout base class and uses the ToolkitTemplate trait for plugin compatibility.

* Full name: `\Depcore\PDFToolkit\Templates\DebugTemplate`
* Parent class: [`PdfLayout`](../../../Initbiz/Pdfgenerator/Classes/PdfLayout.md)




## Methods


### getName

Retrieves the name associated with this class or template.

```php
public static getName(): string
```



* This method is **static**.





**Return Value:**

The name as a string.




***

### prepareData

Prepares and transforms the form data or loads additional data for the template.

```php
public prepareData(mixed $data): void
```

This method is intended to process the provided data array, allowing for
transformation or enrichment of the data before it is used within the template.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$data` | **mixed** | The data to be prepared or transformed for the template. |





***


## Inherited methods


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
> Automatically generated on 2025-07-06
