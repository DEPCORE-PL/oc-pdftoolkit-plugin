# Templates

Templates in PDF Toolkit are modular, object-oriented, and highly customizable. They allow you to define the structure, fields, and assets for your generated PDFs, supporting a wide range of input types and advanced features like image embedding, repeaters, and custom widgets.

---

## Template Structure

Each template consists of:

- **A PHP class** (e.g., `DebugTemplate.php`) extending `PdfLayout` and using the `ToolkitTemplate` trait. This class is responsible for data preparation and asset resolution.

- **A directory** (lowercase, matching the class name) containing:
  - `default.htm` — The Twig/HTML template for PDF rendering.
  - `fields.yaml` — Field definitions for the backend form.
  - `assets/` — Optional CSS, images, or other resources (referenced via `$this->assetsPath`).

**Example:**

```text
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

## Defining Input Fields (`fields.yaml`)

The `fields.yaml` file defines the form fields available to users when generating a PDF. You can use any [OctoberCMS form widget](https://octobercms.com/docs/backend/forms#form-field-types), including:

- `text`, `textarea`, `number`, `dropdown`, `checkbox`, `radio`, `datepicker`, `colorpicker`
- `mediafinder` (for images, supports both single and multiple modes)
- `richeditor` (for rich text and HTML content)
- `repeater` (for dynamic lists, supports nested fields and widgets)

> **Note:** The `fileupload` widget is NOT supported in this plugin for PDF image embedding. Use `mediafinder` for all image and file selection. Attempting to use `fileupload` will not work for PDF generation.

**Example:**

```yaml
fields:
    title:
        label: Document Title
        type: text
        required: true
    description:
        label: Description
        type: textarea
    publish_date:
        label: Publish Date
        type: datepicker
    author:
        label: Author
        type: dropdown
        options:
            john: John Doe
            jane: Jane Smith
    logo:
        label: Logo Image
        type: mediafinder
        mode: image
    gallery:
        label: Image Gallery
        type: mediafinder
        mode: image
        maxItems: 5
    content:
        label: Content
        type: richeditor
    sections:
        label: Sections
        type: repeater
        form:
            fields:
                heading:
                    label: Heading
                    type: text
                body:
                    label: Body
                    type: textarea
                image:
                    label: Section Image
                    type: mediafinder
    color:
        label: Accent Color
        type: colorpicker
    is_published:
        label: Published?
        type: checkbox
```

---

## Twig/HTML Template (`default.htm`)

The Twig template receives all form data as variables. You can use them directly, loop over repeaters, and embed images. Asset paths can be injected from the PHP class using `$this->assetsPath`.

```html
<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="{{ style }}">
    <meta charset="UTF-8">
    <title>{{ title }}</title>
    <style>
        body { color: {{ color }}; }
    </style>
</head>
<body>
    <h1>{{ title }}</h1>
    <p>{{ description }}</p>
    <p>Published: {{ publish_date }}</p>
    <p>Author: {{ author }}</p>
    <img src="{{ logo }}" alt="Logo" style="max-width:150px;" />

    {% if gallery %}
      <div class="gallery">
        {% for img in gallery %}
          <img src="{{ img }}" style="width:100px;" />
        {% endfor %}
      </div>
    {% endif %}

    <div>{{ content|raw }}</div>

    {% for section in sections %}
      <h2>{{ section.heading }}</h2>
      <p>{{ section.body }}</p>
      {% if section.image %}
        <img src="{{ section.image }}" style="max-width:200px;" />
      {% endif %}
    {% endfor %}
</body>
</html>
```

---

## PHP Template Class (`DebugTemplate.php`)

The PHP class can preprocess data, resolve asset paths, or inject additional variables. Use the `ToolkitTemplate` trait for helpers like `image()` and `getFields()`. The `prepareData` method is called before rendering:

```php
// ...existing code...
class DebugTemplate extends PdfLayout
{
    use ToolkitTemplate;
    public static function getName(): string { return "Example Template"; }
    public function prepareData($data): void
    {
        parent::prepareData($data);
        // Inject CSS asset path
        $this->data["style"] = $this->assetsPath . "/css/style.css";
        // Convert mediafinder path to absolute for PDF
        if (!empty($data["logo"])) {
            $this->data["logo"] = $this->image($data["logo"]);
        }
        // Convert gallery (multi-image) to array of absolute paths
        if (!empty($data["gallery"])) {
            $gallery = is_array($data["gallery"]) ? $data["gallery"] : [$data["gallery"]];
            $this->data["gallery"] = array_map(fn($img) => $this->image($img), $gallery);
        }
        // Handle repeater images
        if (!empty($data["sections"])) {
            foreach ($data["sections"] as &$section) {
                if (!empty($section["image"])) {
                    $section["image"] = $this->image($section["image"]);
                }
            }
            $this->data["sections"] = $data["sections"];
        }
    }
}
// ...existing code...
```

---

## Image Support

- Use `mediafinder` for all image and file selection. Do **not** use `fileupload`.
- Use the `image()` helper from `ToolkitTemplate` to resolve media paths for PDF embedding.
- In Twig, use `<img src="{{ image }}" />` or loop over image arrays.
- For assets in your template directory, use `$this->assetsPath` in PHP and inject the path as a variable.

---

## Advanced Widgets & Tips

- Use `repeater` for dynamic sections (e.g., invoice items, chapters). Repeaters can contain any field type, including nested repeaters and widgets.
- Use `richeditor` for formatted content and HTML.
- Use `colorpicker` to let users customize PDF colors.
- Use `dropdown` or `radio` for controlled choices.
- You can include custom CSS in `assets/css/style.css` and reference it in your template.
- All field data is available in Twig as variables with the same name as in `fields.yaml`.

---

## Template Registration & Management

- Templates are registered via `TemplateManager::addTemplate()` in `Plugin.php`.
- Each template must implement `getName()` and `prepareData()`.
- The backend UI dynamically loads the form fields from each template's `fields.yaml` using the `ToolkitTemplate` trait.
- The `GeneratorController` handles form rendering, data collection, and PDF generation/preview.

---

## Example: Complex Template

See the `debugtemplate` example in this repository for a working demonstration of advanced field types, image support, and dynamic content. You can extend this pattern to build invoices, certificates, reports, and more.

For more, see the [OctoberCMS form fields documentation](https://octobercms.com/docs/backend/forms#form-field-types) and the source code of this plugin for advanced usage patterns.
