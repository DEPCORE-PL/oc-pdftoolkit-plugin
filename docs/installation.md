# Installation

## 1. Install PDF Toolkit
- Place the plugin in your OctoberCMS `plugins/depcore/pdftoolkit` directory.
- Run migrations if required.

## 2. Install PDF Generator Plugin
- Install the [official PDF Generator plugin](https://octobercms.com/plugin/initbiz-pdfgenerator) from the marketplace, or
- Use the [PiRifle fork](https://github.com/PiRifle/pdfgenerator-plugin) for improved rendering.

## 3. Install wkhtmltopdf

The PDF Generator plugin requires [wkhtmltopdf](https://wkhtmltopdf.org/) to be installed on your server.

### Ubuntu/Debian
```fish
sudo apt update
sudo apt install wkhtmltopdf
```

### Fedora
```fish
sudo dnf install wkhtmltopdf
```

After installation, set the absolute path to the `wkhtmltopdf` binary in the PDF Generator backend settings.

For more details, see the [official documentation](https://docs.init.biz/article/pdf-generator).
