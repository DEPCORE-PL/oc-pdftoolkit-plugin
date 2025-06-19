***

# GeneratorController





* Full name: `\Depcore\PDFToolkit\Classes\GeneratorController`
* Parent class: [`ControllerBehavior`](../../../Backend/Classes/ControllerBehavior.md)



## Properties


### formWidget



```php
protected \Backend\Widgets\Form $formWidget
```






***

### template



```php
protected $template
```






***

## Methods


### prepareVars

Prepares commonly used view data.

```php
protected prepareVars(): mixed
```












***

### create

Displays the main UI for the PDF generator.

```php
public create(int $recordId, mixed $context = null): \October\Rain\Halcyon\Model|void
```

This method is named "create" because it initiates the creation of a new PDF from a template.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$recordId` | **int** | The ID of the record to use for PDF generation. |
| `$context` | **mixed** | Optional. Additional context for the PDF generation process. |





***

### generate

Generates the PDF based on the provided data and template.

```php
protected generate(bool $download = false): string|void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$download` | **bool** | Whether to download the generated PDF or just preview it. |


**Return Value:**

The URL to the generated PDF or a file download response.




***

### preview

Generates a web response for previewing a PDF file in web browsers.

```php
public preview(string $filename, string $token): \Illuminate\Http\Response
```

This method takes a PDF filename and an access token, then returns an HTTP response
that allows the PDF to be previewed securely in the browser.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$filename` | **string** | The name of the PDF file to be previewed. |
| `$token` | **string** | The unique token used to distinguish files with the same name. |


**Return Value:**

The HTTP response containing the PDF preview.




***

### create_onGenerate

Handles the generation process when the "Generate" action is triggered.

```php
public create_onGenerate(mixed $context = null): void
```








**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$context` | **mixed** | Optional context information for the generation process. |





***

### create_onPreview

Handles the preview action for creating a PDF.

```php
public create_onPreview(mixed $context = null): array
```

Generates an iframe HTML element that displays a preview of the generated PDF.
The iframe is styled to be visible only on extra-large screens and hides the toolbar and navigation panes.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$context` | **mixed** | Optional context for the preview action. |


**Return Value:**

Returns an array containing the HTML content for the PDF preview.




***

### formRender

Renders the form widget.

```php
public formRender(array $options = []): string
```

Checks if the form widget is initialized; if not, throws an ApplicationException.
Otherwise, renders and returns the form widget with the provided options.






**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$options` | **array** | Optional array of options to customize the form rendering. |


**Return Value:**

The rendered form widget HTML.



**Throws:**
<p>If the form widget is not ready.</p>

- [`ApplicationException`](../../../ApplicationException.md)



***


***
> Automatically generated on 2025-06-19
