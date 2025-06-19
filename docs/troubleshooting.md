# Troubleshooting

> **Note:** Some issues may originate from the underlying PDF Generator plugin that this tool relies on. If you encounter persistent problems, consider checking the upstream plugin's documentation and issue tracker.

## Common Issues

- **wkhtmltopdf not found**: Ensure the binary is installed and the path is set correctly in the PDF Generator settings.
- **Fonts or images not rendering**: Check asset paths and use supported font formats (prefer OTF over TTF for better compatibility).
- **PDFs not generated**: Review OctoberCMS logs for errors and verify all plugin dependencies are installed.

## Pro Tips

- Use SVG for icons to avoid compatibility issues with Adobe Reader.
- Clean up old PDF files regularly to save disk space.

For more help, see the [official documentation](https://docs.init.biz/article/pdf-generator) or open an issue on the plugin repository.
