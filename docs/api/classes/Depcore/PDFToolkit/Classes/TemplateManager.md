***

# TemplateManager

Class TemplateManager

Acts as a registrar for PDF templates within the depcore PDF toolkit plugin.
Allows registration of templates at plugin startup and provides access to them in the UI.

* Full name: `\Depcore\PDFToolkit\Classes\TemplateManager`




## Methods


### addTemplate

Adds a new template to the system.

```php
public static addTemplate(mixed $template): void
```



* This method is **static**.




**Parameters:**

| Parameter | Type | Description |
|-----------|------|-------------|
| `$template` | **mixed** | The template to be added. The type and structure of the template<br />should be specified in the implementation details. |





***

### getTemplates

Retrieves a list of available templates.

```php
public static getTemplates(): array
```



* This method is **static**.





**Return Value:**

An array of template data.




***


***
> Automatically generated on 2025-06-19
