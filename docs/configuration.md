# Configuration

## PDF Generator Plugin Settings

After installing the PDF Generator plugin and `wkhtmltopdf`, configure the following in the backend settings:

- **Path to wkhtmltopdf**: Set the absolute path to the `wkhtmltopdf` binary.
- **Tokenizing**: Optionally add a pseudorandom token to filenames (enabled by default).
- **PDF Storage Directory**: Set where generated PDFs are stored (default: `temp_path()`).
- **Auto-remove PDFs**: Remove files after sending to the user (enabled by default).
- **Cleanup Old Files**: Remove files older than a set time (default: 2 days).

Refer to the [PDF Generator documentation](https://docs.init.biz/article/pdf-generator) for advanced options.
