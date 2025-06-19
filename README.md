# PDF Toolkit for OctoberCMS

A powerful interface plugin for [OctoberCMS](https://octobercms.com/) that enables users to generate PDFs from predefined templates directly from the UI. This plugin acts as a bridge to the [PDF Generator plugin](https://docs.init.biz/article/pdf-generator), allowing you to define dynamic input fields (including images and widgets) for your PDF templates using the familiar `fields.yaml` approach.

---

## Features
- Seamless UI for PDF generation using templates
- Dynamic input fields for PDF content (text, images, widgets, repeaters, color pickers, etc.)
- Template management using OctoberCMS conventions
- Full support for images via `mediafinder` (single and multiple)
- Advanced template logic with PHP and Twig
- Preview and export PDFs directly from the backend
- Asset management for custom CSS, images, and more

---

## Table of Contents
- [PDF Toolkit for OctoberCMS](#pdf-toolkit-for-octobercms)
  - [Features](#features)
  - [Table of Contents](#table-of-contents)
  - [Installation](#installation)
  - [PDF Generator Plugin Setup](#pdf-generator-plugin-setup)
    - [Installing wkhtmltopdf (Linux)](#installing-wkhtmltopdf-linux)
  - [Using the Plugin](#using-the-plugin)
  - [Defining Templates](#defining-templates)
  - [Template Development: Technical Guide](#template-development-technical-guide)
  - [Advanced: Improved PDF Rendering](#advanced-improved-pdf-rendering)
  - [Documentation](#documentation)
  - [License](#license)

---

## Installation

1. **Install this plugin**
   - Place the plugin in your OctoberCMS `plugins` directory under `depcore/pdftoolkit`.
   - Run migrations if required.

2. **Install the PDF Generator plugin**
   - [Official PDF Generator plugin](https://octobercms.com/plugin/initbiz-pdfgenerator)
   - Or use the improved [PiRifle fork](https://github.com/PiRifle/pdfgenerator-plugin) for better rendering (see [Advanced](#advanced-improved-pdf-rendering)).

---

## PDF Generator Plugin Setup

The PDF Generator plugin requires [wkhtmltopdf](https://wkhtmltopdf.org/) to be installed on your server.

### Installing wkhtmltopdf (Linux)

```fish
# On Ubuntu/Debian
sudo apt update
sudo apt install wkhtmltopdf

# On Fedora
sudo dnf install wkhtmltopdf
```

- After installation, set the absolute path to the `wkhtmltopdf` binary in the PDF Generator backend settings.
- For more details, see the [official documentation](https://docs.init.biz/article/pdf-generator).

---

## Using the Plugin

1. **Define your PDF templates** in the `templates/` directory. Each template can have its own fields and assets.
2. **Configure input fields** using `fields.yaml` (see [Defining Templates](#defining-templates)).
3. **Access the UI** in the OctoberCMS backend to input data, preview, and export PDFs.

---

## Defining Templates

Templates are defined in the `templates/` directory. Each template consists of:
- A PHP class (e.g., `DebugTemplate.php`) extending `PdfLayout` and using the `ToolkitTemplate` trait
- A directory with the same name (lowercase) containing:
  - `default.htm` (Twig/HTML template)
  - `fields.yaml` (input fields definition)
  - `assets/` (optional CSS, images, etc.)

**Example structure:**

```
templates/
  DebugTemplate.php
  debugtemplate/
    default.htm
    fields.yaml
    assets/
      css/
        style.css
      img/
        logo.png
```

---

## Template Development: Technical Guide

- **Field types:** Use any standard OctoberCMS field type: `text`, `textarea`, `dropdown`, `checkbox`, `radio`, `datepicker`, `colorpicker`, `richeditor`, `repeater`, etc.
- **Image support:**
  - Use `mediafinder` for all image and file selection (single or multiple images with `maxItems`).
  - **Do NOT use `fileupload`** for images or files. The PDF Toolkit does not support the `fileupload` widget for PDF generation.
- **Repeaters:** Use repeaters for dynamic lists (e.g., invoice items, sections). Repeaters can contain any field type, including nested repeaters and widgets.
- **Twig template:** All form data is available as variables in your Twig template. Loop over arrays, embed images, and use conditional logic as needed.
- **PHP class:**
  - Use the `prepareData` method to preprocess form data, resolve asset paths, and inject variables for the template.
  - Use the `image()` helper from `ToolkitTemplate` to resolve media paths for PDF embedding.
  - Reference assets in your template directory using `$this->assetsPath`.
- **Example field definition:**

```yaml
fields:
    title:
        label: Document Title
        type: text
        required: true
    logo:
        label: Logo Image
        type: mediafinder
        mode: image
    gallery:
        label: Image Gallery
        type: mediafinder
        mode: image
        maxItems: 5
    sections:
        label: Sections
        type: repeater
        form:
            fields:
                heading:
                    label: Heading
                    type: text
                image:
                    label: Section Image
                    type: mediafinder
```

- **Example Twig usage:**

```html
<h1>{{ title }}</h1>
<img src="{{ logo }}" alt="Logo" />
{% if gallery %}
  {% for img in gallery %}
    <img src="{{ img }}" />
  {% endfor %}
{% endif %}
{% for section in sections %}
  <h2>{{ section.heading }}</h2>
  <img src="{{ section.image }}" />
{% endfor %}
```

- **Example PHP data preparation:**

```php
public function prepareData($data): void
{
    parent::prepareData($data);
    $this->data["logo"] = $this->image($data["logo"]);
    if (!empty($data["gallery"])) {
        $gallery = is_array($data["gallery"]) ? $data["gallery"] : [$data["gallery"]];
        $this->data["gallery"] = array_map(fn($img) => $this->image($img), $gallery);
    }
    if (!empty($data["sections"])) {
        foreach ($data["sections"] as &$section) {
            if (!empty($section["image"])) {
                $section["image"] = $this->image($section["image"]);
            }
        }
        $this->data["sections"] = $data["sections"];
    }
}
```

- **Registration:** Templates are registered in `Plugin.php` using `TemplateManager::addTemplate()`. The backend UI loads fields dynamically from each template's `fields.yaml`.

---

## Advanced: Improved PDF Rendering

The [PiRifle fork](https://github.com/PiRifle/pdfgenerator-plugin) of the PDF Generator plugin offers a better renderer than the default `wkhtmltopdf` integration. Consider using this fork for improved PDF output quality.

---

## Documentation

Full documentation is available in the `docs/` directory and is compatible with [MkDocs](https://www.mkdocs.org/).

---

## License

MIT
